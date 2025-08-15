<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;

class FoodService
{
    public static function syncGuestCartToDatabase($user)
    {
        $guestCart = session('guest_cart', []);

        if (!$guestCart || !is_array($guestCart)) return;

        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        foreach ($guestCart as $item) {
            CartItem::updateOrCreate(
                ['cart_id' => $cart->id, 'food_id' => $item['food_id']],
                ['quantity' => (int) $item['quantity']]
            );
        }

        session()->forget('guest_cart');
    }
}