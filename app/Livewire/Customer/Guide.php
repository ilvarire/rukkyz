<?php

namespace App\Livewire\Customer;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class Guide extends Component
{
    public function render()
    {
        return view('livewire.customer.guide');
    }
}
