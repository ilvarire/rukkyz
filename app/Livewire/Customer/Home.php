<?php

namespace App\Livewire\Customer;

use App\Helpers\CartManagement;
use App\Models\Category;
use App\Models\Food;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class Home extends Component
{
    public function addToCart($food_id, $size_id = 'default', $quantity = 1)
    {
        $food = Food::with('prices')
            ->where('id', $food_id)->firstOrFail();

        if ($size_id === 'default') {
            $size_id = $food->prices->first()->size_id;
        }
        $cart_count = CartManagement::addItemToCart($food_id, $size_id, $quantity);
        $this->dispatch('update-cart-count', cart_count: $cart_count)->to(Navigation::class);
        LivewireAlert::title($food->name)
            ->text('successfully added to cart.')
            ->success()
            ->toast()
            ->timer(3000)
            ->position('center')
            ->show();
    }
    public function render()
    {
        $categories = Category::inRandomOrder()->take(3)->get();
        $specialFood = Food::with('prices')
            ->where('is_special', true)->inRandomOrder()->take(4)
            ->get();
        return view('livewire.customer.home', [
            'categories' => $categories,
            'specialFood' => $specialFood
        ]);
    }
}
