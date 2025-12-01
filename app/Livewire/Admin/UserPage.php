<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserPage extends Component
{
    public $users;
    public function mount() {
        $this->users = \App\Models\User::all();
    }

    public function delete($id)
    {
        if (Auth::user()->role !== 'admin') return session()->flash('error', 'You do not have permission to perform this action.');

        $product = \App\Models\User::find($id);

        if ($product) {
            $product->delete();
            session()->flash('message', 'User deleted successfully.');

            $this->redirect('/dashboard/users');
        } else {
            session()->flash('error', 'User not found.');
        }
    }

    public function render()
    {
        return view('livewire.admin.user')->layout('components.layouts.dashboard');
    }
}
