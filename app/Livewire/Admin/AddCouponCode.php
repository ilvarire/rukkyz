<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]

class AddCouponCode extends Component
{
    public function render()
    {
        return view('livewire.admin.add-coupon-code');
    }
}
