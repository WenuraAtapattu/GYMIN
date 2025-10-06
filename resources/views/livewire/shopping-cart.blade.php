<div>
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-gray-900 via-red-900 to-gray-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Shopping Cart</h1>
                <p class="text-xl text-gray-300">Review your gym equipment selection</p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if(count($cartItems) > 0)
        <div class="lg:grid lg:grid-cols-3 lg:gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h8"/>
                            </svg>
                            Cart Items ({{ count($cartItems) }})
                        </h2>
                    </div>
                    
                    <div class="divide-y divide-gray-100">
                        @foreach($cartItems as $item)
                            <div class="p-6 hover:bg-gray-50 transition duration-200">
                                <div class="flex items-center space-x-6">
                                    <!-- Product Image -->
                                    <div class="flex-shrink-0">
                                        @if($item->package->image_url)
                                            <img src="{{ $item->package->image_url }}" alt="{{ $item->package->name }}" class="w-24 h-24 object-cover rounded-xl shadow-md">
                                        @else
                                            <div class="w-24 h-24 bg-gradient-to-br from-red-500 to-red-700 rounded-xl flex items-center justify-center shadow-md">
                                                <span class="text-white font-bold text-lg">{{ substr($item->package->name, 0, 2) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Product Details -->
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $item->product->name }}</h3>
                                        <div class="flex items-center space-x-4 mb-3">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                                                </svg>
                                                {{ ucfirst($item->product->category) }}
                                            </span>
                                            <span class="text-sm text-gray-500">${{ number_format($item->price_at_time, 2) }} each</span>
                                        </div>
                                        
                                        <!-- Quantity Controls -->
                                        <div class="flex items-center space-x-3">
                                            <span class="text-sm font-medium text-gray-700">Quantity:</span>
                                            <div class="flex items-center border border-gray-300 rounded-lg">
                                                <button 
                                                    wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})"
                                                    class="px-3 py-2 text-gray-600 hover:text-red-600 hover:bg-red-50 transition duration-200 rounded-l-lg"
                                                    {{ $item->quantity <= 1 ? 'disabled' : '' }}
                                                >
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                                    </svg>
                                                </button>
                                                <span class="px-4 py-2 bg-gray-50 font-semibold text-gray-900 min-w-[3rem] text-center">{{ $item->quantity }}</span>
                                                <button 
                                                    wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})"
                                                    class="px-3 py-2 text-gray-600 hover:text-red-600 hover:bg-red-50 transition duration-200 rounded-r-lg"
                                                >
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Price and Remove -->
                                    <div class="flex flex-col items-end space-y-4">
                                        <div class="text-right">
                                            <p class="text-2xl font-bold text-gray-900">${{ number_format($item->total_price, 2) }}</p>
                                            @if($item->quantity > 1)
                                                <p class="text-sm text-gray-500">${{ number_format($item->price_at_time, 2) }} × {{ $item->quantity }}</p>
                                            @endif
                                        </div>
                                        
                                        <button 
                                            wire:click="removeItem({{ $item->id }})"
                                            class="inline-flex items-center px-3 py-2 border border-red-300 text-sm font-medium rounded-lg text-red-700 bg-white hover:bg-red-50 hover:border-red-400 transition duration-200"
                                            title="Remove item"
                                        >
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- Order Summary -->
            <div class="lg:col-span-1 mt-8 lg:mt-0">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden sticky top-8">
                    <div class="bg-gradient-to-r from-gray-800 to-gray-900 px-6 py-4">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                            Order Summary
                        </h2>
                    </div>
                    
                    <div class="p-6">
                        <!-- Order Stats -->
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-gray-600">Total Items:</span>
                                <span class="font-semibold text-gray-900">{{ $this->getTotalItems() }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-gray-600">Subtotal:</span>
                                <span class="font-semibold text-gray-900">${{ number_format($this->getTotalAmount(), 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-gray-600">Shipping:</span>
                                <span class="font-semibold text-green-600">Free</span>
                            </div>
                            <div class="flex justify-between items-center py-3 bg-gray-50 rounded-lg px-4">
                                <span class="text-lg font-bold text-gray-900">Total:</span>
                                <span class="text-2xl font-bold text-red-600">${{ number_format($this->getTotalAmount(), 2) }}</span>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="space-y-3">
                            <button 
                                wire:click="toggleCheckout"
                                class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold py-4 px-6 rounded-xl transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center justify-center"
                            >
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                                Proceed to Checkout
                            </button>
                            
                            <a href="{{ route('products.index') }}" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-3 px-6 rounded-xl transition duration-200 flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                                </svg>
                                Continue Shopping
                            </a>
                            
                            <button 
                                wire:click="clearCart"
                                class="w-full border-2 border-gray-300 hover:border-red-400 text-gray-600 hover:text-red-600 font-semibold py-3 px-6 rounded-xl transition duration-200 flex items-center justify-center"
                            >
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Clear Cart
                            </button>
                        </div>
                        
                        <!-- Security Badge -->
                        <div class="mt-6 p-4 bg-green-50 rounded-lg border border-green-200">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm text-green-800 font-medium">Secure Checkout</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Checkout Modal -->
        @if($showCheckout)
            <div class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 p-4">
                <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full max-h-[90vh] overflow-y-auto">
                    <div class="bg-gradient-to-r from-red-600 to-red-700 p-6 rounded-t-2xl">
                        <h2 class="text-2xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Confirm Your Order
                        </h2>
                    </div>
                    
                    <div class="p-6">
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Summary:</h3>
                            <div class="bg-gray-50 rounded-xl p-4 space-y-3">
                                @foreach($cartItems as $item)
                                    <div class="flex justify-between items-center text-sm">
                                        <div>
                                            <span class="font-medium text-gray-900">{{ $item->product->name }}</span>
                                            <span class="text-gray-500"> × {{ $item->quantity }}</span>
                                        </div>
                                        <span class="font-semibold text-gray-900">${{ number_format($item->total_price, 2) }}</span>
                                    </div>
                                @endforeach
                                <div class="border-t pt-3">
                                    <div class="flex justify-between items-center font-bold text-lg">
                                        <span class="text-gray-900">Total:</span>
                                        <span class="text-red-600">${{ number_format($this->getTotalAmount(), 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex gap-3">
                            <button 
                                wire:click="toggleCheckout"
                                class="flex-1 px-4 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-xl transition duration-200"
                            >
                                Cancel
                            </button>
                            <button 
                                wire:click="checkout"
                                class="flex-1 px-4 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold rounded-xl transition duration-200 flex items-center justify-center"
                            >
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Place Order
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    @else
        <!-- Empty Cart with Beautiful Design -->
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-red-500/10 to-gray-900/10"></div>
                    <div class="relative px-8 py-16 text-center">
                        <!-- Empty Cart Icon -->
                        <div class="mx-auto w-32 h-32 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mb-8 shadow-inner">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h8"/>
                            </svg>
                        </div>
                        
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">Your Cart is Empty</h2>
                        <p class="text-xl text-gray-600 mb-8 max-w-md mx-auto">Ready to start your fitness journey? Browse our premium gym equipment collection!</p>
                        
                        <div class="space-y-4">
                            <a href="{{ route('products.index') }}" class="inline-flex items-center bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold py-4 px-8 rounded-xl transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                Browse Equipment
                            </a>
                            
                            <div class="text-sm text-gray-500">
                                <p>Or explore by category:</p>
                                <div class="flex flex-wrap justify-center gap-2 mt-3">
                                    <a href="{{ route('products.category', 'cardio') }}" class="px-3 py-1 bg-gray-100 hover:bg-red-100 text-gray-700 hover:text-red-700 rounded-lg transition duration-200">Cardio</a>
                                    <a href="{{ route('products.category', 'strength') }}" class="px-3 py-1 bg-gray-100 hover:bg-red-100 text-gray-700 hover:text-red-700 rounded-lg transition duration-200">Strength</a>
                                    <a href="{{ route('products.category', 'accessories') }}" class="px-3 py-1 bg-gray-100 hover:bg-red-100 text-gray-700 hover:text-red-700 rounded-lg transition duration-200">Accessories</a>
                                    <a href="{{ route('products.category', 'supplements') }}" class="px-3 py-1 bg-gray-100 hover:bg-red-100 text-gray-700 hover:text-red-700 rounded-lg transition duration-200">Supplements</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Flash Messages with Beautiful Design -->
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform translate-y-2" x-init="setTimeout(() => show = false, 4000)" class="fixed bottom-8 right-8 bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-4 rounded-xl shadow-2xl z-50 max-w-sm">
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform translate-y-2" x-init="setTimeout(() => show = false, 4000)" class="fixed bottom-8 right-8 bg-gradient-to-r from-red-500 to-red-600 text-white px-6 py-4 rounded-xl shadow-2xl z-50 max-w-sm">
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        </div>
    @endif
</div>
