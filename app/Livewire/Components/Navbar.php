<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Navbar extends Component
{
    public $darkMode = false;
    public function toggleDarkMode()
    {
        $this->darkMode = !$this->darkMode;
        
        // Dispatch event ke JavaScript
        $this->dispatch('theme-changed', 
            theme: $this->darkMode ? 'dark' : 'light'
        );
    }

    public function render()
    {
        return view('livewire.components.navbar');
    }
}