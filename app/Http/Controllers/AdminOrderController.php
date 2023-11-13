<?php

namespace App\Http\Controllers;

use App\Mail\OrderStateUpdated;
use App\Models\Carrier;
use App\Models\Food;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderState;
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
            'order_state_id.required' => "Il campo stato ordine è obbligatorio",

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
            "delivery_address" => $order->delivery_address ?? null,
            "delivery_time" =>  $order->delivery_time ?? null
        ];

        $order->update($data);

        session()->flash("success_message", "Tipo di consegna aggiornato");

        return redirect(route('admin.order.edit', ["order" => $order]));
    }

    public function updateOrderCarrier(Order $order, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'carrier_id' => 'required',
        ], [
            'carrier_id.required' => "Il campo corriere è obbligatorio",
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.order.edit', ["order" => $order]))
                ->withErrors($validator)
                ->withInput();
        }

        $attributes = $validator->validated();

        $carrier = Carrier::where("id", $attributes["carrier_id"])->first();

        print_r($carrier);

        $data = [
            "carrier_id" => $carrier->id,
            "delivery_costs" => $carrier->costs
        ];

        $order->update($data);

        session()->flash("success_message", "Corriere aggiornato");

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
        return view('admin.order.delete', [
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
