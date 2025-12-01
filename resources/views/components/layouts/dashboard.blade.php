<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'KantinKu' }}</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
            }
        </script>
        @vite(['resources/css/app.css'])
        @livewireStyles
        <style>
            .dark {
                color-scheme: dark;
            }
            .page {
                display: none;
            }
            .page.active {
                display: block;
            }
            .nav-item.active {
                background-color: rgb(219 234 254);
                color: rgb(37 99 235);
            }
            .dark .nav-item.active {
                background-color: rgb(30 58 138 / 0.2);
                color: rgb(96 165 250);
            }
            .smooth-transition {
                transition: all 0.3s ease-in-out;
            }
            .card-hover {
                transition: all 0.3s ease;
            }
            .card-hover:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            }
            .modal {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 1000;
            }
            .modal.active {
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .sidebar-collapsed {
                width: 80px !important;
            }
            .sidebar-collapsed .sidebar-text {
                display: none !important;
            }
            .sidebar-collapsed .sidebar-section {
                display: none !important;
            }
            .main-expanded {
                margin-left: 80px !important;
            }
        </style>
    </head>
    <body class="bg-gray-50 dark:bg-gray-900 transition-colors duration-300" style="font-family: 'Inter';">
        {{ $slot }}

        @livewireScripts
        <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            if (window.innerWidth < 768) {
                sidebar.classList.toggle('translate-x-[-240px]');
            }
        }

        function toggleSidebarCollapse() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const collapseIcon = document.getElementById('sidebar-collapse-icon');
            
            sidebar.classList.toggle('sidebar-collapsed');
            mainContent.classList.toggle('main-expanded');
            collapseIcon.classList.toggle('rotate-180');
        }

        function toggleDropdown(id) {
            const dropdown = document.getElementById(id + '-dropdown');
            const arrow = document.getElementById(id + '-arrow');
            
            dropdown.classList.toggle('hidden');
            arrow.classList.toggle('rotate-180');
        }

        function openAddProductModal() {
            document.getElementById('add-product-modal').classList.add('active');
        }

        function openAddCategoryModal() {
            document.getElementById('add-category-modal').classList.add('active');
        }

        function openAddUserModal() {
            document.getElementById('add-user-modal').classList.add('active');
        }

        function openEditProductModal() {
            document.getElementById('edit-product-modal').classList.add('active');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const userButton = document.getElementById('user-menu-button');
            const userDropdown = document.getElementById('user-dropdown');
            
            if (userButton && userDropdown) {
                userButton.addEventListener('click', function() {
                    userDropdown.classList.toggle('hidden');
                });
            }

            document.addEventListener('click', function(event) {
                if (userButton && userDropdown && !userButton.contains(event.target) && !userDropdown.contains(event.target)) {
                    userDropdown.classList.add('hidden');
                }
            });

            const sidebar = document.getElementById('sidebar');
            const btnOpen = document.getElementById('btnOpen');
            
            document.addEventListener('click', function(event) {
                if (window.innerWidth < 768 && 
                    sidebar && 
                    btnOpen &&
                    !sidebar.contains(event.target) && 
                    !btnOpen.contains(event.target) &&
                    !sidebar.classList.contains('translate-x-[-240px]')) {
                    sidebar.classList.add('translate-x-[-240px]');
                }
            });

            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('modal')) {
                    event.target.classList.remove('active');
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('theme-toggle');
            
            if (themeToggle) {
                themeToggle.addEventListener('click', function() {
                    if (document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('theme', 'light');
                    } else {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('theme', 'dark');
                    }
                });
            }

            if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        });
        </script>
    </body>
</html>
