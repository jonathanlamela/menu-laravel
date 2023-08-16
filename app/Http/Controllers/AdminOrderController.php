<?php

namespace App\Http\Controllers;

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
            "order_states" => OrderState::all()
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

        return response()->json(["status" => "success"]);
    }

    public function update(Order $order, Request $request)
    {
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
