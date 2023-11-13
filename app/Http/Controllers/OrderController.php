<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use App\Models\Order;
use Illuminate\Support\Facades\Response;

use App\Mail\OrderCreated;

use App\Mail\OrderPaid;

use App\Models\OrderDetail;
use App\Models\Settings;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;


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

    public function orderView(Order $order, Request $request)
    {
        $order =  Order::where("id", "=", $order->id)->with("orderState", "orderDetails")->get()->first();
        return view("order.detail", [
            "order" => $order
        ]);
    }

    public function create(Request $request)
    {
        $cart = session('cart');

        $settings = Settings::first();

        $shipping_costs = ($settings->shipping_costs) ?? 0;

        $attributes = [
            "user_id" => $request->user()->id,
            "total" => (float)$cart["total"] + ($cart["delivery_type"] != "ASPORTO" ? $shipping_costs : 0.00),
            "shipping_costs" => $cart["delivery_type"] != "ASPORTO" ? $shipping_costs : 0.00,
            "is_shipping" => $cart["delivery_type"] != "ASPORTO",
            "delivery_address" => $cart["delivery_address"] ?? "",
            "delivery_time" => $cart["delivery_time"] ?? "",
            "order_state_id" => $settings->order_created_state_id ?? null,
            "note" => $request->input('note') ?? "",
            "is_paid" => false
        ];

        $order = Order::create($attributes);

        foreach ($cart["items"] as $item) {

            OrderDetail::create([
                "order_id" => $order->id,
                "quantity" => $item["quantity"],
                "unit_price" => $item["item"]["price"],
                "price" => $item["item"]["price"] * $item["quantity"],
                "name" => $item["item"]["name"]
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


        foreach ($order->order_details as $row) {

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

        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

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


        return Response::json([
            "redirect_url" => $checkout_session->url
        ]);
    }

    public function storePayment(Request $request, Order $order)
    {
        session()->flash("success_message", "Ordine pagato");

        return redirect()->action([OrderController::class, "orderView"], [
            "order" => $order->id
        ]);
    }
}
