<?php

namespace App\Http\Controllers;

use App\Mail\OrderCreated;


use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Settings;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CheckoutController extends Controller
{
    public function step1()
    {
        $cart = session()->get("cart");

        return view("checkout.delivery_type", [
            "delivery_type" => $cart != null ? $cart['delivery_type'] : 'ASPORTO'
        ]);
    }

    public function storeStep1(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'delivery_type' => 'required',
        ], []);

        if ($validator->fails()) {
            return redirect(route('checkout.step1'))
                ->withErrors($validator)
                ->withInput();
        }


        $attributes = $validator->validated();

        $cart = session()->get("cart");
        $cart["delivery_type"] = $attributes["delivery_type"];

        session(["cart" => $cart]);

        return redirect(route('checkout.step2'));
    }

    public function step2()
    {
        $cart = session()->get("cart");

        if ($cart["delivery_type"] == "ASPORTO") {
            return redirect()->action([CheckoutController::class, 'step3']);
        }
        return view("checkout.delivery_info", [
            "delivery_type" => $cart != null ? $cart['delivery_type'] : 'ASPORTO',
            "delivery_time" =>  $cart != null ? $cart['delivery_time'] : '',
            "delivery_address" =>  $cart != null ? $cart['delivery_address'] : '',
        ]);
    }

    public function storeStep2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'delivery_address' => 'required',
            'delivery_time' => 'required|date_format:H:i'
        ], [
            'delivery_address.required' => 'Inserisci il tuo indirizzo di consegna',
            'delivery_time.required' => "Inserisci l'orario di consegna",
            "delivery_time.after" => "Inserisci un orario di consegna superiore all'ora attuale",
            "delivery_time.date_format" => "Inserisci un orario valido"
        ]);

        if ($validator->fails()) {
            return redirect(route('checkout.step2'))
                ->withErrors($validator)
                ->withInput();
        }

        $attributes = $validator->validated();

        $cart = session()->get("cart");
        $cart["delivery_address"] = $attributes["delivery_address"];
        $cart["delivery_time"] = $attributes["delivery_time"];
        session()->put("cart", $cart);


        return redirect(route('checkout.step3'));
    }

    public function step3()
    {
        $cart = session()->get("cart");
        return view('checkout.order_summary', [
            "delivery_type" => $cart != null ? $cart['delivery_type'] : 'ASPORTO',
            "delivery_time" =>  $cart != null ? $cart['delivery_time'] : '',
            "delivery_address" =>  $cart != null ? $cart['delivery_address'] : '',
            "total" =>  $cart != null ? $cart['total'] : 0,
            "items" => $cart != null ? $cart['items'] : [],
        ]);
    }
}
