<div>
    <livewire:components.navbar />

    <div>
        <main class="pb-20" style="background-image: url('/images/bg.png'); background-size: cover; background-position: center;">
            <section id="menu" class="py-20">
                <div class="max-w-7xl mx-auto px-6">
                    <!-- Judul -->
                    <div class="text-center mb-14 bg-[#0C2B4E] rounded-2xl p-8 hover:shadow-2xl">
                        <h2 class="text-4xl font-extrabold text-white mb-3">🍴 Daftar Menu</h2>
                        <p class="text-white max-w-2xl mx-auto">
                            Temukan beragam makanan dan minuman favoritmu dari kantin dengan cita rasa terbaik!
                        </p>
                        <div class="w-24 h-1 bg-white mx-auto mt-4 rounded-full"></div>
                    </div>

                    <div class="flex flex-col lg:flex-row gap-10">
                        <!-- Sidebar -->
                        <aside class="w-full lg:w-72">
                            <div class="bg-white rounded-2xl p-6 shadow-xl border border-gray-200 sticky top-24">
                                <!-- Search -->
                                <label class="block text-sm font-semibold mb-2 text-gray-800">Cari Menu</label>
                                <div class="relative mb-6">
                                    <input type="text" placeholder="Cari produk..." class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0C2B4E] focus:outline-none" wire:model.live.debounce.500ms="search">
                                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-gray-400"></i>
                                </div>
                                <!-- Kategori -->
                                <h3 class="font-bold text-lg mb-3 text-[#0C2B4E]">Kategori</h3>
                                <div class="space-y-2">
                                    <button wire:click="selectCategory(null)" class="w-full text-left px-4 py-2 rounded-lg {{ is_null($selectedCategory) ? 'bg-[#0C2B4E] text-white' : 'hover:bg-gray-100 text-gray-700' }} font-semibold shadow transition">Semua</button>
                                    @foreach ($categories as $category)
                                        <button wire:click="selectCategory({{ $category->id }})" class="w-full text-left px-4 py-2 rounded-lg {{ $selectedCategory === $category->id ? 'bg-[#0C2B4E] text-white' : 'hover:bg-gray-100 text-gray-700' }} transition font-medium">
                                            {{ $category->name }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </aside>

                        <!-- Grid Produk Sederhana -->
                        <div class="flex-1">
                            <div class="mb-6 text-gray-600"> Menampilkan <span class="font-bold text-[#0C2B4E]">{{ $products->count() }}</span> produk </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                                @foreach ($products as $product)
                                    <!-- Card Produk Sederhana -->
                                    <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl border border-gray-100 transition transform hover:-translate-y-2">
                                        <div class="relative h-56 overflow-hidden">
                                            <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://source.unsplash.com/400x300/?food,' . Str::slug($product->name) }}" 
                                                class="object-cover w-full h-full hover:scale-110 transition-transform duration-300" />
                                            <span class="absolute top-3 left-3 bg-[#FFD700] text-[#0C2B4E] px-3 py-1 text-xs font-bold rounded-full shadow">{{ $product->category->name }}</span>
                                        </div>
                                        <div class="p-5">
                                            <h3 class="font-bold text-lg text-[#0C2B4E] mb-2">{{ $product->name }}</h3>
                                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $product->description }}</p>
                                            <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                                                <span class="font-bold text-[#0C2B4E] text-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                                <button wire:click="$dispatch('openProductDetail', { productId: {{ $product->id }} })"
                                                        class="px-4 py-1.5 bg-[#0C2B4E] text-white rounded-lg hover:bg-[#163e6d] transition shadow">
                                                    Lihat Detail
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

    </div>

    <livewire:components.footer />
    <livewire:components.detail-product>
</div>