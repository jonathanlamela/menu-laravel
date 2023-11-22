<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_title',
        'site_subtitle',
        'order_created_state_id',
        'order_paid_state_id',
        'order_deleted_state_id'
    ];

    public function orderCreatedState()
    {
        return $this->belongsTo(OrderState::class, "order_created_state_id");
    }

    public function orderPaidState()
    {
        return $this->belongsTo(OrderState::class, "order_paid_state_id");
    }

    public function orderDeletedState()
    {
        return $this->belongsTo(OrderState::class, "order_deleted_state_id");
    }
}
