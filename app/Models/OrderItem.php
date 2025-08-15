<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'food_id',
        'size_id',
        'quantity',
        'unit_price',
        'total'
    ];

    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}
