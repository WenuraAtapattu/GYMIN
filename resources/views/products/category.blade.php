<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $categoryName }} - GymIn Equipment Store</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-50">
    
    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-gray-900 to-red-800 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center">
                        <div class="flex-shrink-0">
                            <span class="text-2xl font-bold text-white">Gym<span class="text-red-400">In</span></span>
                        </div>
                    </a>
                    
                    <div class="hidden md:ml-8 md:flex md:space-x-8">
                        <a href="{{ url('/') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition duration-200">Home</a>
                        
                        <!-- Equipment Dropdown -->
                        <div class="relative group">
                            <button class="text-white px-3 py-2 rounded-md text-sm font-medium flex items-center transition duration-200">
                                Equipment
                                <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                                <div class="py-2">
                                    <a href="{{ route('products.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition duration-200">All Equipment</a>
                                    <a href="{{ route('products.category', 'cardio') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition duration-200">Cardio</a>
                                    <a href="{{ route('products.category', 'strength') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition duration-200">Strength</a>
                                    <a href="{{ route('products.category', 'accessories') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition duration-200">Accessories</a>
                                    <a href="{{ route('products.category', 'supplements') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition duration-200">Supplements</a>
                                </div>
                            </div>
                        </div>
                        
                        <a href="{{ url('/about') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition duration-200">About</a>
                        <a href="{{ url('/contact') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition duration-200">Contact</a>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <!-- Cart Icon -->
                            <a href="{{ route('cart') }}" class="text-white hover:text-red-200 px-3 py-2 rounded-md text-sm font-medium relative">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h8"/>
                                </svg>
                                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">0</span>
                            </a>
                            
                            <!-- Profile Dropdown -->
                            <div class="relative group">
                                <button class="flex items-center text-white hover:text-red-200 px-3 py-2 rounded-md text-sm font-medium">
                                    <img class="h-8 w-8 rounded-full mr-2" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=fff&background=dc2626" alt="{{ auth()->user()->name }}">
                                    <span>{{ auth()->user()->name }}</span>
                                    <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                
                                <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                                    <div class="py-2">
                                        <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition duration-200">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                                My Profile
                                            </div>
                                        </a>
                                        <a href="{{ route('cart') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition duration-200">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h8"/>
                                                </svg>
                                                Shopping Cart
                                            </div>
                                        </a>
                                        <a href="/orders" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition duration-200">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                                </svg>
                                                My Orders
                                            </div>
                                        </a>
                                        <div class="border-t mt-2 pt-2">
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition duration-200">
                                                    <div class="flex items-center">
                                                        <svg class="w-4 h-4 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                                        </svg>
                                                        Sign Out
                                                    </div>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-white hover:text-red-200 px-3 py-2 rounded-md text-sm font-medium transition duration-200">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">Sign up</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
<div class="bg-gray-50 min-h-screen">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-red-600 to-black text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4">{{ $categoryName }}</h1>
                <p class="text-xl text-red-100">Professional-grade {{ strtolower($categoryName) }} for your fitness goals</p>
            </div>
        </div>
    </div>

    <!-- Breadcrumb -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('welcome') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-red-600">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <a href="{{ route('products.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-red-600 md:ml-2">Products</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $categoryName }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Products Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        @if($products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-200 group">
                        <!-- Product Image -->
                        <div class="relative h-48 bg-gray-200">
                            <img src="{{ $product->main_image }}" alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            
                            @if($product->is_on_sale)
                                <div class="absolute top-2 left-2 bg-red-600 text-white px-2 py-1 rounded text-sm font-semibold">
                                    {{ $product->discount_percentage }}% OFF
                                </div>
                            @endif
                            
                            @if($product->is_featured)
                                <div class="absolute top-2 right-2 bg-yellow-500 text-white px-2 py-1 rounded text-sm font-semibold">
                                    Featured
                                </div>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">{{ $product->name }}</h3>
                            
                            @if($product->brand)
                                <p class="text-sm text-gray-600 mb-2">{{ $product->brand }}</p>
                            @endif

                            <!-- Price -->
                            <div class="flex items-center justify-between mb-3">
                                <div>
                                    @if($product->is_on_sale)
                                        <span class="text-lg font-bold text-red-600">${{ number_format($product->sale_price, 2) }}</span>
                                        <span class="text-sm text-gray-500 line-through ml-2">${{ number_format($product->price, 2) }}</span>
                                    @else
                                        <span class="text-lg font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>
                                
                                @if($product->stock_quantity > 0)
                                    <span class="text-sm text-green-600 font-medium">In Stock</span>
                                @else
                                    <span class="text-sm text-red-600 font-medium">Out of Stock</span>
                                @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-2">
                                <a href="{{ route('products.show', $product) }}" 
                                   class="flex-1 bg-red-600 text-white text-center py-2 px-4 rounded-lg hover:bg-red-700 transition duration-200 font-medium">
                                    View Details
                                </a>
                                @if($product->stock_quantity > 0)
                                    <button class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition duration-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h8"/>
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $products->links() }}
            </div>
        @else
            <!-- No Products Found -->
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m0 0V9a2 2 0 012-2h2m0 0V6a2 2 0 012-2h2"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No products found</h3>
                <p class="mt-1 text-sm text-gray-500">No {{ strtolower($categoryName) }} available at the moment.</p>
                <div class="mt-6">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                        View All Products
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">GymIn Equipment</h3>
                    <p class="text-gray-400">Your trusted partner for professional gym equipment and fitness solutions.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ url('/') }}" class="text-gray-400 hover:text-white transition duration-200">Home</a></li>
                        <li><a href="{{ route('products.index') }}" class="text-gray-400 hover:text-white transition duration-200">Equipment</a></li>
                        <li><a href="{{ url('/about') }}" class="text-gray-400 hover:text-white transition duration-200">About</a></li>
                        <li><a href="{{ url('/contact') }}" class="text-gray-400 hover:text-white transition duration-200">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Categories</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('products.category', 'cardio') }}" class="text-gray-400 hover:text-white transition duration-200">Cardio Equipment</a></li>
                        <li><a href="{{ route('products.category', 'strength') }}" class="text-gray-400 hover:text-white transition duration-200">Strength Training</a></li>
                        <li><a href="{{ route('products.category', 'accessories') }}" class="text-gray-400 hover:text-white transition duration-200">Accessories</a></li>
                        <li><a href="{{ route('products.category', 'supplements') }}" class="text-gray-400 hover:text-white transition duration-200">Supplements</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact Info</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li>Email: info@gymin.com</li>
                        <li>Phone: (555) 123-4567</li>
                        <li>Address: 123 Fitness St, Gym City</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 GymIn Equipment Store. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>