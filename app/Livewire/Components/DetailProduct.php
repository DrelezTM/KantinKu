<?php

namespace App\Livewire\Components;

use App\Models\Bookmark;
use App\Models\Like;
use App\Models\Product;
use App\Models\Visit;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DetailProduct extends Component
{
    public $product;
    public $showModal = false;
    public $showPaymentModal = false;
    public $quantity = 1;

    public $isLiked, $likedCount = 0;
    public $isBookmarked, $bookmarkedText = "Simpan";

    protected $listeners = ['openProductDetail' => 'openDetail'];

    public function openDetail($productId)
    {
        $this->product = Product::with('category')->find($productId);
        
        if (!$this->product) {
            return;
        }
        
        $this->showModal = true;
        $this->quantity = 1;
        $this->showPaymentModal = false;

        $this->isLiked = Auth::check() 
        ? Like::where('user_id', Auth::id())
              ->where('product_id', $productId)
              ->exists()
        : false;

        $this->isBookmarked = Auth::check() 
        ? Bookmark::where('user_id', Auth::id())
              ->where('product_id', $productId)
              ->exists()
        : false;

        $this->likedCount = Like::where('product_id', $productId)
            ->count();

        $ip = request()->ip();
        Visit::create([
            'product_id' => $this->product->id,
            'ip_address' => $ip,
            'created_at' => now()
        ]);
    }

    public function closeDetail()
    {
        $this->showModal = false;
        $this->product = null;
        $this->quantity = 1;
        $this->showPaymentModal = false;
    }

    public function addToCart()
    {
        session()->flash('message', $this->product->name . ' berhasil ditambahkan ke keranjang!');
        $this->closeDetail();
    }

    public function showPayment()
    {
        $this->showPaymentModal = true;
    }

    public function hidePayment()
    {
        $this->showPaymentModal = false;
    }

    public function mount()
    {
        $this->checkIfLiked();
    }

    public function checkIfLiked()
    {
        if (Auth::check() && $this->product) {
            $this->isLiked = Like::where('user_id', Auth::id())
                ->where('product_id', $this->product->id)
                ->exists();
        } else {
            $this->isLiked = false;
        }
    }

    public function checkIfBookmarked()
    {
        if (Auth::check() && $this->product) {
            $this->isBookmarked = Bookmark::where('user_id', Auth::id())
                ->where('product_id', $this->product->id)
                ->exists();
        } else {
            $this->isBookmarked = false;
        }
    }

    public function toggleLike($id)
    {
        if (!Auth::check()) {
            session()->flash('error', 'Anda harus login terlebih dahulu!');
            return;
        }

        $existingLike = Like::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->first();

        if ($existingLike) {
            $existingLike->delete();
            $this->isLiked = false;
            $this->likedCount -= 1;
            session()->flash('message', 'Produk dihapus dari favorit!');
        } else {
            Like::create([
                'user_id' => Auth::id(),
                'product_id' => $id,
                'created_at' => now()
            ]);
            $this->isLiked = true;
            $this->likedCount += 1;
            session()->flash('message', 'Produk ditambahkan ke favorit!');
        }
    }

    public function toggleBookmark($id)
    {
        if (!Auth::check()) {
            session()->flash('error', 'Anda harus login terlebih dahulu!');
            return;
        }

        $existingBookmark = Bookmark::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->first();

        if ($existingBookmark) {
            $existingBookmark->delete();
            $this->isBookmarked = false;
            $this->bookmarkedText = "Simpan";
            session()->flash('message', 'Produk dihapus dari bookmark!');
        } else {
            Bookmark::create([
                'user_id' => Auth::id(),
                'product_id' => $id,
                'created_at' => now()
            ]);
            $this->isBookmarked = true;
            $this->bookmarkedText = "Tersimpan";
            session()->flash('message', 'Produk ditambahkan ke bookmark!');
        }
    }
}
