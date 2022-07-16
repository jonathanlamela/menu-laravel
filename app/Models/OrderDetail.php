<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        "order_id",
        "food_id",
        "price",
        "quantity",
        "name"
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
