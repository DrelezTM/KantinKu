<nav class="fixed w-full border-b border-gray-200 dark:border-gray-700 flex justify-between items-center text-lg bg-white dark:bg-gray-800 shadow-sm z-50 smooth-transition">
    <div class="px-6 py-4 flex justify-between items-center w-full">
        <div class="flex items-center gap-4">
            <button id="btnOpen" class="flex justify-center items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 smooth-transition" onclick="toggleSidebar()">
                <i class="fa-solid fa-bars text-gray-500 dark:text-gray-400 text-xl"></i>
            </button>
            <h1 class="font-bold text-2xl dark:text-white" id="page-title">Dashboard</h1>
        </div>
        <div class="flex items-center gap-4">
            <button id="theme-toggle" class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 smooth-transition">
                <i class="fa-solid fa-moon dark:hidden"></i>
                <i class="fa-solid fa-sun hidden dark:block"></i>
            </button>
            
            <div class="relative">
                <button id="user-menu-button" class="flex items-center gap-2 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 smooth-transition">
                    <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                        <span class="text-blue-600 dark:text-blue-400 font-semibold text-sm">{{ $initials }}</span>
                    </div>
                    <span class="font-medium dark:text-white hidden md:block">{{ explode(' ', $name)[0] }}</span>
                    <i class="fa-solid fa-chevron-down text-gray-500 dark:text-gray-400 text-xs"></i>
                </button>
                
                <div id="user-dropdown" class="absolute right-0 top-full mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 py-2 hidden z-50">
                    <div class="px-4 py-2 border-b border-gray-100 dark:border-gray-700">
                        <p class="text-sm font-medium dark:text-white">{{ $name }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $email }}</p>
                    </div>
                    <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 smooth-transition" onclick="navigateTo('profile')">
                        <i class="fa-solid fa-user text-gray-500"></i>
                        Edit Profile
                    </a>
                    <form class="w-full" method="POST" action={{ route('logout') }}>
                        @csrf
                        <button type="submit" class="flex items-center w-full gap-2 px-4 py-2 text-sm text-blue-600 dark:text-blue-400 hover:bg-gray-100 dark:hover:bg-gray-700 smooth-transition">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>