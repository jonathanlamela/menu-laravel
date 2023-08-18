<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderState;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class AdminOrderController extends Controller
{
    public function list()
    {
        $orderBy = request("orderBy") ?? "id";
        $ascending_value = request("ascending", 'true');
        $ascending = $ascending_value === 'true' ? 'asc' : 'desc';

        return Inertia::render("admin/order/AdminOrderListPage", [
            "data" => Order::filter(request(['search']))->with(['user', 'orderState'])->orderBy($orderBy, $ascending)->paginate(request('perPage') ?? 5),
            "search" => request('search', null),
            "orderBy" => $orderBy,
            "ascending" => $ascending_value === "true",
        ]);
    }


    public function edit(Order $order)
    {
        $result =  Order::where("id", "=", $order->id)->with(['user', 'orderState', 'orderDetails'])->first();

        return Inertia::render("admin/order/AdminOrderEditPage", [
            "order" => $result,
            "order_states" => OrderState::all(),
            "foods" => Food::with("category")->get()
        ]);
    }

    public function updateOrderState(Order $order, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'order_state_id' => 'required',
        ], [
            'order_state_id.required' => "Il campo stato ordine è obbligatorio",

        ]);

        if ($validator->fails()) {
            return redirect(route('admin.order.edit', ["order" => $order]))
                ->withErrors($validator)
                ->withInput();
        }


        $attributes = $validator->validated();

        $order->update(["order_state_id" => $attributes["order_state_id"]]);

        session()->flash("success_message", "Stato ordine aggiornato");

        return redirect(route('admin.order.edit', ["order" => $order]));
    }

    public function updateOrderDeliveryType(Order $order, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'delivery_type' => 'required',
        ], [
            'delivery_type.required' => "Il campo stato ordine è obbligatorio",
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.order.edit', ["order" => $order]))
                ->withErrors($validator)
                ->withInput();
        }

        $attributes = $validator->validated();

        $data = [
            "is_shipping" => $attributes["delivery_type"] === 'DOMICILIO',
            "delivery_address" => $attributes["delivery_type"] === 'DOMICILIO' ? $order->delivery_address : null,
            "delivery_time" => $attributes["delivery_type"] === 'DOMICILIO' ? $order->delivery_time : null
        ];

        $order->update($data);

        session()->flash("success_message", "Tipo di consegna aggiornato");

        return redirect(route('admin.order.edit', ["order" => $order]));
    }

    public function addOrderDetail(Order $order, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
        ], [
            'name.required' => "Il campo stato ordine è obbligatorio",
            'price.required' => "Il campo stato ordine è obbligatorio",
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

        session()->flash("success_message", "Elemento aggiunto all'ordine");

        return redirect(route('admin.order.edit', ["order" => $order]));
    }

    public function updateOrderDeliveryInfo(Order $order, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'delivery_address' => 'required',
            'delivery_time' => 'required',
        ], [
            'delivery_address.required' => "Il campo stato ordine è obbligatorio",
            'delivery_time.required' => "Il campo stato ordine è obbligatorio",
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.order.edit', ["order" => $order]))
                ->withErrors($validator)
                ->withInput();
        }

        $attributes = $validator->validated();
        $order->update($attributes);

        session()->flash("success_message", "Informazioni consegna aggiornate");

        return redirect(route('admin.order.edit', ["order" => $order]));
    }

    public function updateOrderNote(Order $order, Request $request)
    {
        $order->update([
            "note" => request()->note ?? null
        ]);

        session()->flash("success_message", "Note ordine aggiornate");

        return redirect(route('admin.order.edit', ["order" => $order]));
    }

    public function delete(Order $order)
    {
        return view('admin/order/delete', [
            "item" => $order
        ]);
    }

    public function destroy(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ],);

        if ($validator->fails()) {
            return redirect(route('admin.order.list'))
                ->withErrors($validator)
                ->withInput();
        }

        $id = $validator->validated()['id'];

        $order = Order::find($id);

        foreach ($order->order_details as $detail) {
            OrderDetail::destroy($detail->id);
        }

        session()->flash("success_message", "Ordine " . $order->id . " eliminato");


        Order::destroy($id);
        return redirect(route('admin.order.list'));
    }
}
