<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class EditProductPage extends Component
{
    use WithFileUploads;
    
    public $products, $categories, $productId, $product;
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
    public $fileSelected = false;

    public function mount($id)
    {
        $this->categories = Category::all();
        $this->product = Product::findOrFail($id);

        if (!$this->product) {
            return redirect()->route('dashboard.products')->with('error', 'Product not found.');
        }

        $this->name        = $this->product->name;
        $this->slug        = $this->product->slug;
        $this->category    = $this->product->category_id;
        $this->price       = $this->product->price;
        $this->description = $this->product->description;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'slug' => 'string|unique:products,slug,',
            'category' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|max:10240'
        ]);

        $imagePath = $this->product->image_path;

        if ($this->image) {
            $imagePath = $this->image->store('products', 'public');
        }

        $this->product->update([
            'name' => $this->name,
            'slug' => strtolower(str_replace(' ', '-', $this->slug)) ?? strtolower(str_replace(' ', '-', $this->name)),
            'category_id' => $this->category,
            'price' => $this->price,
            'description' => $this->description,
            'image_path' => $imagePath
        ]);

        return redirect()->route('dashboard.products')->with('message', 'Product updated successfully.');
    }
    
    public function updatedImage()
    {
        $this->fileSelected = $this->image ? true : false;
    }

    public function render()
    {
        return view('livewire.admin.edit-product-page')->layout('components.layouts.dashboard');
    }
}
