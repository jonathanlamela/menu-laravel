<?php

namespace App\Http\Controllers;

use App\Mail\OrderCreated;


use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrdiniSetting;
use App\Models\Settings;
use App\Models\ShippingSetting;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CheckoutController extends Controller
{
    public function step1()
    {
        return Inertia::render("checkout/TipologiaConsegnaPage");
    }

    public function storeStep1(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'tipologia_consegna' => 'required',
        ], []);

        if ($validator->fails()) {
            return redirect(route('checkout.step1'))
                ->withErrors($validator)
                ->withInput();
        }


        $attributes = $validator->validated();

        $cart = session()->get("cart");
        $cart["tipologia_consegna"] = $attributes["tipologia_consegna"];
        session(["cart" => $cart]);

        return redirect(route('checkout.step2'));
    }

    public function step2()
    {
        $cart = session()->get("cart");

        if ($cart["tipologia_consegna"] == "ASPORTO") {
            return redirect()->action([CheckoutController::class, 'step3']);
        }
        return Inertia::render("checkout/InformazioniConsegnaPage");
    }

    public function storeStep2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'indirizzo' => 'required',
            'orario' => 'required|date_format:H:i'
        ], [
            'indirizzo.required' => 'Inserisci il tuo indirizzo di consegna',
            'orario.required' => "Inserisci l'orario di consegna",
            "orario.after" => "Inserisci un orario di consegna superiore all'ora attuale",
            "orario.date_format" => "Inserisci un orario valido"
        ]);

        if ($validator->fails()) {
            return redirect(route('checkout.step2'))
                ->withErrors($validator)
                ->withInput();
        }

        $attributes = $validator->validated();

        $cart = session()->get("cart");
        $cart["indirizzo"] = $attributes["indirizzo"];
        $cart["orario"] = $attributes["orario"];
        session()->put("cart", $cart);


        return redirect(route('checkout.step3'));
    }

    public function step3()
    {
        return Inertia::render('checkout/RiepilogoOrdinePage');
    }

    public function storeStep3(Request $request)
    {

        $note = $request->input('note') ?? "";

        $cart = session('cart');

        $cart["note"] = $note;

        $settings = Settings::first();

        $shipping_costs = ($settings->shipping_costs) ?? 0;

        $attributes = [
            "user_id" => $request->user()->id,
            "total" => (float)$cart["total"] + ($cart["tipologia_consegna"] != "ASPORTO" ? $shipping_costs : 0.00),
            "shipping_costs" => $cart["tipologia_consegna"] != "ASPORTO" ? $shipping_costs : 0.00,
            "is_shipping" => $cart["tipologia_consegna"] != "ASPORTO",
            "shipping_address" => $cart["indirizzo"] ?? "",
            "shipping_datetime" => $cart["orario"] ?? "",
            "order_status_id" => $settings->order_created_state_id ?? null,
            "note" => $note,
            "is_paid" => False
        ];

        $cart = session('cart', [
            "items" => [],
            "total" => 0
        ]);



        $order = Order::create($attributes);

        foreach ($cart["items"] as $item) {

            OrderDetail::create([
                "order_id" => $order->id,
                "id" => $item["id"],
                "quantity" => $item["quantity"],
                "unit_price" => $item["price"],
                "price" => $item["price"] * $item["quantity"],
                "name" => $item["name"]
            ]);
        }

        if ($order->is_shipping) {
            OrderDetail::create([
                "order_id" => $order->id,
                "quantity" => 1,
                "unit_price" => $shipping_costs,
                "price" => $shipping_costs,
                "name" => "Spese di consegna"
            ]);
        }

        $request->session()->forget(['cart', 'tipoConsegna', 'indirizzo', 'orario']);

        Mail::to($request->user())->send(new OrderCreated($order));

        //TODO: Inviare email all'amministrazione
        session()->flash("success_message", "Ordine creato");

        return redirect()->action([OrderController::class, "orderView"], [
            "order" => $order->id
        ]);
    }
}
