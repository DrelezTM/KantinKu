<nav class="sticky top-0 bg-[#0C2B4E] shadow z-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <a href="/" class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-[#8FABD4] flex items-center justify-center">
                    <span class="text-white font-bold text-lg">K</span>
                </div>
                <span class="font-bold text-xl text-[#8FABD4] hidden sm:inline">KantinKu</span>
            </a>

            <div class="hidden md:flex items-center gap-8">
                <a href="/#home" class="text-white hover:text-[#8FABD4] transition-colors font-medium">Home</a>
                <a href="/#about" class="text-white hover:text-[#8FABD4] transition-colors font-medium">About</a>
                <a href="/#menu" class="text-white hover:text-[#8FABD4] transition-colors font-medium">Menu</a>
                <a href="/#feedback" class="text-white hover:text-[#8FABD4] transition-colors font-medium">Feedback</a>
            </div>

            @guest
            <div class="hidden md:flex items-center gap-4">
                <a href="{{ route('login') }}" wire:navigate class="px-6 py-2 bg-[#8FABD4] text-white rounded-lg font-semibold hover:bg-[#0C2B4E] transition-colors">
                    Sign In
                </a>
            </div>
            @endguest
            @auth
            <div class="hidden md:flex items-center gap-4">
                <form method="POST" action="/logout">
                    @csrf
                    <button class="px-6 py-2 bg-[#8FABD4] text-white rounded-lg font-semibold hover:bg-[#0C2B4E] transition-colors cursor-pointer">Logout</button>
                </form>
            </div>
            @endauth

            <button id="menu-btn" class="md:hidden p-2 rounded-md hover:bg-[#1E3A5F] transition-colors" aria-label="Toggle menu">
                <svg xmlns="http://www.w3.org/2000/svg" id="menu-icon-open" class="w-6 h-6 text-white" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" id="menu-icon-close" class="w-6 h-6 text-white hidden"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div id="mobile-menu" class="hidden md:hidden pb-4 space-y-2 bg-white rounded-lg mt-2 shadow-lg transition-all duration-300 ease-in-out">
            <a href="/#home" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors font-medium">Home</a>
            <a href="/#about" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors font-medium">About</a>
            <a href="/#menu" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors font-medium">Menu</a>
            <a href="/#feedback" class="text-white hover:text-[#8FABD4] transition-colors font-medium">Feedback</a>
            <div class="pt-2 border-t border-gray-200">
                @guest
                <a href="{{ route('login') }}" class="block px-4 py-3 text-center bg-[#0C2B4E] text-white rounded-lg font-semibold hover:bg-[#1a3a5f] transition-colors">
                    Sign In
                </a>
                @endguest
                @auth
                <form method="POST" action="/logout">
                    @csrf
                    <button class="w-full px-4 py-3 text-center bg-[#8FABD4] text-white rounded-lg font-semibold hover:bg-[#7a9bc7] transition-colors cursor-pointer">
                        Logout
                    </button>
                </form>
                @endauth
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuBtn = document.getElementById('menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const menuIconOpen = document.getElementById('menu-icon-open');
            const menuIconClose = document.getElementById('menu-icon-close');
            
            if (menuBtn && mobileMenu && menuIconOpen && menuIconClose) {
                menuBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    
                    const isHidden = mobileMenu.classList.contains('hidden');
                    
                    if (isHidden) {
                        mobileMenu.classList.remove('hidden');
                        menuIconOpen.classList.add('hidden');
                        menuIconClose.classList.remove('hidden');
                    } else {
                        mobileMenu.classList.add('hidden');
                        menuIconOpen.classList.remove('hidden');
                        menuIconClose.classList.add('hidden');
                    }
                });
                
                document.addEventListener('click', function(event) {
                    const isClickInsideNav = event.target.closest('nav');
                    if (!isClickInsideNav && !mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                        menuIconOpen.classList.remove('hidden');
                        menuIconClose.classList.add('hidden');
                    }
                });
                
                mobileMenu.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            }
        });
    </script>
</nav>