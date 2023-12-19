<?php

namespace App\Http\Controllers;

use App\Classes\Cart;
use App\Classes\CartItem;
use App\Classes\CartRow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{

    public function show()
    {
        return view("cart/show", [
            "cart" => session('cart', new Cart())
        ]);
    }

    public function postAddToCart(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'price' => 'required'
        ]);

        if (!$validator->fails()) {
            $attributes = $validator->validated();

            $id = $attributes["id"];

            $cart = session('cart', new Cart());

            if (key_exists("product_" . $id, $cart->items)) {
                $row = $cart->items["product_" . $id];
                $row->quantity = $row->quantity + 1;
            } else {
                $row = new CartRow();
                $row->quantity = 1;
                $row->name = $attributes["name"];
                $row->price = $attributes["price"];
                $row->id = $attributes["id"];
            }

            $cart->items["product_" . $id] = $row;

            session(["cart" => $cart]);
        }

        return redirect()->back();
    }



    public function increaseQty(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if (!$validator->fails()) {
            $attributes = $validator->validated();

            $id = $attributes["id"];

            $cart = session('cart', new Cart());

            $cart->items["product_" . $id]->quantity = $cart->items["product_" . $id]->quantity + 1;


            session(["cart" => $cart]);
        }

        return redirect()->back();
    }

    public function decreaseQty(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if (!$validator->fails()) {
            $attributes = $validator->validated();

            $id = $attributes["id"];

            $cart = session('cart', new Cart());

            if ($cart->items["product_" . $id]->quantity == 1) {
                unset($cart->items["product_" . $id]);
            } else {
                $cart->items["product_" . $id]->quantity = $cart->items["product_" . $id]->quantity - 1;
            }


            session(["cart" => $cart]);
        }

        return redirect()->back();
    }

    public function removeFromCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if (!$validator->fails()) {
            $attributes = $validator->validated();

            $id = $attributes["id"];

            $cart = session('cart', new Cart());

            unset($cart->items["product_" . $id]);

            session(["cart" => $cart]);
        }

        return redirect()->back();
    }
}
