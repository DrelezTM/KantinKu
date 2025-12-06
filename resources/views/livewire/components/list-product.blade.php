<section class="py-16 dark:bg-gray-900/90 transition-colors duration-300" id="menu">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-[#0C2B4E] dark:text-blue-400 mb-4 transition-colors duration-300">
                🍽️ {{ $title }}
            </h2>
            <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto transition-colors duration-300">
                Jelajahi menu favorit yang selalu dinantikan
            </p>
            <div class="w-20 h-1 bg-[#0C2B4E] dark:bg-blue-400 mx-auto mt-4 rounded-full transition-colors duration-300"></div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl border border-gray-100 dark:border-gray-700 transition-all duration-300 hover:-translate-y-2">
                    <!-- Product Image -->
                    <div class="relative h-48 overflow-hidden rounded-t-xl">
                        <img 
                            src="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://source.unsplash.com/300x200/?food,' . Str::slug($product->name) }}" 
                            class="w-full h-full object-cover hover:scale-110 transition-transform duration-300 dark:brightness-90"
                            alt="{{ $product->name }}"
                        >
                        <!-- Category Badge -->
                        <span class="absolute top-3 left-3 bg-[#FFD700] text-[#0C2B4E] dark:text-gray-900 px-2 py-1 text-xs font-bold rounded-full transition-colors duration-300">
                            {{ $product->category->name }}
                        </span>
                    </div>

                    <!-- Product Info -->
                    <div class="p-4">
                        <h3 class="font-bold text-lg text-[#0C2B4E] dark:text-white mb-2 line-clamp-1 transition-colors duration-300">
                            {{ $product->name }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 text-sm mb-3 line-clamp-2 transition-colors duration-300">
                            {{ $product->description }}
                        </p>
                        
                        <!-- Price & Button -->
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-[#0C2B4E] dark:text-blue-400 text-lg transition-colors duration-300">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </span>
                            <button 
                                wire:click="$dispatch('openProductDetail', { productId: {{ $product->id }} })"
                                class="px-3 py-1.5 bg-[#0C2B4E] dark:bg-blue-600 text-white text-sm rounded-lg hover:bg-[#163e6d] dark:hover:bg-blue-700 transition-colors duration-300"
                            >
                                Detail
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- View All Button -->
        @if($showViewAll)
            <div class="text-center mt-8">
                <a 
                    href="/products" 
                    class="inline-flex items-center px-6 py-3 bg-[#0C2B4E] dark:bg-blue-600 text-white font-semibold rounded-lg hover:bg-[#163e6d] dark:hover:bg-blue-700 transition-colors duration-300 shadow-lg"
                >
                    Lihat Semua Menu
                    <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
            </div>
        @endif
    </div>
</section>