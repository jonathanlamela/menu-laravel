<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "subTotal",
        "shippingCosts",
        "isShipping",
        "shippingAddress",
        "shippingDateTime",
        "orderStatus",
        "note"
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) =>
            $query->where('id', 'like', '%' . $search . '%')
                ->orWhere('shippingAddress', 'like', '%' . $search . '%')
                ->orWhereHas('user', fn ($query) => $query->where('firstname', 'like', '%' . $search . '%')->orWhere('lastname', 'like', '%' . $search . '%'))
        );
    }


    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
