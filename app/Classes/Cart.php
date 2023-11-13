<?php

namespace App\Classes;

class Cart
{
    public $items = [];
    public $total = 0;
    public $delivery_time = "";
    public $delivery_address = "";
    public $carrier_id = null;
}
