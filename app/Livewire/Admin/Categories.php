<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Flux\Flux;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]

class Categories extends Component
{
    use WithFileUploads;
    #[Validate('required|alpha|max:100|unique:categories,name')]
    public $name = null;
    #[Validate('required|image|max:2048')]
    public $image_url = null;

    #[Validate('required|alpha|max:100|unique:categories,name')]
    public $editName = null;
    public $oldImage = null;
    public $editImage = null;
    public $categoryId = null;

    public function storeCategory()
    {
        $validated = $this->validate([
            'name' => 'required|alpha|max:100|unique:categories,name',
            'image_url' => 'required|image|max:2048'
        ]);
        $path = $this->image_url->store('categories', 'public');

        Category::create([
            'name' => str(trim($validated['name']))->title(),
            'slug' => Str::slug($validated['name']),
            'image_url' => $path
        ]);

        session()->flash('success', 'new category created');
        $this->reset();
    }

    public function getAllCategories()
    {
        return Category::all();
    }

    #[On('open-cat-modal')]
    public function editCategory($mode, $category)
    {
        $category = Category::where('slug', $category)->first();
        if ($category) {
            $this->editName = $category->name;
            $this->oldImage = $category->image_url;
            $this->categoryId = $category->id;
        } else {
            return redirect()->route('admin.categories');
        }
    }

    public function updateCategory()
    {
        $category = Category::findOrFail($this->categoryId);
        $validated = $this->validate([
            'editName' => [
                'required',
                'alpha',
                'max:100',
                Rule::unique('categories', 'name')->ignore($category->id)
            ],
            'editImage' => 'nullable|image|max:2048'
        ]);

        $category->update([
            'name' => str(trim($validated['editName']))->title(),
            'slug' => Str::slug($validated['editName'])
        ]);

        if ($this->editImage) {
            $path = $this->editImage->store('categories', 'public');
            $category->update(['image_url' => $path]);
        }

        Flux::modal('edit-category')->close();
        session()->flash('success', 'category updated');
        $this->reset();
    }

    #[On('delete-category')]
    public function deleteConfirmation($id)
    {
        $this->categoryId = $id;
    }

    public function deleteCategory()
    {
        if ($this->categoryId) {
            $category = $this->getAllCategories()->find($this->categoryId);
            if ($category) {
                $category->delete();
                Flux::modal('delete-category')->close();
                session()->flash('success', 'Category deleted successfully!');
                $this->reset();
            } else {
                Flux::modal('delete-category')->close();
                return redirect()->route('admin.categories');
            }
        }
    }

    public function render()
    {
        $categories = $this->getAllCategories();
        return view('livewire.admin.categories', [
            'categories' => $categories
        ]);
    }
}
