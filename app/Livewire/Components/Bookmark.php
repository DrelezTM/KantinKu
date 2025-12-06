<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Bookmark extends Component
{
    use WithPagination;

    public $totalBookmarks;
    public $foodBookmarks;
    public $drinkBookmarks;

    public function toggleBookmark($id)
    {
        if (!Auth::check()) {
            session()->flash('error', 'Anda harus login terlebih dahulu!');
            return;
        }

        $existingBookmark = \App\Models\Bookmark::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->first();

        if ($existingBookmark) {
            $existingBookmark->delete();
            $this->isBookmarked = false;
            $this->bookmarkedText = "Simpan";
            session()->flash('message', 'Produk dihapus dari bookmark!');
        } else {
            \App\Models\Bookmark::create([
                'user_id' => Auth::id(),
                'product_id' => $id,
                'created_at' => now()
            ]);
            $this->isBookmarked = true;
            $this->bookmarkedText = "Tersimpan";
            session()->flash('message', 'Produk ditambahkan ke bookmark!');
        }
    }

    public function mount()
    {
        $userId = Auth::id();

        $this->totalBookmarks = \App\Models\Bookmark::where('user_id', $userId)->count();

        $this->foodBookmarks = \App\Models\Bookmark::where('user_id', $userId)->whereHas('product.category', function($q) {
            $q->where('name', 'Makanan');
        })->count();

        $this->drinkBookmarks = \App\Models\Bookmark::where('user_id', $userId)->whereHas('product.category', function($q) {
            $q->where('name', 'Minuman');
        })->count();
    }

    public function render()
    {
        $bookmarks = \App\Models\Bookmark::where('user_id', Auth::id())->with('product.category')->paginate(12);

        return view('livewire.components.bookmark', [
            'bookmarks' => $bookmarks
        ]);
    }
}
