<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cookie;

class ThemeToggle extends Component
{
    public $darkMode = false;

    public function mount()
    {
        // Initialize dari cookie atau localStorage
        $theme = request()->cookie('theme', 'light');
        $this->darkMode = $theme === 'dark';
    }

    public function toggleTheme()
    {
        $this->darkMode = !$this->darkMode;
        $theme = $this->darkMode ? 'dark' : 'light';
        
        // Simpan di cookie (untuk server-side)
        Cookie::queue('theme', $theme, 60 * 24 * 365);
        Cookie::queue('kantinku_theme', $theme, 60 * 24 * 365);
        
        // Dispatch event ke frontend
        $this->dispatch('theme-toggled', theme: $theme);
    }

    public function render()
    {
        return view('livewire.theme-toggle');
    }
}