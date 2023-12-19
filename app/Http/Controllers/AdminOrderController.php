<?php

namespace App\Http\Controllers;

use App\Mail\OrderStateUpdated;
use App\Models\Carrier;
use App\Models\Food;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderState;
use App\Models\Settings;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AdminOrderController extends Controller
{
    public function list()
    {
        $orderBy = request("orderBy") ?? "id";
        $ascending_value = request("ascending", 'true') === 'true' ? 'asc' : 'desc';

        return view("admin.order.list", [
            "data" => Order::filter(request(['search']))->with(['user', 'orderState'])->orderBy($orderBy, $ascending_value)->paginate(request('perPage') ?? 5),
            "search" => request('search', null),
            "orderBy" => $orderBy,
            "ascending" => request("ascending", 'true') === "true",
        ]);
    }


    public function edit(Order $order)
    {
        $result =  Order::where("id", "=", $order->id)->first();

        return view("admin.order.edit", [
            "order" => $result,
            "foods" => Food::with("category")->get()
        ]);
    }

    public function updateOrderState(Order $order, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'order_state_id' => 'required',
        ], [
            'order_state_id.required' => __('order.order_state_required'),

        ]);

        if ($validator->fails()) {
            return redirect(route('admin.order.edit', ["order" => $order]))
                ->withErrors($validator)
                ->withInput();
        }

        $attributes = $validator->validated();

        $order->update(["order_state_id" => $attributes["order_state_id"]]);

        $order = Order::where("id", "=", $order->id)->with(["user", "orderState"])->first();

        Mail::to($order->user)->send(new OrderStateUpdated($order->user, $order->id, $order->orderState->name));

        session()->flash("success_message", __('order.order_state_success'));

        return redirect(route('admin.order.edit', ["order" => $order]));
    }

    public function updateOrderDeliveryType(Order $order, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'delivery_type' => 'required',
        ], [
            'delivery_type.required' => __('globals.delivery_type_required'),
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.order.edit', ["order" => $order]))
                ->withErrors($validator)
                ->withInput();
        }


        $data = [
            "delivery_address" => $order->delivery_address ?? null,
            "delivery_time" =>  $order->delivery_time ?? null
        ];

        $order->update($data);

        session()->flash("success_message", __('order.delivery_type_success'));

        return redirect(route('admin.order.edit', ["order" => $order]));
    }

    public function updateOrderCarrier(Order $order, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'carrier_id' => 'required',
        ], [
            'carrier_id.required' => __('order.carrier_required'),
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.order.edit', ["order" => $order]))
                ->withErrors($validator)
                ->withInput();
        }

        $attributes = $validator->validated();

        $carrier = Carrier::where("id", $attributes["carrier_id"])->first();


        $data = [
            "carrier_id" => $carrier->id,
            "delivery_costs" => $carrier->cost
        ];

        $order->update($data);

        session()->flash("success_message", __('order.carrier_success'));

        return redirect(route('admin.order.edit', ["order" => $order]));
    }

    public function addOrderDetail(Order $order, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
        ], [
            'name.required' => __('order.detail_name_required'),
            'price.required' => __('order.detail_price_required'),
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.order.edit', ["order" => $order]))
                ->withErrors($validator)
                ->withInput();
        }

        OrderDetail::create([
            "order_id" => $order->id,
            "quantity" => 1,
            "unit_price" => request()->price,
            "price" => request()->price * 1,
            "name" => request()->name
        ]);

        session()->flash("success_message", __('order.detail_add_success'));

        return redirect(route('admin.order.edit', ["order" => $order]));
    }

    public function updateOrderDeliveryInfo(Order $order, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'delivery_address' => 'required',
            'delivery_time' => 'required',
        ], [
            'delivery_address.required' => __('order.delivery_address_required'),
            'delivery_time.required' => __('order.delivery_time_required'),
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.order.edit', ["order" => $order]))
                ->withErrors($validator)
                ->withInput();
        }

        $attributes = $validator->validated();
        $order->update($attributes);

        session()->flash("success_message", __('order.delivery_info_success'));

        return redirect(route('admin.order.edit', ["order" => $order]));
    }

    public function updateOrderNote(Order $order, Request $request)
    {
        $order->update([
            "note" => request()->note ?? null
        ]);

        session()->flash("success_message", __('order.note_success'));

        return redirect(route('admin.order.edit', ["order" => $order]));
    }

    public function delete(Order $order)
    {
        return view('admin.order.delete', [
            "item" => $order
        ]);
    }

    public function destroy(Order $order)
    {

        session()->flash("success_message", __('order.delete_success', [
            "id" => $order->id
        ]));

        $order = Order::where("id", "=", $order->id)->with(["user", "orderState"])->first();

        $order->update([
            "order_state_id" => Settings::first()->order_deleted_state_id
        ]);

        Mail::to($order->user)->send(new OrderStateUpdated($order->user, $order->id, Settings::first()->orderDeletedState->name));


        return redirect(route('admin.order.list'));
    }
}
