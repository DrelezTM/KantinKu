<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CategoryPage extends Component
{
    public $categories;

    #[Validate('required|string|max:255')]
    public $name;

    #[Validate('required|string|unique:categories,slug')]
    public $slug;

    public function mount() {
        $this->categories = Category::withCount('products')->get();
    }

    public function save()
    {
        Category::create([
            'name' => $this->name,
            'slug' => strtolower(str_replace(' ', '-', $this->slug))
        ]);

        session()->flash('message', 'Category added successfully.');
        $this->categories = Category::withCount('products')->get();
    }

    public function delete($id)
    {
        if (Auth::user()->role !== 'admin') return session()->flash('error', 'You do not have permission to perform this action.');

        $product = Category::find($id);

        if ($product) {
            $product->delete();
            session()->flash('message', 'Category deleted successfully.');

            $this->categories = Category::withCount('products')->get();
        } else {
            session()->flash('error', 'Category not found.');
        }
    }

    public function render()
    {
        return view('livewire.admin.category')->layout('components.layouts.dashboard');
    }
}
