<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class AddProductPage extends Component
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
    public $fileSelected = false;

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

        return redirect()->route('dashboard.products')->with('message', 'Product added successfully.');
    }

    public function updatedImage()
    {
        $this->fileSelected = $this->image ? true : false;
    }

    public function mount() {
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.admin.add-product-page')->layout('components.layouts.dashboard');
    }
}
