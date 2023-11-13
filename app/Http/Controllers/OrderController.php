<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCreated;


use App\Models\OrderDetail;
use App\Models\Settings;
use App\Models\Carrier;
use App\Models\Order;



class OrderController extends Controller
{

    public function list()
    {
        $orderBy = request("orderBy") ?? "id";
        $ascending_value = request("ascending", true);
        $ascending = $ascending_value === 'true' ? 'asc' : 'desc';

        return view("order.list", [
            "data" => Order::where("user_id", auth()->user()->id)->filter(request(['search']))->with(['user', 'orderState'])->orderBy($orderBy, $ascending)->paginate(request('perPage') ?? 5),
            "search" => request('search', null),
            "orderBy" => $orderBy,
            "ascending" => $ascending_value === "true",
        ]);
    }

    public function orderView(Order $order)
    {
        $order =  Order::where("id", "=", $order->id)->with("orderState", "orderDetails", "carrier")->first();
        return view("order.detail", [
            "order" => $order
        ]);
    }

    public function create(Request $request)
    {
        $cart = session('cart');

        $settings = Settings::first();

        $carrier = Carrier::where("id", $cart->carrier_id)->first();

        $attributes = [
            "user_id" => $request->user()->id,
            "total" => $cart->total,
            "carrier_id" => $carrier->id,
            "delivery_costs" => $carrier->costs,
            "delivery_address" => $cart->delivery_address ?? "",
            "delivery_time" => $cart->delivery_time ?? "",
            "order_state_id" => $settings->order_created_state_id ?? null,
            "note" => $request->input('note') ?? "",
            "is_paid" => false
        ];

        $order = Order::create($attributes);

        foreach ($cart->items as $item) {

            OrderDetail::create([
                "order_id" => $order->id,
                "quantity" => $item->quantity,
                "unit_price" => $item->price,
                "price" => $item->price * $item->quantity,
                "name" => $item->name
            ]);
        }


        $request->session()->forget(['cart']);

        Mail::to($request->user())->send(new OrderCreated($order));

        //TODO: Inviare email all'amministrazione
        session()->flash("success_message", "Ordine creato");

        return redirect()->action([OrderController::class, "orderView"], [
            "order" => $order->id
        ]);
    }

    public function pay(Order $order)
    {

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $line_items = [];


        foreach ($order->orderDetails as $row) {

            array_push($line_items, [
                'price_data' => [
                    "currency" => "eur",
                    "unit_amount" => $row->unit_price * 100,
                    "product_data" => [
                        "name" => $row->name
                    ],
                ],
                'quantity' => $row->quantity,
            ]);
        }

        $carrier = Carrier::where("id", $order->carrier_id)->first();

        array_push($line_items, [
            'price_data' => [
                "currency" => "eur",
                "unit_amount" => $carrier->costs * 100,
                "product_data" => [
                    "name" => $carrier->name
                ],
            ],
            'quantity' => 1,
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => $line_items,
            "metadata" => [
                "order_sku" => $order->id
            ],
            'mode' => 'payment',
            'success_url' => route('order.payment_completed', [
                "order" => $order->id
            ]),
            'cancel_url' => route('order.view', [
                "order" => $order->id
            ]),
        ]);


        return redirect($checkout_session->url);
    }

    public function storePayment(Request $request, Order $order)
    {
        session()->flash("success_message", "Ordine pagato");

        return redirect()->action([OrderController::class, "orderView"], [
            "order" => $order->id
        ]);
    }
}
