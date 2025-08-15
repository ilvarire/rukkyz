<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingFee extends Model
{
    /** @use HasFactory<\Database\Factories\ShippingFeeFactory> */
    use HasFactory;

    protected $fillable = [
        'country_id',
        'state',
        'base_fee',
        'est_delivery_time'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function shippingAddresses()
    {
        return $this->hasMany(ShippingAddress::class);
    }
}
