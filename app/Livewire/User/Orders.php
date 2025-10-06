<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class Orders extends Component
{
    public $orders;
    public $statusFilter = 'all';

    public function mount()
    {
        $this->loadOrders();
    }

    public function loadOrders()
    {
        $query = Order::where('user_id', Auth::id())
                     ->with(['product' => function($query) {
                         $query->withDefault([
                             'name' => 'Product Not Available',
                             'images' => null,
                             'main_image' => null
                         ]);
                     }])
                     ->latest();

        if ($this->statusFilter !== 'all') {
            $query->where('status', $this->statusFilter);
        }

        $this->orders = $query->get();
    }

    public function updateStatusFilter($status)
    {
        $this->statusFilter = $status;
        $this->loadOrders();
    }

    public function render()
    {
        return view('livewire.user.orders');
    }
}
