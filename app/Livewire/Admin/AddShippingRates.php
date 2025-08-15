<?php

namespace App\Livewire\Admin;

use App\Models\Country;
use App\Models\ShippingFee;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]

class AddShippingRates extends Component
{
    public $country_id, $state, $base_fee;
    public $countries;

    public function mount()
    {
        $this->countries = Country::all();
    }

    protected function unmask($value)
    {
        return (float) str_replace([',', ' '], '', $value);
    }

    public function storeShippingFee()
    {
        $this->base_fee = $this->unmask($this->base_fee);

        $this->validate([
            'country_id' => 'required|exists:countries,id|max:255',
            'state' => "required|regex:/^[a-zA-Z0-9\s\.,'&]+$/|max:255",
            'base_fee' => 'required|numeric|min:0',
        ]);

        ShippingFee::create([
            'country_id' => $this->country_id,
            'state' => str($this->state)->trim()->title(),
            'base_fee' => str($this->base_fee)->trim()
        ]);

        session()->flash('success', 'Shipping info added successfully');
        $this->reset(['country_id', 'state', 'base_fee']);
    }
    public function render()
    {
        return view('livewire.admin.add-shipping-rates');
    }
}
