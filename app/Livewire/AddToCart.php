<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AddToCart extends Component
{
    public $product;
    public $quantity = 1;
    public $isInCart = false;
    public $cartItemId = null;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->checkIfInCart();
    }

    public function checkIfInCart()
    {
        if (Auth::check()) {
            $cartItem = Cart::where('user_id', Auth::id())
                           ->where('product_id', $this->product->id)
                           ->first();
            
            if ($cartItem) {
                $this->isInCart = true;
                $this->cartItemId = $cartItem->id;
                $this->quantity = $cartItem->quantity;
            }
        }
    }

    public function addToCart()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Check if product is in stock
        if ($this->product->stock_quantity < $this->quantity) {
            session()->flash('error', 'Insufficient stock available.');
            return;
        }

        try {
            $existingCartItem = Cart::where('user_id', Auth::id())
                                  ->where('product_id', $this->product->id)
                                  ->first();

            if ($existingCartItem) {
                // Update quantity
                $newQuantity = $existingCartItem->quantity + $this->quantity;
                
                if ($this->product->stock_quantity < $newQuantity) {
                    session()->flash('error', 'Cannot add more items. Insufficient stock.');
                    return;
                }
                
                $existingCartItem->update(['quantity' => $newQuantity]);
                $this->quantity = $newQuantity;
            } else {
                // Create new cart item
                $cartItem = Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $this->product->id,
                    'quantity' => $this->quantity,
                    'price_at_time' => $this->product->sale_price ?? $this->product->price
                ]);
                $this->cartItemId = $cartItem->id;
            }

            $this->isInCart = true;
            $this->dispatch('cart-updated');
            session()->flash('success', 'Product added to cart successfully!');
            
        } catch (\Exception $e) {
            Log::error('Cart error: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'product_id' => $this->product->id
            ]);
            session()->flash('error', 'Failed to add product to cart. Please try again.');
        }
    }

    public function updateQuantity()
    {
        if (!Auth::check() || !$this->cartItemId) {
            return;
        }

        if ($this->quantity < 1) {
            $this->quantity = 1;
            return;
        }

        if ($this->product->stock_quantity < $this->quantity) {
            session()->flash('error', 'Insufficient stock available.');
            $this->quantity = $this->product->stock_quantity;
            return;
        }

        try {
            $cartItem = Cart::find($this->cartItemId);
            if ($cartItem) {
                $cartItem->update(['quantity' => $this->quantity]);
                $this->dispatch('cart-updated');
                session()->flash('success', 'Cart updated successfully!');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update cart. Please try again.');
        }
    }

    public function removeFromCart()
    {
        if (!Auth::check() || !$this->cartItemId) {
            return;
        }

        try {
            $cartItem = Cart::find($this->cartItemId);
            if ($cartItem) {
                $cartItem->delete();
                $this->isInCart = false;
                $this->cartItemId = null;
                $this->quantity = 1;
                $this->dispatch('cart-updated');
                session()->flash('success', 'Product removed from cart!');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to remove product from cart. Please try again.');
        }
    }

    public function incrementQuantity()
    {
        if ($this->quantity < $this->product->stock_quantity) {
            $this->quantity++;
            if ($this->isInCart) {
                $this->updateQuantity();
            }
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
            if ($this->isInCart) {
                $this->updateQuantity();
            }
        }
    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
