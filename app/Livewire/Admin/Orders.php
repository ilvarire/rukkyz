<?php

namespace App\Livewire\Admin;

use App\Mail\OrderDelivered;
use App\Models\Order;
use Flux\Flux;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('components.layouts.admin')]

class Orders extends Component
{
    public $search = '';
    public $status;
    public $selectedOrder;
    public $orderId;

    #[On('edit-order')]
    public function confirmingEdit($order)
    {
        $order = Order::with('items.food', 'items.size', 'shippingAddress')
            ->where('reference', $order)->firstOrFail();

        $this->selectedOrder = $order;
    }

    public function cancelOrder($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status === 'delivered') {
            session()->flash('error', 'Cannot cancel delivered orders');
            return;
        }
        if ($order->payment_status != 'paid') {
            session()->flash('error', 'Cannot cancel unpaid orders');
            return;
        }
        $order->status = 'cancelled';
        $order->payment_status = 'refunded';
        $order->save();

        session()->flash('success', 'Order cancelled!');
    }

    public function shipOrder($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status !== 'processed') {
            session()->flash('error', 'Only processing orders can be shipped');
            return;
        }

        $order->status = 'shipped';
        $order->save();
        Flux::modal('edit-order')->close();
        $this->reset();
        session()->flash('success', 'Order marked as shipped');
    }

    public function deliverOrder($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status !== 'shipped') {
            session()->flash('error', 'Only shipped orders can be delivered');
            return;
        }

        $order->status = 'delivered';
        $order->save();
        //send order delivered email
        Mail::to($order->user->email)->queue(
            new OrderDelivered($order->reference)
        );
        Flux::modal('edit-order')->close();
        $this->reset();
        session()->flash('success', 'Order marked as delivered');
    }

    #[On('delete-order')]
    public function confirmingDelete($id)
    {
        $this->orderId = $id;
    }

    public function deleteOrder($order)
    {
        if ($this->orderId) {
            $order = Order::findOrFail($this->orderId);
            if ($order) {
                $order->delete();
                Flux::modal('delete-order')->close();
                session()->flash('success', 'Order deleted');
                $this->reset();
            }
        }
    }

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
            ->paginate(10);

        return view('livewire.admin.orders', [
            'orders' => $orders
        ]);
    }
}
