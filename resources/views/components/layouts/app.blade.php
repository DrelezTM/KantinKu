<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="theme-color" content="#ffffff">

        <title>{{ $title ?? 'KantinKu' }}</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        @vite(['resources/css/app.css'])
        
        <!-- CRITICAL: JavaScript untuk theme handling -->
        <script>
            // Function untuk apply theme
            function applyTheme(theme) {
                const html = document.documentElement;
                
                // Remove existing theme classes
                html.classList.remove('light', 'dark');
                
                // Add new theme class
                html.classList.add(theme);
                
                // Update localStorage
                localStorage.setItem('theme', theme);
                
                // Update meta theme-color
                const metaThemeColor = document.querySelector('meta[name="theme-color"]');
                if (metaThemeColor) {
                    metaThemeColor.setAttribute('content', theme === 'dark' ? '#111827' : '#ffffff');
                }
                
                // Dispatch event untuk Livewire components
                window.dispatchEvent(new CustomEvent('theme-changed', { 
                    detail: { theme: theme } 
                }));
                
                // Update cookie untuk server-side
                document.cookie = `theme=${theme}; path=/; max-age=${365 * 24 * 60 * 60}; SameSite=Lax`;
                document.cookie = `kantinku_theme=${theme}; path=/; max-age=${365 * 24 * 60 * 60}; SameSite=Lax`;
            }
            
            // Initialize theme saat page load - INI YANG PENTING!
            (function() {
                // Priority: 1. localStorage, 2. Cookie, 3. System preference
                let theme = 'light';
                
                // Check localStorage
                if (localStorage.getItem('theme')) {
                    theme = localStorage.getItem('theme');
                }
                // Check cookie (untuk initial page load)
                else {
                    const cookies = document.cookie.split(';');
                    for (let cookie of cookies) {
                        cookie = cookie.trim();
                        if (cookie.startsWith('theme=') || cookie.startsWith('kantinku_theme=')) {
                            theme = cookie.split('=')[1];
                            break;
                        }
                    }
                }
                // Check system preference (hanya jika tidak ada saved preference)
                else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    theme = 'dark';
                }
                
                // Apply theme immediately - SEBELUM konten dirender!
                applyTheme(theme);
                
                // Store initial theme di window object untuk akses mudah
                window.initialTheme = theme;
            })();
            
            // Listen untuk perubahan theme dari Livewire
            window.addEventListener('theme-changed', function(event) {
                const theme = event.detail.theme;
                applyTheme(theme);
            });
            
            // Listen untuk system preference changes (opsional)
            if (window.matchMedia) {
                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
                    // Hanya terapkan jika user belum memilih theme manual
                    if (!localStorage.getItem('theme')) {
                        applyTheme(e.matches ? 'dark' : 'light');
                    }
                });
            }
        </script>
        
        @livewireStyles
    </head>
    <body class="min-h-screen dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-300">
        {{ $slot }}
        @livewireScripts
        
        <!-- Script untuk handle Livewire navigation -->
        <script>
            // Handle Livewire navigation events
            document.addEventListener('livewire:navigated', () => {
                // Re-apply theme setelah navigation
                const savedTheme = localStorage.getItem('theme') || 'light';
                applyTheme(savedTheme);
                
                // Update semua komponen Livewire yang punya property darkMode
                setTimeout(() => {
                    if (typeof Livewire !== 'undefined') {
                        Livewire.all().forEach(component => {
                            if (component.$wire.hasOwnProperty('darkMode')) {
                                component.$wire.darkMode = savedTheme === 'dark';
                            }
                        });
                    }
                }, 100);
            });
            
            // Initialize theme toggle state
            document.addEventListener('livewire:initialized', () => {
                const savedTheme = localStorage.getItem('theme') || 'light';
                
                // Update semua komponen ThemeToggle
                if (typeof Livewire !== 'undefined') {
                    Livewire.all().forEach(component => {
                        if (component.$wire.hasOwnProperty('darkMode')) {
                            component.$wire.darkMode = savedTheme === 'dark';
                        }
                    });
                }
            });
        </script>
    </body>
</html>
