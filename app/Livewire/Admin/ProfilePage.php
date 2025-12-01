<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProfilePage extends Component
{
    public $user, $initials;

    public function mount() {
        $this->user = User::where('id', Auth::id())->first();
        $names = explode(' ', $this->user->name);
        $this->initials = '';
        foreach (array_slice($names, 0, 2) as $n) {
            $this->initials .= strtoupper($n[0]);
        }
    }

    public function render()
    {
        return view('livewire.admin.profile')->layout('components.layouts.dashboard');
    }
}
