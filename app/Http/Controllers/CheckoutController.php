<?php

namespace App\Http\Controllers;

use App\Mail\OrderCreated;


use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrdiniSetting;
use App\Models\ShippingSetting;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use Stripe\Service\OrderService;

class CheckoutController extends Controller
{
    public function step1()
    {
        return view('checkout/step1', [
            "shippingSettings" => ShippingSetting::first() ?? new ShippingSetting()
        ]);
    }

    public function storeStep1(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'tipoConsegna' => 'required',
        ], []);

        if ($validator->fails()) {
            return redirect(route('checkout.step1'))
                ->withErrors($validator)
                ->withInput();
        }


        $attributes = $validator->validated();

        session()->put('tipoConsegna', $attributes["tipoConsegna"]);


        return redirect(route('checkout.step2'));
    }

    public function step2()
    {
        if (session("tipoConsegna") == "asporto") {
            return redirect()->action([CheckoutController::class, 'step3']);
        }
        return view('checkout/step2');
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

        session()->put('indirizzo', $attributes["indirizzo"]);
        session()->put('orario', $attributes["orario"]);



        return redirect(route('checkout.step3'));
    }

    public function step3()
    {
        $cart = session('cart', [
            "items" => [],
            "subtotal" => 0
        ]);

        if ($cart) {
            return view('checkout/step3', [
                "cart" => $cart,
                "shippingSettings" => ShippingSetting::first() ?? new ShippingSetting()
            ]);
        }
    }

    public function storeStep3(Request $request)
    {

        $note = $request->input('note') ?? "";

        $cart = session('cart', [
            "items" => [],
            "subtotal" => 0
        ]);

        $shipping_costs = (ShippingSetting::first()->shipping_costs) ?? 0;


        $attributes = [
            "user_id" => $request->user()->id,
            "subtotal" => (float)$cart["subtotal"] + ($request->session()->get('tipoConsegna') != "asporto" ? $shipping_costs : 0.00),
            "shipping_costs" => $request->session()->get('tipoConsegna') != "asporto" ? $shipping_costs : 0.00,
            "is_shipping" => $request->session()->get('tipoConsegna') != "asporto",
            "shipping_address" => $request->session()->get('indirizzo') ?? "",
            "shipping_datetime" => $request->session()->get('orario') ?? "",
            "order_status" => OrdiniSetting::first()->order_created_state_id ?? null,
            "note" => $note,
            "is_paid" => False
        ];



        $order = Order::create($attributes);

        foreach ($cart["items"] as $item) {

            OrderDetail::create([
                "order_id" => $order->id,
                "food_id" => $item["id"],
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
