<?php

namespace App\Livewire\Admin\Layout;

use App\Models\Order;
use Livewire\Component;

class Header extends Component
{
    public function render()
    {
        $pendingOrders = Order::where('status', 'processed')->count();;
        return view('livewire.admin.layout.header', [
            'pendingOrders' => $pendingOrders
        ]);
    }
}
