<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class ProductPage extends Component
{
    use WithFileUploads;
    
    public $products, $categories, $productId;
    #[Validate('required|string|max:255')]
    public $name = '';

    #[Validate('required|exists:categories,id')]
    public $category;

    #[Validate('required|numeric|min:0')]
    public $price;

    #[Validate('required|string|unique:products,slug')]
    public $slug;

    #[Validate('nullable|string|max:1000')]
    public $description;

    #[Validate('nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240')]
    public $image;

    public function mount() {
        $this->products = Product::with('category')->withCount('visits')->get();
        $this->categories = Category::all();
    }

    public function save()
    {
        $imagePath = '';
        if ($this->image) {
            $imagePath = $this->image->store('products', 'public');
        }

        Product::create([
            'name' => $this->name,
            'slug' => strtolower(str_replace(' ', '-', $this->slug)),
            'category_id' => $this->category,
            'description' => $this->description,
            'price' => $this->price,
            'image_path' => $imagePath
        ]);

        session()->flash('message', 'Product added successfully.');
        $this->products = Product::with('category')->get();
    }

    public function edit($id)
    {
        $product = Product::with('category')->find($id);

        if (!$product) {
            session()->flash('error', 'Product not found.');
            return;
        }

        $this->productId = $product->id;
        $this->name = $product->name;
        $this->slug = strtolower(str_replace(' ', '-', $product->slug));
        $this->category = $product->category_id;
        $this->price = $product->price;
        $this->description = $product->description;

        $this->dispatch('openEditProductModal'); 
    }

    public function update()
    {
        $imagePath = $this->image ? $this->image->store('products', 'public') : $this->image;

        $product = Product::find($this->productId);
        if ($product) {
            $product->name = $this->name;
            $product->category_id = $this->category;
            $product->slug = strtolower(str_replace(' ', '-', $this->slug));
            $product->price = $this->price;
            $product->description = $this->description;
            $product->image_path = $imagePath;

            $product->save();

            session()->flash('message', 'Product updated successfully.');
            $this->resetFields();
            $this->dispatchBrowserEvent('closeEditProductModal');
            $this->products = Product::with('category')->get();
        }
    }

    public function delete($id)
    {
        if (Auth::user()->role !== 'admin') return session()->flash('error', 'You do not have permission to perform this action.');

        $product = Product::find($id);

        if ($product) {
            $product->delete();
            session()->flash('message', 'Product deleted successfully.');

            $this->products = Product::with('category')->get();
        } else {
            session()->flash('error', 'Product not found.');
        }
    }

    public function render()
    {
        return view('livewire.admin.product')->layout('components.layouts.dashboard');;
    }
}
