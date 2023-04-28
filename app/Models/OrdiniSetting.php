<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdiniSetting extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'order_created_state_id',
        'order_paid_state_id'
    ];
}
