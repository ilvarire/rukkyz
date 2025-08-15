<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'country_id',
        'shipping_fee_id',
        'city',
        'address',
        'phone_number',
        'postal_code'
    ];

    public function country()
    {
        return $this->hasOne(Country::class);
    }

    public function shippingFee()
    {
        return $this->belongsTo(ShippingFee::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
