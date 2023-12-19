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

    protected static function booted()
    {

        static::created(function ($orderDetail) {

            $order = Order::where("id", $orderDetail->order_id)->with('orderDetails')->first();
            $total = 0;

            foreach ($order->orderDetails as $row) {
                $total += $row->unit_price * $row->quantity;
            }
            $order->update([
                "total" => $total
            ]);
        });

        static::updated(function ($orderDetail) {

            $order = Order::where("id", $orderDetail->order_id)->with('orderDetails')->first();
            $total = 0;

            foreach ($order->orderDetails as $row) {
                $total += $row->unit_price * $row->quantity;
            }
            $order->update([
                "total" => $total
            ]);
        });

        static::deleted(function ($orderDetail) {

            $order = Order::where("id", $orderDetail->order_id)->with('orderDetails')->first();
            $total = 0;

            foreach ($order->orderDetails as $row) {
                $total += $row->unit_price * $row->quantity;
            }
            $order->update([
                "total" => $total
            ]);
        });
    }


    public function food()
    {
        return $this->hasOne(Food::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
