<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;

class ProductsPage extends Component
{
    use WithPagination;

    public $categories;
    public $selectedCategory = null;
    public $search = '';

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function selectCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Product::query()->with('category');

        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $products = $query->paginate(12);

        return view('livewire.products', [
            'products' => $products,
        ]);
    }
}
