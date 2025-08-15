<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]

class Customers extends Component
{
    use WithPagination;

    public $search = null;

    public function render()
    {
        $role = 2;
        $customers = User::where('role', $role)
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('livewire.admin.customers', [
            'customers' => $customers
        ]);
    }
}
