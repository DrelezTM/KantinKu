<div>
    <!-- Modal Product Detail -->
    @if($showModal && $product)
    <!-- Background lebih transparan dengan backdrop blur -->
    <div class="fixed inset-0 bg-black/70 dark:bg-black/90 backdrop-blur-sm flex items-center justify-center p-4 z-50 transition-opacity duration-300 overflow-hidden">
        <!-- Modal container dengan overflow-x-hidden -->
        <div class="bg-white dark:bg-gray-900/80 rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto overflow-x-hidden transform transition-all duration-300 scale-95 hover:scale-100 shadow-2xl border border-white/20 dark:border-gray-700/50">
            <!-- Header Modal dengan glass effect -->
            <div class="flex justify-between items-center p-6 border-b border-gray-200/50 dark:border-gray-700/50 sticky top-0 bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm z-10">
                <h2 class="text-2xl font-bold text-[#0C2B4E] dark:text-blue-400 truncate transition-colors duration-300">Detail Produk</h2>
                <button wire:click="closeDetail" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition-colors duration-200 p-1 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 flex-shrink-0">
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
                    <div class="relative h-80 w-full overflow-hidden rounded-xl shadow-lg dark:shadow-gray-900/50">
                        <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://source.unsplash.com/600x600/?food,' . Str::slug($product->name) }}" 
                             alt="{{ $product->name }}" 
                             class="object-cover w-full h-full transition-transform duration-500 hover:scale-105 dark:brightness-90">
                        <span class="absolute top-4 left-4 bg-[#FFD700] text-[#0C2B4E] dark:text-gray-900 px-3 py-1 text-sm font-bold rounded-full shadow-lg transition-colors duration-300">
                            {{ $product->category->name }}
                        </span>
                    </div>

                    <!-- Quantity Selector & Bayar -->
                    <div class="space-y-4 w-full">
                        <!-- Tombol Bayar Full Width -->
                        <button 
                            wire:click="showPayment"
                            class="w-full py-4 bg-green-600 dark:bg-green-700 text-white rounded-xl hover:bg-green-700 dark:hover:bg-green-600 transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5 font-semibold text-lg flex items-center justify-center"
                        >
                            <i class="fa-solid fa-credit-card mr-3"></i>
                            Bayar Sekarang - Rp {{ number_format($product->price * $quantity, 0, ',', '.') }}
                        </button>
                    </div>
                </div>

                <!-- Kolom Kanan: Info Produk & Ikon Interaksi -->
                <div class="space-y-6 w-full">
                    <!-- Info Dasar Produk -->
                    <div class="bg-gray-50/50 dark:bg-gray-800/50 rounded-xl p-6 border border-gray-200/50 dark:border-gray-700/50 w-full">
                        <h3 class="text-2xl font-bold text-[#0C2B4E] dark:text-white mb-3 break-words transition-colors duration-300">{{ $product->name }}</h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4 leading-relaxed text-base break-words transition-colors duration-300">{{ $product->description }}</p>
                        
                        <!-- Harga -->
                        <div class="text-3xl font-bold text-[#0C2B4E] dark:text-blue-400 bg-white/50 dark:bg-gray-800/50 rounded-lg p-4 text-center mb-4 w-full transition-colors duration-300">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>

                        <!-- ICON KECIL: Like, Rating, Bookmark, Share -->
                        <div class="flex justify-between items-center w-full flex-wrap gap-2">
                            <!-- Like -->
                            @auth
                            <button 
                                wire:click="toggleLike({{ $product->id }})"
                                class="flex cursor-pointer items-center space-x-1 transition duration-200 flex-shrink-0 {{ $isLiked ? 'text-red-500' : 'text-gray-600 dark:text-gray-400' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                <span class="text-sm">{{ $likedCount }}</span>
                            </button>
                            @else 
                            <button class="flex cursor-not-allowed items-center space-x-1 text-gray-600 dark:text-gray-400 transition duration-200 flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                <span class="text-sm">{{ $likedCount }}</span>
                            </button>
                            @endauth

                            <!-- Rating -->
                            <div class="flex items-center space-x-1 text-gray-600 dark:text-gray-400 flex-shrink-0 transition-colors duration-300">
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <span class="text-sm">{{ number_format($product->ratings_avg_rating, 1) }}</span>
                            </div>

                            <!-- Bookmark -->
                            @auth
                            <button 
                                wire:click="toggleBookmark({{ $product->id }})"
                                class="flex cursor-pointer items-center space-x-1 hover:text-blue-500 dark:hover:text-blue-400 transition duration-200 flex-shrink-0 {{ $isBookmarked ? 'text-blue-500 dark:text-blue-400' : 'text-gray-600 dark:text-gray-400' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                </svg>
                                <span class="text-sm">{{ $isBookmarked ? "Tersimpan" : "Simpan" }}</span>
                            </button>
                            @else 
                            <button 
                                class="flex cursor-not-allowed items-center space-x-1 text-gray-600 dark:text-gray-400 transition duration-200 flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                </svg>
                                <span class="text-sm">Simpan</span>
                            </button>
                            @endauth

                            <!-- Share -->
                            <div class="relative flex-shrink-0">
                                <button 
                                    class="flex items-center space-x-1 text-gray-600 dark:text-gray-400
                                        hover:text-green-500 dark:hover:text-green-400 transition duration-200 
                                        cursor-pointer" 
                                        onclick="shareContent()">
                                    <svg class="w-5 h-5" fill="none" 
                                        stroke="currentColor" 
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" 
                                        stroke-linejoin="round" 
                                        stroke-width="2" 
                                        d="M8.684 13.342C8.886 12.938 9 12.482 9 
                                            12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 
                                            110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 
                                            0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 
                                            3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                                    </svg>
                                    <span class="text-sm">Bagikan</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION KOMENTAR -->
            <div class="border-t border-gray-200/50 dark:border-gray-700/50 mt-6 pt-6 w-full">
                <div class="px-6 w-full">
                    <h3 class="text-lg font-bold text-[#0C2B4E] dark:text-blue-400 mb-4 transition-colors duration-300">💬 Komentar Pembeli</h3>
                    
                    <div class="space-y-4 max-h-60 overflow-y-auto w-full">
                        @foreach($product->comments as $comment)
                        <div class="flex space-x-3 w-full">
                            <div class="w-10 h-10 bg-blue-500 dark:bg-blue-600 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0 transition-colors duration-300">
                                {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-start">
                                    <span class="font-semibold text-gray-800 dark:text-gray-300 truncate transition-colors duration-300">{{ $comment->user->name }}</span>
                                    <div class="flex items-center text-yellow-400 text-sm flex-shrink-0 ml-2">
                                        {{ str_repeat('⭐', $comment->user->ratingForComment($comment->id) ?? 0) }}
                                    </div>
                                </div>
                                <p class="text-gray-600 dark:text-gray-400 mt-1 text-sm break-words transition-colors duration-300">{{ $comment->message }}</p>
                                <div class="text-xs text-gray-500 dark:text-gray-500 mt-1 transition-colors duration-300">
                                    <span>{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Input Komentar Baru - Hanya untuk yang login -->
                    @auth
                        <div class="mb-2 mt-3">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 transition-colors duration-300">
                                Beri Rating: 
                                <span id="rating-display" class="text-[#0C2B4E] dark:text-blue-400 font-bold ml-1">
                                    <span id="rating-number">{{ $star ?? 0 }}</span>/5
                                </span>
                            </label>
                            
                            <!-- Hidden Input untuk Livewire -->
                            <input 
                                type="hidden" 
                                wire:model="star"
                                id="rating-hidden"
                                value="{{ $star ?? 0 }}"
                            >
                            
                            <!-- Container untuk bintang rating -->
                            <div class="flex items-center space-x-1" id="star-container">
                                @for($i = 1; $i <= 5; $i++)
                                    <button 
                                        type="button"
                                        class="star-button text-2xl transition duration-200 transform hover:scale-110 {{ 
                                            ($star ?? 0) >= $i ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' 
                                        }}"
                                        data-value="{{ $i }}"
                                        wire:click="$set('star', {{ $i }})"
                                        onclick="updateStarDisplay({{ $i }})"
                                        onmouseover="hoverStar({{ $i }})"
                                        onmouseout="resetStars()"
                                    >
                                        ★
                                    </button>
                                @endfor
                            </div>
                            
                            <!-- Label rating -->
                            <div class="flex justify-between text-xs text-gray-500 dark:text-gray-500 mt-1">
                            </div>
                        </div>
                        
                        <!-- Textarea untuk komentar -->
                        <div class="relative mt-4">
                            <textarea 
                                placeholder="Tulis komentarmu di sini..." 
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#8FABD4] dark:focus:ring-blue-500 focus:border-[#8FABD4] dark:focus:border-blue-500 resize-none text-sm transition-colors duration-200 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
                                rows="4"
                                wire:model.defer="comment"
                                id="comment-textarea"
                            ></textarea>
                            <button 
                                wire:click="submitComment"
                                class="px-3 py-1 bg-blue-500 dark:bg-blue-600 text-white rounded-lg hover:bg-blue-600 dark:hover:bg-blue-700 transition duration-200 text-sm">
                                Kirim
                            </button>
                        </div>
                    @else
                    <div class="text-center py-3 border border-gray-200 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-800 mt-4 w-full transition-colors duration-300">
                        <p class="text-gray-600 dark:text-gray-300 text-sm">Login untuk menambahkan komentar</p>
                        <a href="/login" class="text-blue-500 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-semibold text-sm transition-colors duration-300">Login Sekarang</a>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Payment -->
    @if($showPaymentModal)
    <div class="fixed inset-0 bg-black/70 dark:bg-black/80 backdrop-blur-sm flex items-center justify-center p-4 z-60 transition-opacity duration-300 overflow-hidden">
        <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 max-w-md w-full transform transition-all duration-300 scale-95 hover:scale-100 shadow-2xl border border-white/20 dark:border-gray-700/50 overflow-hidden">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-[#0C2B4E] dark:text-blue-400 truncate transition-colors duration-300">Pembayaran</h3>
                <button wire:click="hidePayment" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition-colors duration-200 p-1 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="text-center w-full">
                <div class="bg-gray-100/80 dark:bg-gray-800/80 rounded-xl p-4 border border-gray-200/50 dark:border-gray-700/50 mb-4 w-full">
                    <!-- QR Code Placeholder -->
                    <div class="w-64 h-64 mx-auto bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                        <span class="text-gray-500 dark:text-gray-400">QR Code Pembayaran</span>
                    </div>
                </div>
                <p class="text-gray-600 dark:text-gray-300 mb-2 text-sm break-words transition-colors duration-300">Scan QR code di atas untuk melakukan pembayaran</p>
                <p class="text-gray-500 dark:text-gray-500 text-xs mb-4 break-words transition-colors duration-300">Pembayaran aman dan terjamin</p>
                
                <div class="flex space-x-3 w-full">
                    <button wire:click="hidePayment" class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition duration-200">
                        Batal
                    </button>
                    <button wire:click="hidePayment" class="flex-1 px-4 py-2 bg-green-600 dark:bg-green-700 text-white rounded-lg hover:bg-green-700 dark:hover:bg-green-600 transition-all duration-300 shadow hover:shadow-lg">
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
        <div class="fixed top-4 right-4 z-50 bg-green-500 dark:bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg transform transition-transform duration-300 max-w-sm w-full" 
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