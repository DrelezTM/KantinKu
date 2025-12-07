<div>
    <livewire:components.header />

    <livewire:components.sidebar />

    <main id="main-content" class="pt-24 pl-64 
    smooth-transition min-h-screen">
        <div class="p-6">
            <div class="flex flex-col sm:flex-row 
            justify-between items-start sm:items-center 
            gap-4 mb-8">
                <h2 class="text-2xl font-bold dark:text-white">
                    Products Management
                </h2>
                <a href="{{ route('dashboard.products.create') }}" class="bg-blue-600 hover:bg-blue-700 
                text-white px-4 py-2 rounded-lg flex items-center 
                gap-2 smooth-transition w-full sm:w-auto justify-center">
                    <i class="fa-solid fa-plus"></i>
                    Add Product
                </a>
            </div>

            @if (session()->has('message'))
            <div id="alert-box" 
                @class([
                    'mb-4 px-4 py-3 rounded-lg text-white',
                    'bg-red-600' => session('type') === 'error',
                    'bg-green-600' => session('type') !== 'error'
                ])>
                {{ session('message') }}
            </div>
            @endif

            <div class="bg-white dark:bg-gray-800 rounded-xl 
            shadow-sm border border-gray-100 dark:border-gray-700 
            overflow-hidden smooth-transition">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm 
                                    font-medium text-gray-500 dark:text-gray-300 
                                    uppercase tracking-wider">
                                    Product
                                </th>
                                    <th class="px-6 py-4 text-left text-sm font-medium 
                                    text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Description
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-medium 
                                    text-gray-500 dark:text-gray-300 uppercase 
                                    tracking-wider">Category</th>
                                    <th class="px-6 py-4 text-left text-sm font-medium 
                                    text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Price
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-medium 
                                    text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Visitor
                                </th>
                                    <th class="px-6 py-4 text-center text-sm font-medium 
                                    text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                            @foreach ($products as $product)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 smooth-transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-12 w-12 flex-shrink-0 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <img src={{ asset('/storage/'.$product->image_path ?? '') }} 
                                            alt="{{ $product->name }}" />
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $product->name }}
                                            </div>
                                            <div class="whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                {{ $product->slug }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 
                                    dark:text-gray-400">
                                    {{ $product->description }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 
                                    dark:text-gray-400">
                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                        {{ $product->category->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 
                                    dark:text-white">
                                    {{ 'Rp'.number_format($product->price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 
                                    dark:text-gray-400 text-center">
                                    <span class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400">
                                        {{ $product->visits_count }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-3">
                                        <button wire:click="showProduct({{ $product->id }})" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300 smooth-transition">
                                            <i class="fas fa-eye mr-1"></i> Show
                                        </button>
                                        <a href="{{ route('dashboard.products.edit', $product->id) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 smooth-transition">
                                                <i class="fas fa-edit mr-1"></i> Edit
                                        </a>
                                        <button onclick="if(!confirm('Are you sure you want to delete this product?')) return;" wire:click="delete({{ $product->id }})" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 smooth-transition delete-product-btn">
                                            <i class="fas fa-trash mr-1"></i> Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    @if ($modalVisible)
    <div id="productDetailModal"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-lg">

            <!-- Modal Header -->
            <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                <div class="flex justify-between items-start">

                    <div class="flex items-start space-x-4">
                        <img src="{{ asset('/storage/' . $modalProduct->image_path) }}"
                            class="h-14 w-14 rounded-xl object-cover">
                        <div>
                            <h3 class="text-xl font-bold dark:text-white">
                                {{ $modalProduct->name }}
                            </h3>
                            <p class="text-gray-500 dark:text-gray-400 text-sm">
                                {{ $modalProduct->slug }}
                            </p>
                        </div>
                    </div>

                    <button wire:click="closeModal"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 p-2">
                        <i class="fas fa-times text-lg"></i>
                    </button>

                </div>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <div class="mb-6">
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Description</h4>
                    <p class="text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-900 rounded-xl p-4">
                        {{ $modalProduct->description }}
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-8 items-center">
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Category</h4>
                        <div class="mt-2 px-3 py-1 rounded-full w-fit bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300 flex items-center gap-2">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                            <span>{{ $modalProduct->category->name }}</span>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Price</h4>
                        <div class="text-xl font-bold dark:text-white">
                            Rp{{ number_format($modalProduct->price, 0, ',', '.') }}
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Likes</h4>
                        <div class="mt-2 px-3 py-1 rounded-full w-fit bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300 flex gap-2 items-center">
                            <svg class="w-5 h-5" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                </path>
                            </svg>
                            {{ $likedCount }}
                        </div>
                    </div>


                    <div>
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Liked</h4>
                        <div class="mt-2 px-3 py-1 rounded-full w-fit bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300 flex gap-2 items-center">
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            {{ number_format($modalProduct->ratings_avg_rating, 1) }}
                        </div>
                    </div>

                    <div>
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Visitors</h4>
                        <div class="mt-2 px-3 py-1 rounded-full w-fit bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 flex gap-2 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            {{ $modalProduct->visits_count }}
                        </div>
                    </div>

                    <div>
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Bookmarks</h4>
                        <div class="mt-2 px-3 py-1 rounded-full w-fit bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300 flex gap-2 items-center">
                            <svg class="w-5 h-5" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                            </svg>
                            {{ $bookmarkedCount }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-6 border-t border-gray-100 dark:border-gray-700 flex justify-end">
                <a href="{{ route('dashboard.products.edit', $modalProduct->id) }}" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                    <i class="fas fa-edit mr-1"></i> Edit Product
                </a>
            </div>

        </div>

    </div>
    @endif
</div>