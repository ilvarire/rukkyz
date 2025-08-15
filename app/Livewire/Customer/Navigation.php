<?php

namespace App\Livewire\Customer;

use App\Helpers\CartManagement;
use Livewire\Attributes\On;
use Livewire\Component;

class Navigation extends Component
{
    public int $cart_count = 0;
    public function mount()
    {
        $this->cart_count = count(CartManagement::getCartItemsFromCookie());
    }

    #[On('update-cart-count')]
    public function updateCartCount($cart_count)
    {
        // dd($cart_count);
        $this->cart_count = $cart_count;
    }
    public function render()
    {
        return view('livewire.customer.navigation');
    }
}
