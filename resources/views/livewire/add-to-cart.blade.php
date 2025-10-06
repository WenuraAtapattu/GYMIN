<div>
    <!-- Quantity Selection -->
    <div class="mb-6">
        <label for="quantity" class="block text-sm font-bold text-gray-700 mb-3">Quantity:</label>
        <div class="flex items-center space-x-4">
            <div class="flex items-center border-2 border-gray-200 rounded-xl overflow-hidden">
                <button wire:click="decrementQuantity" 
                        class="px-4 py-2 bg-gray-50 hover:bg-gray-100 text-gray-600 font-bold transition-colors duration-200">
                    −
                </button>
                <input wire:model.live="quantity" 
                       wire:change="updateQuantity"
                       type="number" 
                       min="1" 
                       max="{{ $product->stock_quantity }}"
                       class="w-16 py-2 text-center border-0 focus:ring-0 font-semibold">
                <button wire:click="incrementQuantity" 
                        class="px-4 py-2 bg-gray-50 hover:bg-gray-100 text-gray-600 font-bold transition-colors duration-200">
                    +
                </button>
            </div>
            
            @if($product->stock_quantity > 0)
                <div class="flex items-center text-green-600 text-sm">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>In Stock</span>
                </div>
                <span class="text-sm text-gray-500">{{ $product->stock_quantity }} units available</span>
            @else
                <div class="flex items-center text-red-600 text-sm">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <span>Out of Stock</span>
                </div>
            @endif
        </div>
        
        <!-- Free Shipping Notice -->
        <div class="mt-4 flex items-center text-green-600 text-sm bg-green-50 p-3 rounded-lg">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            <span>Free shipping on orders over $500</span>
        </div>
    </div>
    
    <!-- Action Buttons -->
    @if($product->stock_quantity > 0)
        <div class="flex space-x-4">
            @if(!$isInCart)
                <button wire:click="addToCart" 
                        wire:loading.attr="disabled"
                        class="cta-button flex-1 text-white font-bold py-4 px-8 rounded-2xl transition-all duration-300 flex items-center justify-center text-lg disabled:opacity-50">
                    <div wire:loading wire:target="addToCart" class="mr-3">
                        <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                    <div wire:loading.remove wire:target="addToCart">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h8"/>
                        </svg>
                    </div>
                    <span wire:loading.remove wire:target="addToCart">Add to Cart</span>
                    <span wire:loading wire:target="addToCart">Adding...</span>
                </button>
            @else
                <div class="flex-1 space-y-3">
                    <div class="flex items-center justify-center bg-green-100 text-green-800 font-bold py-4 px-8 rounded-2xl">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        In Cart ({{ $quantity }})
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('cart') }}" 
                           class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 text-center">
                            View Cart
                        </a>
                        <button wire:click="removeFromCart"
                                wire:loading.attr="disabled"
                                class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 disabled:opacity-50">
                            <span wire:loading.remove wire:target="removeFromCart">Remove</span>
                            <span wire:loading wire:target="removeFromCart">Removing...</span>
                        </button>
                    </div>
                </div>
            @endif
            
            <button class="bg-white hover:bg-gray-50 border-2 border-gray-200 hover:border-red-300 text-gray-800 font-semibold py-4 px-6 rounded-2xl transition-all duration-300 group">
                <svg class="w-6 h-6 group-hover:text-red-600 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </button>
            
            <button class="bg-white hover:bg-gray-50 border-2 border-gray-200 hover:border-red-300 text-gray-800 font-semibold py-4 px-6 rounded-2xl transition-all duration-300 group">
                <svg class="w-6 h-6 group-hover:text-red-600 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/>
                </svg>
            </button>
        </div>
    @else
        <div class="mb-8 p-6 bg-gray-50 rounded-2xl border border-gray-200">
            <button disabled class="w-full bg-gray-400 text-white font-bold py-4 px-8 rounded-2xl cursor-not-allowed">
                Out of Stock
            </button>
            <p class="text-center text-gray-600 mt-3">Notify me when this item is back in stock</p>
        </div>
    @endif

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif
</div>
