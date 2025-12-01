<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Validate;

class UserPage extends Component
{
    #[Validate('required|string|max:20')]
    public $nim;

    #[Validate('required|string|max:255')]
    public $name;

    #[Validate('required|email|max:255')]
    public $email;

    #[Validate('nullable|string|min:8')]
    public $password;

    #[Validate('required|numeric')]
    public $phone_number;

    #[Validate('required|string|in:admin,buyer')]
    public $role = 'buyer';

    public $users;
    public function mount() {
        $this->users = User::all();
    }

    public function delete($id)
    {
        if (Auth::user()->role !== 'admin') return session()->flash('error', 'You do not have permission to perform this action.');

        $product = User::find($id);

        if ($product) {
            $product->delete();
            session()->flash('message', 'User deleted successfully.');

            $this->users = User::all();
        } else {
            session()->flash('error', 'User not found.');
        }
    }

    public function save()
    {
        $this->validate();

        User::create([
            'nim' => $this->nim,
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'phone_number' => $this->phone_number,
            'role' => $this->role
        ]);

        session()->flash('message', 'User added successfully.');
        $this->users = User::all();
    }

    public function render()
    {
        return view('livewire.admin.user')->layout('components.layouts.dashboard');
    }
}
