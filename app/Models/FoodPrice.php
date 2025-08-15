<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodPrice extends Model
{
    protected $fillable = [
        'food_id',
        'size_id',
        'price'
    ];

    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }
}
