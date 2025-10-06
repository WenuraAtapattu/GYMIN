<?php

namespace App\Livewire;

use App\Models\Package;
use App\Models\Cart;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class PackageList extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategory = '';
    public $sortBy = 'name';
    public $sortDirection = 'asc';

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCategory' => ['except' => ''],
        'sortBy' => ['except' => 'name'],
        'sortDirection' => ['except' => 'asc']
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedCategory()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function addToCart($packageId)
    {
        if (!Auth::check()) {
            session()->flash('error', 'Please login to add items to cart');
            return redirect()->route('login');
        }

        $package = Package::findOrFail($packageId);
        
        $existingCartItem = Cart::where('user_id', Auth::id())
                               ->where('package_id', $packageId)
                               ->first();

        if ($existingCartItem) {
            $existingCartItem->increment('quantity');
            session()->flash('success', 'Package quantity updated in cart!');
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'package_id' => $packageId,
                'quantity' => 1,
                'price_at_time' => $package->discounted_price
            ]);
            session()->flash('success', 'Package added to cart!');
        }

        $this->dispatch('cart-updated');
    }

    public function render()
    {
        $query = Package::active();

        // Apply search filter
        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        // Apply category filter
        if ($this->selectedCategory) {
            $query->byCategory($this->selectedCategory);
        }

        // Apply sorting
        $query->orderBy($this->sortBy, $this->sortDirection);

        $packages = $query->paginate(12);
        
        $categories = Package::select('category')
                            ->distinct()
                            ->pluck('category');

        return view('livewire.package-list', compact('packages', 'categories'));
    }
}
