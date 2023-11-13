<?php

namespace App\Http\Controllers;


use App\Models\Carrier;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function step1()
    {
        $cart = session()->get("cart");

        return view("checkout.order_carrier", [
            "carriers" => Carrier::where('deleted', false)->get(),
            "carrier_id" => $cart->carrier_id ?? Carrier::where('deleted', false)->first()->id
        ]);
    }

    public function storeStep1(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'carrier_id' => 'required',
        ], [
            "carrier_id.required" => "Il campo corriere è obbligatorio"
        ]);

        if ($validator->fails()) {
            return redirect(route('checkout.step1'))
                ->withErrors($validator)
                ->withInput();
        }


        $attributes = $validator->validated();

        $cart = session()->get("cart");
        $cart->carrier_id = $attributes["carrier_id"];

        session(["cart" => $cart]);

        return redirect(route('checkout.step2'));
    }

    public function step2()
    {
        $cart = session()->get("cart");


        return view("checkout.delivery_info", [
            "delivery_time" =>   $cart->delivery_time ?? '',
            "delivery_address" =>  $cart->delivery_address ?? '',
        ]);
    }

    public function storeStep2(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'delivery_time' => 'required',
        ], [
            "delivery_time.required" => "Il campo orario è obbligatorio"
        ]);

        if ($validator->fails()) {
            return redirect(route('checkout.step2'))
                ->withErrors($validator)
                ->withInput();
        }

        $attributes = $validator->validate();


        $cart = session()->get("cart");
        $cart->delivery_address = request("delivery_address");
        $cart->delivery_time = $attributes["delivery_time"];

        session()->put("cart", $cart);

        return redirect(route('checkout.step3'));
    }

    public function step3()
    {
        $cart = session()->get("cart");
        return view('checkout.order_summary', [
            "carrier" => Carrier::where("id", $cart->carrier_id)->first(),
            "delivery_time" =>  $cart->delivery_time ?? 'Nessun orario',
            "delivery_address" =>  $cart->delivery_address ?? 'Nessun indirizzo',
            "total" =>  $cart->total ?? 0,
            "items" => $cart->items ?? [],
        ]);
    }
}
