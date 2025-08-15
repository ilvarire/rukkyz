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

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->food = Food::with('prices')->where('slug', $slug)->firstOrFail();
        $this->selectedSizeId = optional($this->food->prices->first())->id;
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
    public function render()
    {
        return view('livewire.customer.food-details');
    }
}
