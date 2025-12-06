<div class="min-h-screen bg-gradient-to-br from-orange-50 to-amber-100 dark:from-gray-900 dark:to-gray-800 flex items-center justify-center p-4">
  <div class="max-w-6xl w-full grid grid-cols-1 lg:grid-cols-2 bg-white dark:bg-gray-900 rounded-2xl shadow-xl overflow-hidden">
    
    <!-- Bagian Kiri - Form Login -->
    <div class="p-8 md:p-12 lg:p-16 flex flex-col justify-center">
      <!-- Header dengan Logo -->
      <div class="mb-10 text-center lg:text-left">
        <div class="flex items-center justify-center lg:justify-start space-x-3 mb-4">
            <div class="w-12 h-12 rounded-lg bg-[#8FABD4] flex items-center justify-center">
                <span class="text-[#0C2B4E] font-bold text-3xl">K</span>
            </div>
          <h1 class="text-2xl font-bold text-gray-800 dark:text-white">kantinKu<span class="text-[#0C2B4E]"></span></h1>
        </div>
        <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Selamat Datang Kembali</h2>
        <p class="text-gray-600 dark:text-gray-400">Masuk ke akun Anda untuk melanjutkan</p>
      </div>

      <!-- Form Login dengan Livewire -->
      <form wire:submit.prevent="login" class="space-y-6">
        <!-- Error Messages -->
        @if ($errors->any())
          <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg">
            @foreach ($errors->all() as $error)
              <p class="text-red-600 text-sm">{{ $error }}</p>
            @endforeach
          </div>
        @endif

        <!-- Email Input -->
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email / NIM</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
              </svg>
            </div>
            <input 
              type="email" 
              wire:model="email"
              class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg bg-white dark:bg-gray-800 dark:border-gray-700 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#0C2B4E] focus:border-transparent transition duration-200" 
              placeholder="nama@email.com"
            >
          </div>
          @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <!-- Password Input -->
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kata Sandi</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
              </svg>
            </div>
            <input 
              type="password" 
              wire:model="password"
              class="block w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg bg-white dark:bg-gray-800 dark:border-gray-700 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#0C2B4E] focus:border-transparent transition duration-200" 
              placeholder="Masukkan kata sandi"
            >
          </div>
          @error('password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <!-- Login Button -->
        <div>
          <button 
            type="submit" 
            class="group relative w-full flex justify-center items-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-[#0C2B4E] hover:bg-[#163e6d] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0C2B4E] transition shadow min-h-[44px]">
            <span wire:loading.remove class="flex items-center justify-center h-full">Masuk</span>
            <span wire:loading class="flex items-center justify-center h-full">
                <svg class="animate-spin h-5 w-5 text-white mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Memproses...
            </span>
        </button>
        </div>
      </form>

      <!-- Register Link -->
      <div class="mt-8 text-center">
      </div>
    </div>

    <!-- Bagian Kanan - Ilustrasi -->
    <div class="hidden lg:flex bg-gradient-to-br from-[#8FABD4] to-[#8FABD4] p-8 flex-col justify-center items-center relative overflow-hidden">
      <!-- Background Pattern -->
      <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-64 h-64 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full translate-x-1/2 translate-y-1/2"></div>
      </div>
      
      <!-- Content -->
      <div class="relative z-10 text-center text-white max-w-md">
        <!-- Feature List -->
        <div class="space-y-4 text-left">
           <div class="flex justify-center md:justify-end">
            <img 
            src="{{ asset('images/food.png') }}"
            style="
                animation: float3d 5s ease-in-out infinite;
                transition: transform 0.7s ease;"
            onmouseover="this.style.transform='perspective(900px) rotateX(12deg) rotateY(-12deg) scale(1.07)';"
            onmouseout="this.style.transform='';"/>
          </div>
        </div>
      </div>
      
      <!-- Floating Elements -->
      <div class="absolute top-10 left-10 w-20 h-20 bg-white/10 rounded-full backdrop-blur-sm"></div>
      <div class="absolute bottom-10 right-10 w-24 h-24 bg-white/10 rounded-full backdrop-blur-sm"></div>
    </div>

    <!-- Style harus berada di DALAM root element -->
    <style>
    @keyframes float3d {
      0%, 100% { transform: perspective(900px) rotateX(5deg) rotateY(0deg) translateY(0px); }
      50% { transform: perspective(900px) rotateX(5deg) rotateY(5deg) translateY(-10px); }
    }
    </style>
  </div>
</div>