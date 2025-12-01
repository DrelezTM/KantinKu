<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\User;
use App\Models\Visit;
use Livewire\Component;

class DashboardPage extends Component
{
    public $totalVisitors, $totalUsers, $totalProducts;
    public $visitorsPerMonth = [];
    public $usersPerMonth = [];
    public $productsPerMonth = [];

    public function mount() {
        $this->totalVisitors = Visit::count();
        $this->totalUsers = User::count();
        $this->totalProducts = Product::count();

        $this->visitorsPerMonth = Visit::selectRaw('COUNT(*) as total, MONTH(created_at) as month')->groupBy('month')->orderBy('month')->pluck('total', 'month')->toArray();
        $this->usersPerMonth = User::selectRaw('COUNT(*) as total, MONTH(created_at) as month')->groupBy('month')->orderBy('month')->pluck('total', 'month')->toArray();
        $this->productsPerMonth = Product::selectRaw('COUNT(*) as total, MONTH(created_at) as month')->groupBy('month')->orderBy('month')->pluck('total', 'month')->toArray();
    }

    public function getMonthlyArray($data)
    {
        $final = [];
        for ($i = 1; $i <= 12; $i++) {
            $final[] = $data[$i] ?? 0;
        }
        return $final;
    }

    public function render()
    {
        return view('livewire.dashboard', [
            'visitors' => $this->getMonthlyArray($this->visitorsPerMonth),
            'users' => $this->getMonthlyArray($this->usersPerMonth),
            'products' => $this->getMonthlyArray($this->productsPerMonth)
        ])->layout('components.layouts.dashboard');
    }
}
