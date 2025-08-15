<?php

namespace App\Livewire\Admin;

use App\Models\Country;
use Flux\Flux;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.admin')]

class Countries extends Component
{
    #[Validate("required|unique:countries|regex:/^[a-zA-Z0-9\s\,&']+$/|max:100")]
    public $name = null;
    #[Validate('required|alpha|unique:countries|max:10')]
    public $code = null;

    public $editName = null;
    public $editCode = null;
    public $countryId = null;

    public function storeCountry()
    {
        $name = $this->validateOnly('name')['name'];
        $code = $this->validateOnly('code')['code'];

        Country::create([
            'name' => str(trim($name))->title(),
            'slug' => Str::slug($name),
            'code' => str($code)->trim()->upper()
        ]);

        session()->flash('success', 'new country created');
        $this->reset();
    }

    #[On('edit-country')]
    public function editCountry($mode, $country)
    {
        $country = Country::where('slug', $country)->first();
        if ($country) {
            $this->editName = $country->name;
            $this->editCode = $country->code;
            $this->countryId = $country->id;
        } else {
            dd('nothing');
        }
    }

    function updateCountry()
    {
        $this->validate([
            'editName' => "required|regex:/^[a-zA-Z0-9\s\,&']+$/|min:2",
            'editCode' => 'required|alpha|unique:countries|max:8',
            'countryId' => 'required|exists:countries,id'
        ]);

        $country = Country::findOrFail($this->countryId);

        $country->update([
            'name' => str($this->editName)->trim()->lower()->title(),
            'code' => str($this->editCode)->trim()->upper(),
            'slug' => Str::slug($this->editName)
        ]);
        Flux::modal('edit-country')->close();
        $this->reset();
        session()->flash('success', 'Country updated!');
    }

    #[On('delete-country')]
    public function confirmingDelete($id)
    {
        $this->countryId = $id;
    }

    public function deleteCountry()
    {
        if ($this->countryId) {
            $country = Country::findOrFail($this->countryId);
            if ($country) {
                $country->delete();
                Flux::modal('delete-country')->close();
                session()->flash('success', 'country deleted');
                $this->reset();
            }
        }
    }

    public function getAllCountries()
    {
        return Country::all();
    }
    public function render()
    {
        $countries = $this->getAllCountries();
        return view('livewire.admin.countries', [
            'countries' => $countries
        ]);
    }
}
