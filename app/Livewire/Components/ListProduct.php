<?php

namespace App\Livewire\Components;

use App\Models\Product;
use Livewire\Component;

class ListProduct extends Component
{
    public $limit = 8;
    public $title = "Menu Populer";
    public $showViewAll = true;

    public function render()
    {
        if ($this->title === "Paling Populer") {
            // Produk terpopuler berdasarkan likes
            $products = Product::with('category')
                ->withCount('likes')
                ->orderBy('likes_count', 'desc')
                ->take($this->limit)
                ->get();
        } elseif ($this->title === "Menu Unggulan") {
            // Produk unggulan random
            $products = Product::with('category')
                ->inRandomOrder()
                ->take($this->limit)
                ->get();
        } else {
            // Default = ambil latest
            $products = Product::with('category')
                ->latest()
                ->take($this->limit)
                ->get();
        }

        return view('livewire.components.list-product', [
            'products' => $products
        ]);
    }
}
