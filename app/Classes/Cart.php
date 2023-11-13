<?php

namespace App\Classes;

class Cart
{
    public $items = [];
    public $delivery_time = "";
    public $delivery_address = "";
    public $carrier_id = null;

    public function total()
    {
        $total = 0;
        foreach ($this->items as $row) {
            $total += $row->price * $row->quantity;
        }

        return $total;
    }
}
