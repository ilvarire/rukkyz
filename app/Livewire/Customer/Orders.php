<?php

namespace App\Livewire\Customer;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.guest')]
class Orders extends Component
{
    use WithPagination;
    public function render()
    {
        $orders = Order::with('items.food', 'items.food.size', 'shippingAddress')
            ->where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.customer.orders', [
            'orders' => $orders
        ]);
    }
}
