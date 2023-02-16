<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class AdminOrderController extends Controller
{
    public function list()
    {
        return Inertia::render('admin/order/OrderListPage', [
            "items" => Order::filter(request(['search']))->paginate(request('elementsPerPage') ?? 5),
            "elementsPerPage" => request('elementsPerPage') ?? 5
        ]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function edit(Order $order)
    {
    }

    public function update(Order $order, Request $request)
    {
    }

    public function delete(Order $order)
    {
        return Inertia::render('AdminOrderDeletePage', [
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

        foreach ($order->orderDetails as $detail) {
            OrderDetail::destroy($detail->id);
        }

        session()->flash("success_message", "Ordine " . $order->id . " eliminato");


        Order::destroy($id);
        return redirect(route('admin.order.list'));
    }
}
