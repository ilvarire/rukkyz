<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Food;
use App\Models\FoodPrice;
use App\Models\FoodSize;
use App\Models\Size;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]

class AddFood extends Component
{
    use WithPagination, WithFileUploads;
    public $name = null;
    public $description = null;
    public $category_id = null;
    public $image = null;
    public $prices = [];

    protected function unmask($value)
    {
        return (float) str_replace([',', ' '], '', $value);
    }
    public function storeFood()
    {
        $validated = $this->validate([
            'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:100|unique:food,name',
            'description' => 'required|string|min:5',
            'prices' => 'required|array',
            'prices.*' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|max:5120'
        ]);

        $manager = ImageManager::withDriver(new Driver);
        $img = $manager->read($this->image->getRealPath());
        $width = $img->width();
        $height = $img->height();

        $expectedRatio = 3 / 4;
        $actualRatio = $width / $height;
        $tolerance = 0.02;

        if (abs($actualRatio - $expectedRatio) > $tolerance) {
            $this->addError("image", "Image must have a 3:4 aspect ratio.");
            return;
        }

        $food = Food::create([
            'name' => str(trim($validated['name']))->title(),
            'slug' => Str::slug($validated['name']),
            'description' => str($validated['description'])->trim()->lower()->ucfirst(),
            'category_id' => $validated['category_id'],
            'image_url' => $this->image->store('foods', 'public')
        ]);
        $sizes = $this->getAllSizes();

        foreach ($sizes as $size) {
            if (isset($this->prices[$size->id]) && $this->prices[$size->id] !== null) {
                FoodPrice::Create([
                    'food_id' => $food->id,
                    'size_id' => $size->id,
                    'price' => $this->prices[$size->id]
                ]);
            }
        }
        session()->flash('success', 'New food added');
        $this->reset();
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
        $categories = $this->getAllCategories();
        $sizes = $this->getAllSizes();
        return view('livewire.admin.add-food', [
            'categories' => $categories,
            'sizes' => $sizes
        ]);
    }
}
