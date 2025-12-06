// Dark Mode System
class DarkMode {
    constructor() {
        this.theme = null;
        this.init();
    }

    init() {
        // Get theme from localStorage or system preference
        this.theme = this.getStoredTheme();
        this.apply();
        
        // Setup event listeners
        this.setupListeners();
        
        console.log('Dark Mode initialized:', this.theme);
    }

    getStoredTheme() {
        // Check localStorage first
        const stored = localStorage.getItem('theme');
        if (stored) return stored;

        // Check system preference
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        return prefersDark ? 'dark' : 'light';
    }

    apply() {
        const html = document.documentElement;
        const themeColor = document.querySelector('meta[name="theme-color"]');

        if (this.theme === 'dark') {
            html.classList.add('dark');
            if (themeColor) {
                themeColor.content = '#111827'; // gray-900
            }
        } else {
            html.classList.remove('dark');
            if (themeColor) {
                themeColor.content = '#0C2B4E'; // warna navbar
            }
        }

        // Store in localStorage
        localStorage.setItem('theme', this.theme);
        
        // Update UI
        this.updateToggleUI();
    }

    toggle() {
        this.theme = this.theme === 'light' ? 'dark' : 'light';
        this.apply();
        return this.theme;
    }

    updateToggleUI() {
        const isDark = this.theme === 'dark';
        
        // Update all toggle buttons
        const toggleButtons = document.querySelectorAll('[data-theme-toggle]');
        
        toggleButtons.forEach(button => {
            const circle = button.querySelector('[data-toggle-circle]');
            const sunIcon = button.querySelector('[data-sun-icon]');
            const moonIcon = button.querySelector('[data-moon-icon]');
            
            if (circle) {
                circle.style.transform = isDark ? 'translateX(28px)' : 'translateX(0)';
            }
            
            if (sunIcon) {
                sunIcon.style.opacity = isDark ? '0' : '1';
            }
            
            if (moonIcon) {
                moonIcon.style.opacity = isDark ? '1' : '0';
            }
        });
    }

    setupListeners() {
        // System preference change
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
            if (!localStorage.getItem('theme')) {
                this.theme = e.matches ? 'dark' : 'light';
                this.apply();
            }
        });

        // Click event for toggle buttons
        document.addEventListener('click', (e) => {
            const toggleBtn = e.target.closest('[data-theme-toggle]');
            if (toggleBtn) {
                e.preventDefault();
                this.toggle();
            }
        });
    }
}

// Initialize when DOM is ready
let darkModeSystem;

document.addEventListener('DOMContentLoaded', () => {
    darkModeSystem = new DarkMode();
    
    // Make it globally available
    window.toggleDarkMode = () => {
        if (darkModeSystem) {
            return darkModeSystem.toggle();
        }
    };
    
    window.getCurrentTheme = () => {
        if (darkModeSystem) {
            return darkModeSystem.theme;
        }
        return 'light';
    };
});

// Fallback for direct function calls
window.darkModeToggle = () => {
    const currentTheme = localStorage.getItem('theme') || 'light';
    const newTheme = currentTheme === 'light' ? 'dark' : 'light';
    
    const html = document.documentElement;
    if (newTheme === 'dark') {
        html.classList.add('dark');
    } else {
        html.classList.remove('dark');
    }
    
    localStorage.setItem('theme', newTheme);
    
    // Update UI
    const isDark = newTheme === 'dark';
    const toggleButtons = document.querySelectorAll('[data-theme-toggle]');
    
    toggleButtons.forEach(button => {
        const circle = button.querySelector('[data-toggle-circle]');
        const sunIcon = button.querySelector('[data-sun-icon]');
        const moonIcon = button.querySelector('[data-moon-icon]');
        
        if (circle) circle.style.transform = isDark ? 'translateX(28px)' : 'translateX(0)';
        if (sunIcon) sunIcon.style.opacity = isDark ? '0' : '1';
        if (moonIcon) moonIcon.style.opacity = isDark ? '1' : '0';
    });
    
    return newTheme;
};