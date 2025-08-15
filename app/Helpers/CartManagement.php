<?php

namespace App\Helpers;

use App\Models\Food;
use App\Models\FoodPrice;
use App\Models\Size;
use Illuminate\Support\Facades\Cookie;

class CartManagement
{
    static public function addCartItemsToCookie($cart_items)
    {
        Cookie::queue('cart_items', json_encode($cart_items), 60 * 24 * 30);
    }

    static public function clearCartItems()
    {
        Cookie::queue(Cookie::forget('cart_items'));
    }

    static public function getCartItemsFromCookie()
    {
        $cart_items = json_decode(Cookie::get('cart_items'), true);
        if (!$cart_items) {
            $cart_items = [];
        }
        // Validate cart items
        $validatedCart = [];
        foreach ($cart_items as $item) {
            $food = Food::find($item['food_id']);
            $sizePrice = FoodPrice::where('food_id', $item['food_id'])
                ->where('size_id', $item['size_id'])->first();

            if ($food && $sizePrice) {
                $validatedCart[] = [
                    'food_id' => $food->id,
                    'name' => $food->name,
                    'image_url' => $food->image_url,
                    'size_id' => $item['size_id'],
                    'size' => $item['size'],
                    'quantity' => max(1, (int) $item['quantity']),
                    'unit_price' => $sizePrice->price,
                    'total_amount' => $sizePrice->price * max(1, (int) $item['quantity'])
                ];
            }
        }
        return $validatedCart;
    }

    static public function addItemToCart($food_id, $size_id, $quantity = 1)
    {
        $food = Food::with('prices')
            ->where('id', $food_id)->firstOrFail(['id', 'name', 'image_url']);
        $size = Size::findOrFail($size_id);
        $price = $food->prices->where('size_id', $size_id)->first();
        if (! $price) {
            return redirect()->route('home');
        }

        $cart_items = self::getCartItemsFromCookie();
        $existing_item = null;

        foreach ($cart_items as $key => $item) {
            if ($item['food_id'] == $food_id) {
                $existing_item = $key;
                break;
            }
        }

        // dd($food);

        if ($existing_item !== null) {
            $cart_items[$existing_item]['quantity'] = $quantity;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] *
                $price->price;
        } else {
            $cart_items[] = [
                'food_id' => $food_id,
                'size_id' => $size_id,
                'name' => $food->name,
                'image_url' => $food->image_url,
                'size' => $size->label,
                'quantity' => $quantity,
                'unit_price' => $price->price,
                'total_amount' => $quantity * $price->price
            ];
            // dd($food, $price, $size, $cart_items);
        }

        self::addCartItemsToCookie($cart_items);
        return count($cart_items);
    }


    static public function removeCartItem($food_id)
    {
        Food::findOrFail($food_id);
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['food_id'] === $food_id) {
                unset($cart_items[$key]);
                break;
            }
        }

        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    static public function incrementQuantityToCartItem($food_id)
    {
        Food::findOrFail($food_id);
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['food_id'] == $food_id) {
                $cart_items[$key]['quantity']++;
                $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_price'];
            }
        }
        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    static public function decrementQuantityToCartItem($food_id)
    {
        Food::findOrFail($food_id);
        $cart_items = self::getCartItemsFromCookie();
        foreach ($cart_items as $key => $item) {
            if ($item['food_id'] == $food_id) {
                if ($cart_items[$key]['quantity'] > 1) {
                    $cart_items[$key]['quantity']--;
                    $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_price'];
                }
            }
        }
        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    static public function updateCartSize($index, $newSizeId, $priceData)
    {
        $cart_items = self::getCartItemsFromCookie();
        $cart_items[$index]['size_id'] = $newSizeId;
        $cart_items[$index]['size'] = $priceData->size->label;
        $cart_items[$index]['unit_price'] = $priceData->price;
        $cart_items[$index]['total_amount'] = $priceData->price * $cart_items[$index]['quantity'];

        self::addCartItemsToCookie($cart_items);
    }

    static public function calculateGrandTotal($items)
    {
        return array_sum(array_column($items, 'total_amount'));
    }
}
