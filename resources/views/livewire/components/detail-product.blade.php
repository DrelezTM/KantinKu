<div>
    <!-- Modal Product Detail -->
    @if($showModal && $product)
    <!-- Background lebih transparan dengan backdrop blur -->
    <div class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center p-4 z-50 transition-opacity duration-300 overflow-hidden">
        <!-- Modal container dengan overflow-x-hidden -->
        <div class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto overflow-x-hidden transform transition-transform duration-300 scale-95 hover:scale-100 shadow-2xl border border-white/20">
            <!-- Header Modal dengan glass effect -->
            <div class="flex justify-between items-center p-6 border-b border-gray-200/50 sticky top-0 bg-white/95 backdrop-blur-sm z-10">
                <h2 class="text-2xl font-bold text-[#0C2B4E] truncate">Detail Produk</h2>
                <button wire:click="closeDetail" class="text-gray-500 hover:text-gray-700 transition-colors duration-200 p-1 rounded-full hover:bg-gray-100 flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-6 w-full">
                <!-- Kolom Kiri: Gambar & Info Dasar -->
                <div class="space-y-6 w-full">
                    <!-- Gambar dengan shadow -->
                    <div class="relative h-80 w-full overflow-hidden rounded-xl shadow-lg">
                        <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://source.unsplash.com/600x600/?food,' . Str::slug($product->name) }}" 
                             alt="{{ $product->name }}" 
                             class="object-cover w-full h-full transition-transform duration-500 hover:scale-105">
                        <span class="absolute top-4 left-4 bg-[#FFD700] text-[#0C2B4E] px-3 py-1 text-sm font-bold rounded-full shadow-lg">
                            {{ $product->category->name }}
                        </span>
                    </div>

                    <!-- Quantity Selector & Bayar -->
                    <div class="space-y-4 w-full">
                        <!-- Tombol Bayar Full Width -->
                        <button 
                            wire:click="showPayment"
                            class="w-full py-4 bg-green-600 text-white rounded-xl hover:bg-green-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5 font-semibold text-lg flex items-center justify-center"
                        >
                            <i class="fa-solid fa-credit-card mr-3"></i>
                            Bayar Sekarang - Rp {{ number_format($product->price * $quantity, 0, ',', '.') }}
                        </button>
                    </div>
                </div>

                <!-- Kolom Kanan: Info Produk & Ikon Interaksi -->
                <div class="space-y-6 w-full">
                    <!-- Info Dasar Produk -->
                    <div class="bg-gray-50/50 rounded-xl p-6 border border-gray-200/50 w-full">
                        <h3 class="text-2xl font-bold text-[#0C2B4E] mb-3 break-words">{{ $product->name }}</h3>
                        <p class="text-gray-600 mb-4 leading-relaxed text-base break-words">{{ $product->description }}</p>
                        
                        <!-- Harga -->
                        <div class="text-3xl font-bold text-[#0C2B4E] bg-white/50 rounded-lg p-4 text-center mb-4 w-full">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>

                        <!-- ICON KECIL: Like, Rating, Bookmark, Share -->
                        <div class="flex justify-between items-center w-full flex-wrap gap-2">
                            <!-- Like -->
                            @auth
                            <button 
                                wire:click="toggleLike({{ $product->id }})"
                                class="flex cursor-pointer items-center space-x-1 transition duration-200 flex-shrink-0 {{ $isLiked ? 'text-red-500' : 'text-gray-600' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                <span class="text-sm">{{ $likedCount }}</span>
                            </button>
                            @else 
                            <button class="flex cursor-not-allowed items-center space-x-1 text-gray-600 transition duration-200 flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                <span class="text-sm">{{ $likedCount }}</span>
                            </button>
                            @endauth

                            <!-- Rating -->
                            <div class="flex items-center space-x-1 text-gray-600 flex-shrink-0">
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <span class="text-sm">4.7</span>
                            </div>

                            <!-- Bookmark -->
                            @auth
                            <button 
                                wire:click="toggleBookmark({{ $product->id }})"
                                class="flex cursor-pointer items-center space-x-1 hover:text-blue-500 transition duration-200 flex-shrink-0 {{ $isBookmarked ? 'text-blue-500' : 'text-gray-600' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                </svg>
                                <span class="text-sm">{{ $isBookmarked ? "Tersimpan" : "Simpan" }}</span>
                            </button>
                            @else 
                            <button 
                                class="flex cursor-not-allowed items-center space-x-1 text-gray-600 transition duration-200 flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                </svg>
                                <span class="text-sm">Simpan</span>
                            </button>
                            @endauth

                            <!-- Share -->
                            <div class="relative flex-shrink-0">
                                <button 
                                    class="flex items-center space-x-1 text-gray-600 hover:text-green-500 transition duration-200 cursor-pointer" onclick="shareContent()">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                                    </svg>
                                    <span class="text-sm">Bagikan</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION KOMENTAR -->
            <div class="border-t border-gray-200/50 mt-6 pt-6 w-full">
                <div class="px-6 w-full">
                    <h3 class="text-lg font-bold text-[#0C2B4E] mb-4">💬 Komentar Pembeli</h3>
                    
                    <div class="space-y-4 max-h-60 overflow-y-auto w-full">
                        <!-- Komentar 1 -->
                        <div class="flex space-x-3 w-full">
                            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">A</div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-start">
                                    <span class="font-semibold text-gray-800 truncate">Andi Pratama</span>
                                    <div class="flex items-center text-yellow-400 text-sm flex-shrink-0 ml-2">
                                        ⭐⭐⭐⭐⭐
                                    </div>
                                </div>
                                <p class="text-gray-600 mt-1 text-sm break-words">Rasanya enak banget! Bumbunya meresap sempurna. Bakal pesen lagi nih.</p>
                                <div class="text-xs text-gray-500 mt-1">
                                    <span>2 jam lalu</span>
                                </div>
                            </div>
                        </div>

                        <!-- Komentar 2 -->
                        <div class="flex space-x-3 w-full">
                            <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">S</div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-start">
                                    <span class="font-semibold text-gray-800 truncate">Sari Indah</span>
                                    <div class="flex items-center text-yellow-400 text-sm flex-shrink-0 ml-2">
                                        ⭐⭐⭐⭐
                                    </div>
                                </div>
                                <p class="text-gray-600 mt-1 text-sm break-words">Worth it harganya! Porsinya besar dan rasanya authentic banget.</p>
                                <div class="text-xs text-gray-500 mt-1">
                                    <span>5 jam lalu</span>
                                </div>
                            </div>
                        </div>

                        <!-- Komentar 3 -->
                        <div class="flex space-x-3 w-full">
                            <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">R</div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-start">
                                    <span class="font-semibold text-gray-800 truncate">Rina Wijaya</span>
                                    <div class="flex items-center text-yellow-400 text-sm flex-shrink-0 ml-2">
                                        ⭐⭐⭐⭐⭐
                                    </div>
                                </div>
                                <p class="text-gray-600 mt-1 text-sm break-words">Pelayanannya cepat, makanan masih hangat pas sampai. Recommended!</p>
                                <div class="text-xs text-gray-500 mt-1">
                                    <span>1 hari lalu</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Input Komentar Baru - Hanya untuk yang login -->
                    @auth
                    <div class="mt-6 relative w-full">
                        <textarea 
                            placeholder="Tulis komentarmu..." 
                            class="w-full px-4 py-3 pr-20 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none text-sm"
                            rows="2">
                        </textarea>
                        <div class="absolute bottom-2 right-2 flex items-center space-x-2">
                            <div class="flex space-x-1">
                                @for($i = 1; $i <= 5; $i++)
                                <button class="text-gray-300 hover:text-yellow-400 text-sm transition duration-200">⭐</button>
                                @endfor
                            </div>
                            <button class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200 text-sm">
                                Kirim
                            </button>
                        </div>
                    </div>
                    @else
                    <div class="text-center py-3 border border-gray-200 rounded-lg bg-gray-50 mt-4 w-full">
                        <p class="text-gray-600 text-sm">Login untuk menambahkan komentar</p>
                        <a href="/login" class="text-blue-500 hover:text-blue-700 font-semibold text-sm">Login Sekarang</a>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Payment -->
    @if($showPaymentModal)
    <div class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center p-4 z-60 transition-opacity duration-300 overflow-hidden">
        <div class="bg-white rounded-2xl p-6 max-w-md w-full transform transition-transform duration-300 scale-95 hover:scale-100 shadow-2xl border border-white/20 overflow-hidden">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-[#0C2B4E] truncate">Pembayaran</h3>
                <button wire:click="hidePayment" class="text-gray-500 hover:text-gray-700 transition-colors duration-200 p-1 rounded-full hover:bg-gray-100 flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="text-center w-full">
                <div class="bg-gray-100/80 rounded-xl p-4 border border-gray-200/50 mb-4 w-full">
                    <!-- QR Code Placeholder -->
                    <div class="w-64 h-64 mx-auto bg-gray-200 rounded-lg flex items-center justify-center">
                        <span class="text-gray-500">QR Code Pembayaran</span>
                    </div>
                </div>
                <p class="text-gray-600 mb-2 text-sm break-words">Scan QR code di atas untuk melakukan pembayaran</p>
                <p class="text-gray-500 text-xs mb-4 break-words">Pembayaran aman dan terjamin</p>
                
                <div class="flex space-x-3 w-full">
                    <button wire:click="hidePayment" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200">
                        Batal
                    </button>
                    <button wire:click="hidePayment" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-300 shadow hover:shadow-lg">
                        ✅ Konfirmasi
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endif

    <!-- Flash Message -->
    @if(session()->has('message'))
        <div class="fixed top-4 right-4 z-50 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform transition-transform duration-300 max-w-sm w-full" 
             x-data="{ show: true }" 
             x-show="show" 
             x-init="setTimeout(() => show = false, 3000)">
            <div class="flex items-center">
                <i class="fa-solid fa-check-circle mr-2"></i>
                <span class="truncate">{{ session('message') }}</span>
            </div>
        </div>
    @endif

    <script>
    async function shareContent() {
        const shareData = {
            title: 'KantinKu',
            text: 'Lihat menu menarik di KantinKu!',
            url: window.location.origin + '/products'
        };

        try {
            await navigator.share(shareData);
        } catch (err) {
            throw err;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.body.style.overflowX = 'hidden';
    });
    </script>

    <style>
    [x-cloak] {
        display: none !important;
    }
    
    /* Prevent horizontal scrolling globally */
    html, body {
        overflow-x: hidden;
        max-width: 100%;
    }
    
    /* Ensure all elements stay within bounds */
    * {
        box-sizing: border-box;
    }
    </style>
</div>