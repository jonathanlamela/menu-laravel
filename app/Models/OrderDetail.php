<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        "order_id",
        "price",
        "quantity",
        "name",
        "unit_price"
    ];

    public function food()
    {
        return $this->hasOne(Food::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
