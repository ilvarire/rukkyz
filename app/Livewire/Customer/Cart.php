<?php

namespace App\Livewire\Customer;

use App\Helpers\CartManagement;
use App\Models\Food;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class Cart extends Component
{
    public $cart_items = [];
    public $cart_count = 0;
    public $grand_total = 0;
    protected $listeners = ['update-cart' => 'updateCart'];

    public function mount()
    {
        $this->loadCartItems();
    }
    public function loadCartItems()
    {
        $this->cart_items = CartManagement::getCartItemsFromCookie();
        $this->cart_count = count($this->cart_items);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function removeFromCart($food_id)
    {
        $cart_items = CartManagement::removeCartItem($food_id);
        $cart_count = count($cart_items);
        $this->dispatch('update-cart-count', cart_count: $cart_count)->to(Navigation::class);
        $this->dispatch('update-cart');

        LivewireAlert::title('removed!')
            ->text('successfully removed from cart.')
            ->success()
            ->toast()
            ->timer(3000)
            ->position('center')
            ->show();
    }

    #[On('update-cart-count')]
    public function updateCart()
    {
        $this->loadCartItems();
    }

    public function updateSize($index, $newSizeId)
    {
        // dd($index);
        $food = Food::with('prices.size')->find($this->cart_items[$index]['food_id']);
        $priceData = $food->prices->where('size_id', $newSizeId)->first();
        if ($priceData) {

            CartManagement::updateCartSize($index, $newSizeId, $priceData);

            $this->dispatch('update-cart');

            LivewireAlert::title($food->name)
                ->text('size updated successfully.')
                ->success()
                ->toast()
                ->timer(3000)
                ->position('center')
                ->show();
        }
    }

    public function increaseQty($food_id)
    {
        $this->cart_items = CartManagement::incrementQuantityToCartItem($food_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function decreaseQty($food_id)
    {
        $this->cart_items = CartManagement::decrementQuantityToCartItem($food_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }
    public function render()
    {
        return view('livewire.customer.cart');
    }
}
