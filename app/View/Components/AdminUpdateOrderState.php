<?php

namespace App\View\Components;

use App\Models\Order;
use App\Models\OrderState;

use Illuminate\View\Component;

class AdminUpdateOrderState extends Component
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
        return view('components.admin-update-order-state', [
            "order_states" => OrderState::all(),
            "order" => $this->order
        ]);
    }
}
