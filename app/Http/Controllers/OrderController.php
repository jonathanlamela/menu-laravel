<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use App\Models\Order;


class OrderController extends Controller
{

    public function list()
    {
        return view(
            "order.list",
            [
                "orders" => Order::where("user_id", "=", request()->user()->id)->get()
            ]
        );
    }

    public function orderView(Order $order)
    {
        return view('order.view', [
            "order" => $order
        ]);
    }

    public function paga(Request $request, Order $order)
    {

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $line_items = [];


        if ($order->isShipping) {
            array_push($line_items, [
                'price_data' => [
                    "currency" => "eur",
                    "unit_amount" => $order->shippingCosts * 100,
                    "product_data" => [
                        "name" => "Spese di consegna"
                    ],
                ],
                'quantity' => 1,
            ]);
        }


        foreach ($order->orderDetails as $row) {

            array_push($line_items, [
                'price_data' => [
                    "currency" => "eur",
                    "unit_amount" => $row->price * 100,
                    "product_data" => [
                        "name" => $row->name
                    ],
                ],
                'quantity' => $row->quantity,
            ]);
        }


        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => $line_items,
            "metadata" => [
                "order_sku" => $order->id
            ],
            'mode' => 'payment',
            'success_url' => route('ordini.pagamento-completato', [
                "order" => $order->id
            ]),
            'cancel_url' => route('ordini.view', [
                "order" => $order->id
            ]),
        ]);

        return view('order.pagamento', [
            "checkout_session_id" => $checkout_session["id"],
            "checkout_public_key" => env('STRIPE_KEY')
        ]);
    }

    public function storePagamento(Request $request, Order $order)
    {
        session()->flash("success_message", "Ordine pagato");

        return redirect()->action([OrderController::class, "orderView"], [
            "order" => $order->id
        ]);
    }
}
