<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "subtotal",
        "shipping_costs",
        "is_shipping",
        "shipping_address",
        "shipping_datetime",
        "order_status",
        "note",
        "is_paid"
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) =>
            $query->where('id', 'like', '%' . $search . '%')
                ->orWhere('shipping_address', 'like', '%' . $search . '%')
                ->orWhereHas('user', fn ($query) => $query->where('firstname', 'like', '%' . $search . '%')->orWhere('lastname', 'like', '%' . $search . '%'))
        );
    }


    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
