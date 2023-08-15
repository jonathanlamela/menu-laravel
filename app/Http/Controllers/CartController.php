<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class CartController extends Controller
{

    public function show()
    {
        $cart = session('cart', [
            "items" => [],
            "total" => 0
        ]);
        return Inertia::render("cart/CarrelloPage", [
            "cart" => $cart
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
            $food_name = $attributes["name"];
            $food_price = $attributes["price"];

            $cart = session('cart', [
                "items" => [],
                "total" => 0
            ]);

            if (key_exists("product_" . $id, $cart["items"])) {
                $row = $cart["items"]["product_" . $id];
                $cart["items"]["product_" . $id]["quantity"] = $row["quantity"] + 1;
            } else {
                $cart["items"]["product_" . $id] = [
                    "quantity" => 1,
                    "item" => [
                        "name" => $food_name,
                        "price" => $food_price,
                        "id" => $id
                    ]
                ];
            }


            $cart["total"] = 0;

            foreach ($cart["items"] as $item) {

                $cart["total"] += $item["item"]["price"] * $item["quantity"];
            }

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

            $cart = session('cart', [
                "items" => [],
                "total" => 0
            ]);

            $cart["items"]["product_" . $id]["quantity"] = $cart["items"]["product_" . $id]["quantity"] + 1;


            //update total
            $cart["total"] = 0;

            foreach ($cart["items"] as $item) {

                $cart["total"] += $item["item"]["price"] * $item["quantity"];
            }

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

            $cart = session('cart', [
                "items" => [],
                "total" => 0
            ]);

            if ($cart["items"]["product_" . $id]["quantity"] == 1) {
                unset($cart["items"]["product_" . $id]);
            } else {
                $cart["items"]["product_" . $id]["quantity"] = $cart["items"]["product_" . $id]["quantity"] - 1;
            }
            //update total

            $cart["total"] = 0;

            foreach ($cart["items"] as $item) {

                $cart["total"] += $item["item"]["price"] * $item["quantity"];
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

            $cart = session('cart', [
                "items" => [],
                "total" => 0
            ]);

            unset($cart["items"]["product_" . $id]);

            //update total

            $cart["total"] = 0;

            foreach ($cart["items"] as $item) {

                $cart["total"] += $item["item"]["price"] * $item["quantity"];
            }

            session(["cart" => $cart]);
        }

        return redirect()->back();
    }
}
