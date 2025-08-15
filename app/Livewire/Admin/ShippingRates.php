<?php

namespace App\Livewire\Admin;

use App\Models\Country;
use App\Models\ShippingFee;
use Flux\Flux;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]

class ShippingRates extends Component
{
    use WithPagination;
    public $state = null;
    public $base_fee = null;
    public $country = null;
    public $shippingRateId = null;

    public $selectedCountry = null;
    public $search = null;

    #[On('edit-rate')]
    public function editCountry($mode, $shippingRate)
    {
        $shippingRate = ShippingFee::with('country')->findOrFail($shippingRate);
        if ($shippingRate) {
            $this->state = $shippingRate->state;
            $this->base_fee = $shippingRate->base_fee;
            $this->country = $shippingRate->country->slug;
            $this->shippingRateId = $shippingRate->id;
        } else {
            dd('nothing');
        }
    }
    protected function unmask($value)
    {
        return (float) str_replace([',', ' '], '', $value);
    }

    public function updateRate()
    {
        $rate = ShippingFee::findOrFail($this->shippingRateId);
        if ($rate) {
            $this->base_fee = $this->unmask($this->base_fee);
            $validated = $this->validate([
                'country' => 'required|exists:countries,slug|max:255',
                'state' => "required|regex:/^[a-zA-Z0-9\s\.,'&]+$/|max:255",
                'base_fee' => 'required|numeric|min:0'
            ]);
            $country_id = Country::where('slug', $validated['country'])->value('id');
            $shippingRate = ShippingFee::findOrFail($this->shippingRateId);
            $shippingRate->update([
                'country_id' => $country_id,
                'state' => str($validated['state'])->trim()->title(),
                'base_fee' => str($validated['base_fee'])->trim()
            ]);

            Flux::modal('edit-rate')->close();
            session()->flash('success', 'Shipping rate updated');
            $this->reset();
        }
    }

    #[On('delete-rate')]
    public function confirmingDelete($id)
    {

        $this->shippingRateId = $id;
    }

    public function deleteRate()
    {
        if ($this->shippingRateId) {
            $shippingRate = ShippingFee::findOrFail($this->shippingRateId);
            if ($shippingRate) {
                $shippingRate->delete();
                Flux::modal('delete-rate')->close();
                session()->flash('success', 'Shipping rate deleted');
                $this->reset();
            } else {
                return redirect()->route('admin.rates');
            }
        }
    }

    public function getAllCountries()
    {
        return Country::all();
    }
    public function render()
    {
        $query = ShippingFee::query();

        if (!empty($this->search)) {
            $query->where('state', 'like', '%' . $this->search . '%');
        }
        if (!empty($this->selectedCountry)) {
            $query->where('country_id', $this->selectedCountry);
        }

        $shippingRates = $query->with('country')->latest()->paginate(10);
        $countries = $this->getAllCountries();
        return view('livewire.admin.shipping-rates', [
            'countries' => $countries,
            'shippingRates' => $shippingRates,
        ]);
    }
}
