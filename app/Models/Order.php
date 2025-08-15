<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'reference',
        'user_id',
        'session_id',
        'shipping_address_id',
        'total_price',
        'note',
        'status',
        'payment_status',
        'placed_at',
        'delivered_at',
        'coupon_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function shippingAddress()
    {
        return $this->belongsTo(ShippingAddress::class);
    }

    public function shippingFee()
    {
        return $this->hasOneThrough(ShippingAddress::class, ShippingAddress::class);
    }
    public function country()
    {
        return $this->hasOneThrough(Country::class, ShippingFee::class, 'id', 'id', 'id', 'country_id');
    }
}
