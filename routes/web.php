<?php

use App\Livewire\Admin\AddProductPage;
use App\Livewire\Admin\CategoryPage;
use App\Livewire\Admin\EditProductPage;
use App\Livewire\Admin\FeedbackPage;
use App\Livewire\Admin\ProductPage;
use App\Livewire\Admin\ProfilePage;
use App\Livewire\Admin\UserPage;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\BookmarksPage;
use App\Livewire\DashboardPage;
use App\Livewire\IndexPage;
use App\Livewire\ProductsPage;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexPage::class)->name('index');
Route::get('/products', ProductsPage::class)->name('products');
Route::get('/bookmarks', BookmarksPage::class)->name('bookmarks');

Route::get('/register', Register::class)->name('register');
Route::get('/login', Login::class)->name('login');
Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', DashboardPage::class)->name('dashboard');
        Route::get('/dashboard/products', ProductPage::class)->name('dashboard.products');
        Route::get('/dashboard/products/create', AddProductPage::class)->name('dashboard.products.create');
        Route::get('/dashboard/products/edit/{id}', EditProductPage::class)->name('dashboard.products.edit');
        Route::get('/dashboard/categories', CategoryPage::class)->name('dashboard.categories');
        Route::get('/dashboard/profile', ProfilePage::class)->name('dashboard.profile');
        Route::get('/dashboard/users', UserPage::class)->name('dashboard.users');
        Route::get('/dashboard/feedbacks', FeedbackPage::class)->name('dashboard.feedbacks');
    });
});


