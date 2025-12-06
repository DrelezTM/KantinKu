<div id="theme-toggle-container">
    <button 
        wire:click="toggleTheme"
        type="button"
        id="theme-toggle-button"
        class="relative w-12 h-6 rounded-full bg-gray-300 dark:bg-gray-700 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
        aria-label="Toggle dark mode"
    >
        <!-- Track -->
        <div class="absolute inset-0 rounded-full overflow-hidden">
            <div id="sun-track" class="absolute inset-0 bg-gradient-to-r from-yellow-300 to-orange-400 opacity-0"></div>
            <div id="moon-track" class="absolute inset-0 bg-gradient-to-r from-blue-400 to-purple-600 opacity-100"></div>
        </div>
        
        <!-- Thumb/Handle -->
        <div id="theme-thumb" class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow-lg transition-transform duration-300">
            <svg id="sun-icon" class="absolute inset-0 m-auto w-3 h-3 text-yellow-500 opacity-100 transition-opacity duration-300" 
                 fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
            </svg>
            
            <svg id="moon-icon" class="absolute inset-0 m-auto w-3 h-3 text-blue-400 opacity-0 transition-opacity duration-300" 
                 fill="currentColor" viewBox="0 0 20 20">
                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
            </svg>
        </div>
    </button>
</div>

<script>
    // Function untuk update UI toggle
    function updateToggleUI(isDark) {
        const thumb = document.getElementById('theme-thumb');
        const sunTrack = document.getElementById('sun-track');
        const moonTrack = document.getElementById('moon-track');
        const sunIcon = document.getElementById('sun-icon');
        const moonIcon = document.getElementById('moon-icon');
        
        if (thumb && sunTrack && moonTrack && sunIcon && moonIcon) {
            thumb.style.transform = isDark ? 'translateX(24px)' : 'translateX(0)';
            sunTrack.style.opacity = isDark ? '1' : '0';
            moonTrack.style.opacity = isDark ? '0' : '1';
            sunIcon.style.opacity = isDark ? '0' : '1';
            moonIcon.style.opacity = isDark ? '1' : '0';
        }
    }
    
    // Function untuk apply theme ke document
    function applyTheme(theme) {
        const html = document.documentElement;
        html.classList.remove('light', 'dark');
        html.classList.add(theme);
        
        // Update localStorage
        localStorage.setItem('theme', theme);
        
        // Update cookies
        document.cookie = `theme=${theme}; path=/; max-age=${365 * 24 * 60 * 60}`;
        document.cookie = `kantinku_theme=${theme}; path=/; max-age=${365 * 24 * 60 * 60}`;
        
        // Update UI toggle
        updateToggleUI(theme === 'dark');
        
        // Update Livewire component state jika ada
        if (typeof Livewire !== 'undefined') {
            const themeToggle = Livewire.find('theme-toggle');
            if (themeToggle) {
                themeToggle.darkMode = theme === 'dark';
            }
        }
    }
    
    // Initialize saat page load
    document.addEventListener('DOMContentLoaded', function() {
        // Determine current theme
        let theme = 'light';
        const savedTheme = localStorage.getItem('theme');
        const cookieTheme = document.cookie
            .split('; ')
            .find(row => row.startsWith('theme=') || row.startsWith('kantinku_theme='));
        
        if (savedTheme) {
            theme = savedTheme;
        } else if (cookieTheme) {
            theme = cookieTheme.split('=')[1];
        } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            theme = 'dark';
        }
        
        // Apply theme
        applyTheme(theme);
    });
    
    // Listen untuk Livewire event
    document.addEventListener('livewire:init', () => {
        Livewire.on('theme-toggled', (event) => {
            const theme = event.theme;
            applyTheme(theme);
        });
    });
</script>