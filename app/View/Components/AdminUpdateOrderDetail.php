<?php

namespace App\View\Components;

use App\Models\Food;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\View\Component;

class AdminUpdateOrderDetail extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public Order $order)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        $orderDetails = OrderDetail::where("order_id", $this->order->id)->orderBy('name')->get();

        return view('components.admin-update-order-detail', [
            "order" => $this->order,
            "orderDetails" => $orderDetails,
            "foods" => Food::get()
        ]);
    }
}
