<div>
    <section class="py-12 px-4 dark:bg-gray-900/90 transition-colors duration-300" id="feedback">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-[#0C2B4E] dark:text-blue-400 mb-2 transition-colors duration-300">
                    💬 Feedback
                </h2>
                <p class="text-gray-600 dark:text-gray-300 text-sm transition-colors duration-300">
                    Saran dan kritik Anda sangat berarti bagi kami
                </p>
            </div>
            
            <div class="bg-white/30 dark:bg-gray-800/30 backdrop-blur-sm rounded-xl p-6 border border-white/50 dark:border-gray-700/50 transition-colors duration-300">
                <!-- Success Message -->
                @if (session()->has('feedback_success'))
                    <div class="mb-4 p-3 bg-green-100 dark:bg-green-900/30 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 rounded-lg text-sm transition-colors duration-300">
                        ✅ {{ session('feedback_success') }}
                    </div>
                @endif

                <form wire:submit="save" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Nama -->
                        <div>
                            <input 
                                type="text" 
                                wire:model="name"
                                class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-1 focus:ring-[#0C2B4E] dark:focus:ring-blue-500 focus:border-[#0C2B4E] dark:focus:border-blue-500 bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-colors duration-300"
                                placeholder="Nama"
                            >
                            @error('name') <span class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <input 
                                type="email" 
                                wire:model="email"
                                class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-1 focus:ring-[#0C2B4E] dark:focus:ring-blue-500 focus:border-[#0C2B4E] dark:focus:border-blue-500 bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-colors duration-300"
                                placeholder="Email"
                            >
                            @error('email') <span class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Pesan -->
                    <div>
                        <textarea 
                            wire:model="message"
                            rows="3"
                            class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-1 focus:ring-[#0C2B4E] dark:focus:ring-blue-500 focus:border-[#0C2B4E] dark:focus:border-blue-500 bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 resize-none transition-colors duration-300"
                            placeholder="Tulis feedback Anda di sini..."
                        ></textarea>
                        @error('message') <span class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button 
                            type="submit"
                            class="px-6 py-2 bg-[#0C2B4E] dark:bg-blue-600 text-white rounded-lg hover:bg-[#163e6d] dark:hover:bg-blue-700 transition-colors duration-300 text-sm font-medium flex items-center"
                            wire:loading.attr="disabled"
                        >
                            <span wire:loading.remove>Kirim</span>
                            <span wire:loading>
                                <svg class="animate-spin h-4 w-4 text-white mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Processing...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>