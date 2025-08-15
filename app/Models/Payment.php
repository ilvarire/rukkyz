<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'order_id',
        'gateway',
        'transaction_reference',
        'amount',
        'status',
        'payment_method',
        'paid_at'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
