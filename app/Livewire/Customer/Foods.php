<?php

namespace App\Livewire\Customer;

use App\Helpers\CartManagement;
use App\Models\Category;
use App\Models\Food;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.guest')]
class Foods extends Component
{
    public $search = '';
    public $selectedCategory = null;
    use WithPagination;

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
        $query = Food::query();

        if (!empty($this->search)) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }
        if (!empty($this->selectedCategory)) {
            $query->where('category_id', $this->selectedCategory);
        }

        $foods = $query->with('category')->latest()->paginate(10);

        $categories = Category::all();
        return view('livewire.customer.foods', [
            'foods' => $foods,
            'categories' => $categories
        ]);
    }
}
