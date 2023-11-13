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
        'shipping_costs',
        'order_created_state_id',
        'order_paid_state_id',
        'order_deleted_state_id'
    ];
}
