<?php

namespace App\Livewire\Customer;

use App\Helpers\CartManagement;
use App\Models\Food;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class FoodDetails extends Component
{
    public $slug;
    public $food;
    public $selectedSizeId;
    public $quantity = 1;
    public $relatedFood = [];

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->food = Food::with('prices', 'category')->where('slug', $slug)->firstOrFail();
        $this->selectedSizeId = optional($this->food->prices->first())->id;
        $this->relatedFood = Food::with('prices')
            ->where('category_id', $this->food->category->id)->take(4)
            ->whereNot('slug', $this->slug)
            ->get();
    }

    public function addToCart()
    {
        $this->validate([
            'selectedSizeId' => 'required|exists:sizes,id',
            'quantity' => 'required|integer|min:1|max:100'
        ]);

        $size = $this->food->prices->firstWhere('id', $this->selectedSizeId);
        // dd($this->selectedSizeId, $this->quantity);
        if (!$size) {
            LivewireAlert::title('Error')
                ->text('invalid size selected.')
                ->error()
                ->toast()
                ->timer(3000)
                ->position('center')
                ->show();
            // return;
        }

        $cart_count = CartManagement::addItemToCart($this->food->id, $size->id, $this->quantity);
        $this->dispatch('update-cart-count', cart_count: $cart_count)->to(Navigation::class);
        LivewireAlert::title($this->food->name)
            ->text('successfully updated.')
            ->success()
            ->toast()
            ->timer(3000)
            ->position('center')
            ->show();
    }

    public function addToCartOnly($food_id, $size_id = 'default', $quantity = 1)
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
        return view('livewire.customer.food-details');
    }
}
