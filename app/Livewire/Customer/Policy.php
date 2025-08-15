<?php

namespace App\Livewire\Customer;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class Policy extends Component
{
    public function render()
    {
        return view('livewire.customer.policy');
    }
}
