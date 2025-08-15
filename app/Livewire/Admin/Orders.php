<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]

class Orders extends Component
{

    public function render()
    {
        $orders = Order::with('user')
            ->when($this->search, fn($query) =>
            $query->whereHas(
                'user',
                fn($q) =>
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
            ))
            ->when(
                $this->status,
                fn($query) =>
                $query->where('status', $this->status)
            )
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('livewire.admin.orders', [
            'orders' => $orders
        ]);
    }
}
