<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Food as ModelsFood;
use App\Models\FoodPrice;
use App\Models\Size;
use Flux\Flux;
use Illuminate\Support\Number;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]

class Food extends Component
{
    use WithPagination, WithFileUploads;

    public $search = null;
    public $name = null;
    public $foodId = null;
    public $description = null;
    public $category_id = null;
    public $is_special = null;
    public $is_available = null;
    public $is_featured = null;
    public $existingImage = null;
    public $prices = [];
    public $sizes = [];
    public $image = null;
    public $selectedCategory = null;

    public function mount()
    {
        $this->sizes = $this->getAllSizes();
    }

    #[On('edit-food')]
    public function confirmingEdit($food)
    {
        $food = ModelsFood::with('prices')
            ->where('slug', $food)
            ->firstOrFail();

        $this->name = $food->name;
        $this->description = $food->description;
        $this->existingImage = $food->image_url;
        $this->category_id = $food->category->id;
        $this->is_available = $food->is_available;
        $this->is_special = $food->is_special;
        $this->is_featured = $food->is_featured;
        $this->foodId = $food->id;

        foreach ($this->sizes as $size) {
            $existing = $food->prices->where('size_id', $size->id)->first();
            $this->prices[$size->id] = $existing ? $existing->price : null;
        }
    }

    public function updateFood()
    {
        $food = ModelsFood::findOrFail($this->foodId);
        // $this->validate([
        //     'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:100|unique:food,name' . $this->foodId,
        //     'description' => 'required|string|min:5',
        //     'category_id' => 'required|exists:categories,id',
        //     'is_available' => 'boolean',
        //     'is_special' => 'boolean',
        //     'is_featured' => 'boolean',
        //     'image' => 'nullable|image|max:2048'
        // ]);

        $this->validate([
            'name' => [
                'required',
                'regex:/^[a-zA-Z0-9\s]+$/',
                'max:100',
                Rule::unique('food', 'name')->ignore($this->foodId),
            ],
            'description' => [
                'required',
                'string',
                'min:5',
            ],
            'category_id' => [
                'required',
                'exists:categories,id',
            ],
            'is_available' => [
                'boolean',
            ],
            'is_special' => [
                'boolean',
            ],
            'is_featured' => [
                'boolean',
            ],
            'image' => [
                'nullable',
                'image',
                'max:2048',
            ],
        ]);


        $food->update([
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'is_available' => $this->is_available,
            'is_special' => $this->is_special,
            'is_featured' => $this->is_featured
        ]);

        if ($this->image) {
            $path = $this->image->store('food', 'public');
            $food->update(['image_url' => $path]);
        }

        foreach ($this->prices as $sizeId => $price) {
            if ($price !== null && $price !== '') {
                FoodPrice::updateOrCreate(
                    [
                        'food_id' => $food->id,
                        'size_id' => $sizeId
                    ],
                    [
                        'price' => $price
                    ]
                );
            } else {
                FoodPrice::where('food_id', $food->id)
                    ->where('size_id', $sizeId)
                    ->delete();
            }
        }
        Flux::modal('edit-food')->close();
        return redirect()->route('admin.food')->with('success', 'Food updated');
    }

    #[On('delete-food')]
    public function confirmingDelete($id)
    {
        $this->foodId = $id;
    }

    public function deleteFood()
    {
        $food = ModelsFood::findOrFail($this->foodId);
        $food->delete();
        Flux::modal('delete-food')->close();
        return redirect()->route('admin.food')->with('success', 'deleted successfully');
    }

    public function getAllCategories()
    {
        return Category::all();
    }
    public function getAllSizes()
    {
        return Size::all();
    }
    public function render()
    {
        $query = ModelsFood::query();

        if (!empty($this->search)) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }
        if (!empty($this->selectedCategory)) {
            $query->where('category_id', $this->selectedCategory);
        }

        $categories = $this->getAllCategories();
        $food = $query->with('prices.size', 'category')->latest()->paginate(10);

        return view('livewire.admin.food', [
            'categories' => $categories,
            'foods' => $food
        ]);
    }
}
