<?php

namespace App\Http\Controllers;

use App\Mail\OrderCreated;


use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;



class CheckoutController extends Controller
{
    public function step1()
    {
        return view('checkout/step1');
    }

    public function storeStep1(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'tipo_consegna' => 'required',

        ], []);

        if ($validator->fails()) {
            return redirect(route('checkout.step1'))
                ->withErrors($validator)
                ->withInput();
        }


        $attributes = $validator->validated();

        session()->put('tipo_consegna', $attributes["tipo_consegna"]);


        return redirect(route('checkout.step2'));
    }

    public function step2()
    {
        if (session("tipo_consegna") == "asporto") {
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
                "cart" => $cart
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

        $attributes = [
            "user_id" => $request->user()->id,
            "sub_total" => (float)$cart["subtotal"] + ($request->session()->get('tipo_consegna') != "asporto" ? 2.00 : 0.00),
            "shipping_costs" => $request->session()->get('tipo_consegna') != "asporto" ? 2.00 : 0.00,
            "is_shipping" => $request->session()->get('tipo_consegna') != "asporto",
            "shipping_address" => $request->session()->get('indirizzo') ?? "",
            "shipping_datetime" => $request->session()->get('orario') ?? "",
            "order_status" => "Ordine creato",
            "note" => $note
        ];



        $order = Order::create($attributes);

        foreach ($cart["items"] as $item) {

            OrderDetail::create([
                "order_id" => $order->id,
                "food_id" => $item["id"],
                "quantity" => $item["quantity"],
                "price" => $item["price"],
                "name" => $item["name"]
            ]);
        }

        $request->session()->forget(['cart', 'tipo_consegna', 'indirizzo', 'orario']);

        Mail::to($request->user())->send(new OrderCreated($order));

        //TODO: Inviare email all'amministrazione
        session()->flash("success_message", "Ordine creato");

        return redirect()->action([OrderController::class, "view"], [
            "order_id" => $order->id
        ]);
    }
}
