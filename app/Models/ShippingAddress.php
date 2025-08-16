<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $fillable = [
        'user_id',
        'country_id',
        'shipping_fee_id',
        'address',
        'city',
        'phone_number',
        'state',
        'zip_code'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
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
