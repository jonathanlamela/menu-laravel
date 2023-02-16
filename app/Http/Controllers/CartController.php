<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class CartController extends Controller
{

    public function show()
    {
        return Inertia::render("cart/CarrelloPage");
    }

    public function postAddToCart(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'food_id' => 'required',
            'food_name' => 'required',
            'food_price' => 'required'
        ]);

        if (!$validator->fails()) {
            $attributes = $validator->validated();

            $food_id = $attributes["food_id"];
            $food_name = $attributes["food_name"];
            $food_price = $attributes["food_price"];

            $cart = session('cart', [
                "items" => [],
                "subtotal" => 0
            ]);

            if (key_exists("product_" . $food_id, $cart["items"])) {
                $row = $cart["items"]["product_" . $food_id];
                $cart["items"]["product_" . $food_id]["quantity"] = $row["quantity"] + 1;
            } else {
                $cart["items"]["product_" . $food_id] = [
                    "quantity" => 1,
                    "name" => $food_name,
                    "price" => $food_price,
                    "id" => $food_id
                ];
            }

            //update subtotal

            $cart["subtotal"] = 0;

            foreach ($cart["items"] as $item) {

                $cart["subtotal"] += $item["price"] * $item["quantity"];
            }

            session(["cart" => $cart]);
        }

        return redirect()->back();
    }

    public function increaseQty(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'food_id' => 'required'
        ]);

        if (!$validator->fails()) {
            $attributes = $validator->validated();

            $food_id = $attributes["food_id"];

            $cart = session('cart', [
                "items" => [],
                "subtotal" => 0
            ]);

            $cart["items"]["product_" . $food_id]["quantity"] = $cart["items"]["product_" . $food_id]["quantity"] + 1;


            //update subtotal

            $cart["subtotal"] = 0;

            foreach ($cart["items"] as $item) {

                $cart["subtotal"] += $item["price"] * $item["quantity"];
            }

            session(["cart" => $cart]);
        }

        return redirect()->back();
    }

    public function decreaseQty(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'food_id' => 'required'
        ]);

        if (!$validator->fails()) {
            $attributes = $validator->validated();

            $food_id = $attributes["food_id"];

            $cart = session('cart', [
                "items" => [],
                "subtotal" => 0
            ]);

            if ($cart["items"]["product_" . $food_id]["quantity"] == 1) {
                unset($cart["items"]["product_" . $food_id]);
            } else {
                $cart["items"]["product_" . $food_id]["quantity"] = $cart["items"]["product_" . $food_id]["quantity"] - 1;
            }
            //update subtotal

            $cart["subtotal"] = 0;

            foreach ($cart["items"] as $item) {

                $cart["subtotal"] += $item["price"] * $item["quantity"];
            }

            session(["cart" => $cart]);
        }

        return redirect()->back();
    }

    public function removeFromCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'food_id' => 'required'
        ]);

        if (!$validator->fails()) {
            $attributes = $validator->validated();

            $food_id = $attributes["food_id"];

            $cart = session('cart', [
                "items" => [],
                "subtotal" => 0
            ]);

            unset($cart["items"]["product_" . $food_id]);

            //update subtotal

            $cart["subtotal"] = 0;

            foreach ($cart["items"] as $item) {

                $cart["subtotal"] += $item["price"] * $item["quantity"];
            }

            session(["cart" => $cart]);
        }

        return redirect()->back();
    }
}
