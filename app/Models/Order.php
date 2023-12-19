<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "total",
        "delivery_costs",
        "delivery_address",
        "delivery_time",
        "order_state_id",
        "note",
        "is_paid",
        "carrier_id"
    ];

    protected $appends = ['total_paid'];

    public function getTotalPaidAttribute()
    {
        return $this->total + $this->delivery_costs;
    }


    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) =>
            $query->where('id', 'like', '%' . $search . '%')
                ->orWhere('delivery_address', 'like', '%' . $search . '%')
                ->orWhereHas('user', fn ($query) => $query->where('firstname', 'like', '%' . $search . '%')->orWhere('lastname', 'like', '%' . $search . '%'))
        );
    }

    public function getFormattedPrice()
    {
        return number_format($this->total, 2);
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function carrier()
    {
        return  $this->belongsTo(Carrier::class, "carrier_id");
    }

    public function orderState()
    {
        return $this->belongsTo(OrderState::class, "order_state_id");
    }
}
