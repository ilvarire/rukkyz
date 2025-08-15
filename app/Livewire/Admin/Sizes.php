<?php

namespace App\Livewire\Admin;

use App\Models\Size;
use Flux\Flux;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.admin')]

class Sizes extends Component
{
    #[Validate('required|alpha_num|max:100|unique:sizes,label')]
    public $label = null;

    #[Validate('required|alpha-num|max:100|unique:sizes,label')]
    public $editLabel = null;
    public $sizeId = null;

    public function storeSize()
    {
        $validated = $this->validateOnly('label');

        $size = Size::create([
            'label' => str(trim($validated['label']))->title()
        ]);

        session()->flash('success', 'new size created');
        $this->reset();
    }

    public function getAllSizes()
    {
        return Size::all();
    }

    #[On('open-size-modal')]
    public function editSize($mode, $size)
    {
        // dd($mode, $size);
        $size = Size::where('label', $size)->first();
        if ($size) {
            $this->editLabel = $size->label;
            $this->sizeId = $size->id;
        } else {
            dd('nothing');
        }
    }

    public function updateSize()
    {
        $size = Size::findOrFail($this->sizeId);
        $validated = $this->validateOnly('editLabel');
        $size->update([
            'label' => str(trim($validated['editLabel']))->title()
        ]);
        Flux::modal('edit-size')->close();
        session()->flash('success', 'size updated');
        $this->reset();
    }

    #[On('delete-size')]
    public function deleteConfirmation($id)
    {
        $this->sizeId = $id;
    }

    public function deleteSize()
    {
        if ($this->sizeId) {
            $size = $this->getAllSizes()->find($this->sizeId);
            if ($size) {
                $size->delete();
                Flux::modal('delete-size')->close();
                session()->flash('success', 'size deleted successfully!');
                $this->reset();
            } else {
                Flux::modal('delete-size')->close();
                $this->reset();
            }
        }
    }

    public function render()
    {
        $sizes = $this->getAllSizes();
        return view('livewire.admin.sizes', [
            'sizes' => $sizes
        ]);
    }
}
