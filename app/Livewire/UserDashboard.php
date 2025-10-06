<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class UserDashboard extends Component
{
    public $user;
    public $stats = [];
    public $recentOrders = [];
    public $cartItems = [];

    public function mount()
    {
        $this->user = Auth::user();
        $this->loadUserStats();
        $this->loadRecentOrders();
        $this->loadCartItems();
    }

    public function loadUserStats()
    {
        $userId = Auth::id();
        
        $this->stats = [
            'cart_items' => Cart::where('user_id', $userId)->count(),
            'total_orders' => Order::where('user_id', $userId)->count(),
            'pending_orders' => Order::where('user_id', $userId)->where('status', 'pending')->count(),
            'completed_orders' => Order::where('user_id', $userId)->where('status', 'completed')->count(),
            'total_spent' => Order::where('user_id', $userId)->where('status', 'completed')->sum('total_amount') ?? 0,
        ];
    }

    public function loadRecentOrders()
    {
        $this->recentOrders = Order::where('user_id', Auth::id())
                                  ->latest()
                                  ->take(5)
                                  ->get();
    }

    public function loadCartItems()
    {
        $this->cartItems = Cart::with('product')
                              ->where('user_id', Auth::id())
                              ->latest()
                              ->take(3)
                              ->get();
    }

    public function render()
    {
        return view('livewire.user-dashboard');
    }
}
