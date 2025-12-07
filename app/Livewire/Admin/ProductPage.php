<?php

namespace App\Livewire\Admin;

use App\Models\Bookmark;
use App\Models\Category;
use App\Models\Like;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class ProductPage extends Component
{   
    public $products, $categories, $productId;
    public $modalVisible = false;
    public $modalProduct, $likedCount, $bookmarkedCount;

    public function showProduct($id)
    {
        $this->modalProduct = Product::with('category')->withCount('visits')->withCount('likes')->withCount('bookmarks')->withAvg('ratings', 'rating')->findOrFail($id);
        $this->likedCount = Like::where('product_id', $id)
            ->count();
        $this->bookmarkedCount = Bookmark::where('product_id', $id)
            ->count();
        $this->modalVisible = true;
    }

    public function mount() {
        $this->products = Product::with('category')->withCount('visits')->get();
        $this->categories = Category::all();
    }

    public function closeModal()
    {
        $this->modalVisible = false;
        $this->mount();
    }

    public function delete($id)
    {
        if (Auth::user()->role !== 'admin') return session()->flash('error', 'You do not have permission to perform this action.');

        $product = Product::find($id);

        if ($product) {
            $product->delete();
            session()->flash('message', 'Product deleted successfully.');

            $this->products = Product::with('category')->withCount('visits')->get();
        } else {
            session()->flash('error', 'Product not found.');
        }
    }

    public function render()
    {
        return view('livewire.admin.product')->layout('components.layouts.dashboard');;
    }
}
