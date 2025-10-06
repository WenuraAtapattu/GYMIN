<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <!-- Search and Filter Section -->
        <div class="flex flex-col md:flex-row gap-4 mb-6">
            <div class="flex-1">
                <input 
                    type="text" 
                    wire:model.live="search" 
                    placeholder="Search packages..." 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                >
            </div>
            
            <div class="w-full md:w-48">
                <select wire:model.live="selectedCategory" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}">{{ ucfirst($category) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Package Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($packages as $package)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 border border-gray-200">
                @if($package->image_url)
                    <img src="{{ $package->image_url }}" alt="{{ $package->name }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gradient-to-r from-red-500 to-black flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-12 h-12 text-white mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            <span class="text-white text-lg font-bold">{{ substr($package->name, 0, 2) }}</span>
                        </div>
                    </div>
                @endif
                
                <div class="p-6">
                    <div class="mb-2">
                        <span class="inline-block bg-{{ $package->category === 'fitness' ? 'red' : ($package->category === 'nutrition' ? 'green' : 'black') }}-100 text-{{ $package->category === 'fitness' ? 'red' : ($package->category === 'nutrition' ? 'green' : 'black') }}-800 text-xs px-2 py-1 rounded-full font-semibold">
                            {{ ucfirst($package->category) }}
                        </span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $package->name }}</h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $package->description }}</p>
                    
                    <div class="mb-4">
                        @if($package->discount_percentage > 0)
                            <div class="flex items-center gap-2">
                                <span class="text-2xl font-bold text-red-600">${{ number_format($package->discounted_price, 2) }}</span>
                                <span class="text-lg text-gray-500 line-through">${{ number_format($package->price, 2) }}</span>
                                <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded font-bold">{{ $package->discount_percentage }}% OFF</span>
                            </div>
                        @else
                            <span class="text-2xl font-bold text-gray-800">${{ number_format($package->price, 2) }}</span>
                        @endif
                        <p class="text-sm text-gray-500 font-medium">{{ $package->duration_months }} month(s)</p>
                    </div>
                    
                    <div class="mb-4">
                        <h4 class="text-sm font-bold text-gray-700 mb-2">Features:</h4>
                        <ul class="text-xs text-gray-600">
                            @foreach(array_slice($package->features, 0, 3) as $feature)
                                <li class="flex items-center gap-1 mb-1">
                                    <svg class="w-3 h-3 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    
                    <button 
                        wire:click="addToCart({{ $package->id }})"
                        class="w-full bg-gradient-to-r from-red-600 to-black text-white py-3 px-4 rounded-lg hover:from-red-700 hover:to-gray-900 transition-all duration-200 font-bold transform hover:scale-105"
                    >
                        Add to Cart
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <div class="text-red-400 text-6xl mb-4">🏋️</div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">No packages found</h3>
                <p class="text-gray-500">Try adjusting your search or filter criteria.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $packages->links() }}
    </div>

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('error') }}
        </div>
    @endif
</div>
