<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;


class AdminOrderDetailController extends Controller
{

    public function increaseQty(OrderDetail $orderDetail, Request $request)
    {

        $orderDetail->update([
            "quantity" => $orderDetail->quantity + 1
        ]);


        session()->flash("success_message", "Dettagli ordine aggiornati");

        return redirect(route('admin.order.edit', ["order" => $orderDetail->order_id]));
    }

    public function reduceQty(OrderDetail $orderDetail, Request $request)
    {
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
        $orderDetail->delete();

        session()->flash("success_message", "Dettagli ordine aggiornati");

        return redirect(route('admin.order.edit', ["order" => $orderDetail->order_id]));
    }
}
