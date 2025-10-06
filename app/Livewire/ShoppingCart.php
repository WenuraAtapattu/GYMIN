<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShoppingCart extends Component
{
    public $cartItems = [];
    public $showCheckout = false;

    protected $listeners = ['cart-updated' => 'loadCartItems'];

    public function mount()
    {
        $this->loadCartItems();
    }

    public function loadCartItems()
    {
        if (Auth::check()) {
            $this->cartItems = Cart::with('product')
                                   ->where('user_id', Auth::id())
                                   ->get();
        }
    }

    public function updateQuantity($cartItemId, $quantity)
    {
        if ($quantity <= 0) {
            $this->removeItem($cartItemId);
            return;
        }

        $cartItem = Cart::findOrFail($cartItemId);
        $cartItem->update(['quantity' => $quantity]);
        
        $this->loadCartItems();
        session()->flash('success', 'Cart updated successfully!');
    }

    public function removeItem($cartItemId)
    {
        Cart::findOrFail($cartItemId)->delete();
        $this->loadCartItems();
        session()->flash('success', 'Item removed from cart!');
    }

    public function clearCart()
    {
        Cart::where('user_id', Auth::id())->delete();
        $this->loadCartItems();
        session()->flash('success', 'Cart cleared!');
    }

    public function toggleCheckout()
    {
        $this->showCheckout = !$this->showCheckout;
    }

    public function checkout()
    {
        if (collect($this->cartItems)->isEmpty()) {
            session()->flash('error', 'Your cart is empty!');
            return;
        }

        DB::transaction(function () {
            foreach ($this->cartItems as $cartItem) {
                Order::create([
                    'user_id' => Auth::id(),
                    'product_id' => $cartItem->product_id,
                    'total_amount' => $cartItem->total_price,
                    'status' => 'pending',
                    'payment_status' => 'pending',
                    'order_details' => [
                        'product_name' => $cartItem->product->name,
                        'quantity' => $cartItem->quantity,
                        'price_per_item' => $cartItem->price_at_time
                    ]
                ]);
            }

            // Clear cart after checkout
            Cart::where('user_id', Auth::id())->delete();
        });

        $this->loadCartItems();
        $this->showCheckout = false;
        session()->flash('success', 'Order placed successfully! You will receive confirmation soon.');
    }

    public function getTotalAmount()
    {
        return collect($this->cartItems)->sum('total_price');
    }

    public function getTotalItems()
    {
        return collect($this->cartItems)->sum('quantity');
    }

    public function render()
    {
        return view('livewire.shopping-cart');
    }
}
