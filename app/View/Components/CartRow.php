<?php

namespace App\View\Components;

use App\Models\Food;
use Illuminate\View\Component;

class CartRow extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public $cartItem, public bool $actions  = true)
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
        return view('components.cart-row');
    }
}
