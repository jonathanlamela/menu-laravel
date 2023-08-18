<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;

class AdminOrderDetailController extends Controller
{

    public function increaseQty(OrderDetail $orderDetail, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ], [
            'id.required' => "Il campo stato ordine è obbligatorio",
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.order.edit', ["order" => $orderDetail->order_id]))
                ->withErrors($validator)
                ->withInput();
        }

        $orderDetail->update([
            "quantity" => $orderDetail->quantity + 1
        ]);


        session()->flash("success_message", "Dettagli ordine aggiornati");

        return redirect(route('admin.order.edit', ["order" => $orderDetail->order_id]));
    }

    public function reduceQty(OrderDetail $orderDetail, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ], [
            'id.required' => "Il campo stato ordine è obbligatorio",
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.order.edit', ["order" => $orderDetail->order_id]))
                ->withErrors($validator)
                ->withInput();
        }

        if ($orderDetail->quantity > 1) {
            $orderDetail->update([
                "quantity" => $orderDetail->quantity - 1
            ]);
        } else {
            $orderDetail->delete();
        }


        session()->flash("success_message", "Dettagli ordine aggiornati");

        return redirect(route('admin.order.edit', ["order" => $orderDetail->order_id]));
    }

    public function removeItem(OrderDetail $orderDetail, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ], [
            'id.required' => "Il campo stato ordine è obbligatorio",
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.order.edit', ["order" => $orderDetail->order_id]))
                ->withErrors($validator)
                ->withInput();
        }

        $orderDetail->delete();


        session()->flash("success_message", "Dettagli ordine aggiornati");

        return redirect(route('admin.order.edit', ["order" => $orderDetail->order_id]));
    }
}
