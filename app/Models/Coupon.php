<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    /** @use HasFactory<\Database\Factories\CouponFactory> */
    use HasFactory;

    protected $fillable = [
        'code',
        'discount_percentage',
        'start_date',
        'end_date'
    ];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
