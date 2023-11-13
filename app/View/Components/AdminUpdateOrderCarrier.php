<?php

namespace App\View\Components;

use App\Models\Carrier;
use Illuminate\View\Component;
use App\Models\Order;

class AdminUpdateOrderCarrier extends Component
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
        return view('components.admin-update-order-carrier', [
            "order" => $this->order,
            "carriers" => Carrier::get()
        ]);
    }
}
