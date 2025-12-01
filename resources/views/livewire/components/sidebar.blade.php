<aside id="sidebar" class="fixed top-0 left-0 h-screen w-64 bg-white dark:bg-gray-800 shadow-sm smooth-transition z-40 overflow-y-auto border-r border-gray-200 dark:border-gray-700">
    <div class="flex flex-col h-full">
        <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
            <h2 class="font-bold text-2xl dark:text-white sidebar-text">KantinKu</h2>
            <button class="hidden lg:block p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 smooth-transition" onclick="toggleSidebarCollapse()">
                <i class="fa-solid fa-chevron-left text-gray-500 dark:text-gray-400 smooth-transition" id="sidebar-collapse-icon"></i>
            </button>
        </div>
        
        <nav class="flex-1 p-4">
            <div class="mb-8 sidebar-section">
                <h3 class="text-xs uppercase text-gray-400 font-semibold tracking-wider mb-4">Menu</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}" class="nav-item flex items-center gap-3 p-3 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 smooth-transition {{ Request::routeIs('dashboard') ? 'active' : '' }}">
                            <i class="fa-solid fa-chart-simple"></i>
                            <span class="dark:text-white sidebar-text">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown">
                            <button class="flex items-center justify-between w-full gap-3 p-3 rounded-lg text-blue-600 {{ Request::routeIs('dashboard.products') || Request::routeIs('dashboard.categories') ? 'dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20 smooth-transition' : 'dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 smooth-transition' }}" onclick="toggleDropdown('ecommerce')">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-store"></i>
                                    <span class="sidebar-text">E-commerce</span>
                                </div>
                                <i class="fa-solid fa-chevron-down text-xs smooth-transition sidebar-text" id="ecommerce-arrow"></i>
                            </button>
                            <div id="ecommerce-dropdown" class="dropdown-content ml-4 mt-2 hidden sidebar-section">
                                <ul class="space-y-2">
                                    <li>
                                        <a href="{{ route('dashboard.products') }}" class="nav-item flex items-center gap-3 p-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 smooth-transition {{ Request::routeIs('dashboard.products') ? 'active' : '' }}">
                                            <i class="fa-solid fa-box text-xs"></i>
                                            <span class="sidebar-text">Product</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('dashboard.categories') }}" class="nav-item flex items-center gap-3 p-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 smooth-transition {{ Request::routeIs('dashboard.categories') ? 'active' : '' }}">
                                            <i class="fa-solid fa-tags text-xs"></i>
                                            <span class="sidebar-text">Category</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="mb-8 sidebar-section">
                <h3 class="text-xs uppercase text-gray-400 font-semibold tracking-wider mb-4">Account</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard.profile') }}" class="nav-item flex items-center gap-3 p-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 smooth-transition {{ Request::routeIs('dashboard.profile') ? 'active' : '' }}">
                            <i class="fa-solid fa-user"></i>
                            <span class="sidebar-text">Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.users') }}" class="nav-item flex items-center gap-3 p-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 smooth-transition {{ Request::routeIs('dashboard.users') ? 'active' : '' }}">
                            <i class="fa-solid fa-users"></i>
                            <span class="sidebar-text">Users</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="mb-8 sidebar-section">
                <h3 class="text-xs uppercase text-gray-400 font-semibold tracking-wider mb-4">Others</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard.feedbacks') }}" class="nav-item flex items-center gap-3 p-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 smooth-transition {{ Request::routeIs('dashboard.feedbacks') ? 'active' : '' }}">
                            <i class="fa-solid fa-comment"></i>
                            <span class="sidebar-text">Feedbacks</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</aside>