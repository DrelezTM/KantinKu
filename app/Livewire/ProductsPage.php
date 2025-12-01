<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ProductsPage extends Component
{
    public $category_id = '';

    public function render()
    {
        // Jika ada kategori yang dipilih, filter by kategori
        if ($this->category_id) {
            $products = Product::where('category_id', $this->category_id)->get();
        } else {
            // Jika tidak, tampilkan semua produk
            $products = Product::all();
        }

        $categories = Category::all();

        return view('livewire.products', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
