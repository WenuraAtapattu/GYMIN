<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $product->name }} - GymIn Equipment Store</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        body { font-family: 'Inter', sans-serif; }
        .product-image { transition: transform 0.6s ease; }
        .product-image:hover { transform: scale(1.02); }
        .price-badge { background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%); }
        .spec-card { backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.9); }
        .feature-item { transition: all 0.3s ease; }
        .feature-item:hover { transform: translateX(4px); background-color: #fef2f2; }
        .cta-button { background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%); box-shadow: 0 10px 30px rgba(220, 38, 38, 0.3); }
        .cta-button:hover { box-shadow: 0 15px 40px rgba(220, 38, 38, 0.4); transform: translateY(-2px); }
        .thumbnail-active { border: 2px solid #dc2626; box-shadow: 0 0 0 2px rgba(220, 38, 38, 0.2); }
    </style>
</head>
<body class="font-sans antialiased bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    
    <!-- Navigation -->
    <nav class="bg-white shadow-xl border-b border-gray-100 sticky top-0 z-50 backdrop-blur-lg bg-opacity-95">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center group">
                        <div class="flex-shrink-0">
                            <span class="text-3xl font-bold text-gray-900 group-hover:text-red-600 transition-colors duration-300">
                                Gym<span class="text-red-600">In</span>
                            </span>
                        </div>
                    </a>
                    
                    <div class="hidden md:ml-12 md:flex md:space-x-1">
                        <a href="{{ url('/') }}" class="text-gray-700 hover:text-red-600 px-4 py-2 rounded-xl text-sm font-medium transition-all duration-300 hover:bg-red-50">Home</a>
                        
                        <!-- Equipment Dropdown -->
                        <div class="relative group">
                            <button class="text-gray-700 hover:text-red-600 px-4 py-2 rounded-xl text-sm font-medium flex items-center transition-all duration-300 hover:bg-red-50 group-hover:bg-red-50">
                                Equipment
                                <svg class="ml-2 h-4 w-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="absolute left-0 mt-1 w-56 bg-white rounded-2xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 border border-gray-100">
                                <div class="py-3">
                                    <a href="{{ route('products.index') }}" class="block px-6 py-3 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-all duration-200 font-medium">All Equipment</a>
                                    <a href="{{ route('products.category', 'cardio') }}" class="block px-6 py-3 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-all duration-200">Cardio Machines</a>
                                    <a href="{{ route('products.category', 'strength') }}" class="block px-6 py-3 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-all duration-200">Strength Training</a>
                                    <a href="{{ route('products.category', 'accessories') }}" class="block px-6 py-3 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-all duration-200">Accessories</a>
                                    <a href="{{ route('products.category', 'supplements') }}" class="block px-6 py-3 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-all duration-200">Supplements</a>
                                </div>
                            </div>
                        </div>
                        
                        <a href="{{ url('/about') }}" class="text-gray-700 hover:text-red-600 px-4 py-2 rounded-xl text-sm font-medium transition-all duration-300 hover:bg-red-50">About</a>
                        <a href="{{ url('/contact') }}" class="text-gray-700 hover:text-red-600 px-4 py-2 rounded-xl text-sm font-medium transition-all duration-300 hover:bg-red-50">Contact</a>
                    </div>
                </div>
                
                <div class="flex items-center space-x-6">
                    @if (Route::has('login'))
                        @auth
                            <!-- Cart Icon -->
                            <a href="{{ route('cart') }}" class="relative group">
                                <div class="flex items-center justify-center w-12 h-12 bg-gray-100 hover:bg-red-50 rounded-2xl transition-all duration-300 group-hover:scale-105">
                                    <svg class="w-6 h-6 text-gray-600 group-hover:text-red-600 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h8"/>
                                    </svg>
                                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-medium">0</span>
                                </div>
                            </a>
                            
                            <!-- Profile Dropdown -->
                            <div class="relative group">
                                <button class="flex items-center space-x-3 p-2 rounded-2xl hover:bg-gray-50 transition-all duration-300 group">
                                    <img class="h-10 w-10 rounded-xl object-cover ring-2 ring-gray-200 group-hover:ring-red-200 transition-all duration-300" 
                                         src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=fff&background=dc2626&size=40" 
                                         alt="{{ auth()->user()->name }}">
                                    <div class="hidden md:block text-left">
                                        <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                                        <p class="text-xs text-gray-500">Premium Member</p>
                                    </div>
                                    <svg class="hidden md:block w-4 h-4 text-gray-400 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                
                                <div class="absolute right-0 mt-2 w-64 bg-white rounded-2xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 border border-gray-100">
                                    <div class="p-3">
                                        <div class="flex items-center space-x-3 p-3 bg-gradient-to-r from-red-50 to-red-100 rounded-xl mb-3">
                                            <img class="h-12 w-12 rounded-xl object-cover" 
                                                 src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=fff&background=dc2626&size=48" 
                                                 alt="{{ auth()->user()->name }}">
                                            <div>
                                                <p class="font-medium text-gray-900">{{ auth()->user()->name }}</p>
                                                <p class="text-sm text-gray-600">{{ auth()->user()->email }}</p>
                                            </div>
                                        </div>
                                        
                                        <a href="{{ route('profile.show') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-all duration-200 rounded-xl group">
                                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            My Profile
                                        </a>
                                        <a href="{{ route('cart') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-all duration-200 rounded-xl group">
                                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h8"/>
                                            </svg>
                                            Shopping Cart
                                        </a>
                                        <a href="/orders" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-all duration-200 rounded-xl group">
                                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                            </svg>
                                            Order History
                                        </a>
                                        <div class="border-t border-gray-100 mt-3 pt-3">
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="flex items-center w-full px-4 py-3 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-all duration-200 rounded-xl group">
                                                    <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                                    </svg>
                                                    Sign Out
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-red-600 px-6 py-2 rounded-xl text-sm font-medium transition-all duration-300 hover:bg-red-50">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-6 py-3 rounded-xl font-medium transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                    Sign up
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        
        <!-- Breadcrumb -->
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-red-600 transition-colors duration-300">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                                </svg>
                                Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-300 mx-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <a href="{{ route('products.index') }}" class="text-sm font-medium text-gray-500 hover:text-red-600 transition-colors duration-300">Products</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-300 mx-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <a href="{{ route('products.category', $product->category) }}" class="text-sm font-medium text-gray-500 hover:text-red-600 transition-colors duration-300">{{ ucfirst($product->category) }}</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-300 mx-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm font-medium text-gray-900">{{ $product->name }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Product Details -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="lg:grid lg:grid-cols-2 lg:gap-16 lg:items-start">
                
                <!-- Product Images -->
                <div class="flex flex-col space-y-6">
                    <!-- Main Image -->
                    <div class="relative aspect-square bg-white rounded-3xl overflow-hidden shadow-2xl border border-gray-100">
                        <img id="mainImage" src="{{ $product->main_image_url }}" alt="{{ $product->name }}" 
                             class="product-image w-full h-full object-cover">
                        
                        @if($product->is_on_sale)
                            <div class="price-badge absolute top-6 left-6 text-white px-4 py-2 rounded-2xl text-sm font-bold shadow-lg">
                                {{ $product->discount_percentage }}% OFF
                            </div>
                        @endif
                        
                        @if($product->is_featured)
                            <div class="absolute top-6 right-6 bg-yellow-400 text-yellow-900 px-3 py-1 rounded-2xl text-sm font-bold flex items-center shadow-lg">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                Featured
                            </div>
                        @endif
                    </div>
                    
                    <!-- Thumbnail Images -->
                    <div class="grid grid-cols-4 gap-4">
                        @for($i = 0; $i < 4; $i++)
                            <div class="aspect-square bg-white rounded-xl overflow-hidden shadow-lg border-2 border-transparent hover:border-red-200 cursor-pointer transition-all duration-300 {{ $i === 0 ? 'thumbnail-active' : '' }}"
                                 onclick="changeMainImage('{{ $product->main_image }}', this)">
                                <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- Product Info -->
                <div class="mt-10 lg:mt-0">
                    <!-- Product Header -->
                    <div class="mb-8">
                        @if($product->brand)
                            <p class="text-lg text-red-600 font-semibold mb-2">{{ $product->brand }}</p>
                        @endif
                        
                        <h1 class="text-4xl font-bold text-gray-900 mb-4 leading-tight">{{ $product->name }}</h1>
                        
                        @if($product->model)
                            <p class="text-lg text-gray-600 mb-4">Model: <span class="font-medium">{{ $product->model }}</span></p>
                        @endif

                        <!-- Rating -->
                        @if($product->rating && $product->review_count)
                            <div class="flex items-center mb-6">
                                <div class="flex items-center space-x-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= $product->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="ml-3 text-sm font-medium text-gray-700">{{ $product->rating }}.0</span>
                                <span class="ml-2 text-sm text-gray-500">({{ $product->review_count }} reviews)</span>
                            </div>
                        @endif
                    </div>

                    <!-- Price -->
                    <div class="mb-8 p-6 bg-gradient-to-r from-gray-50 to-gray-100 rounded-2xl border border-gray-200">
                        @if($product->is_on_sale)
                            <div class="flex items-baseline space-x-4 mb-2">
                                <span class="text-5xl font-bold text-red-600">${{ number_format($product->sale_price, 2) }}</span>
                                <span class="text-2xl text-gray-500 line-through">${{ number_format($product->price, 2) }}</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="bg-red-100 text-red-800 text-sm font-bold px-3 py-1 rounded-full">
                                    Save ${{ number_format($product->price - $product->sale_price, 2) }}
                                </span>
                                <span class="text-sm text-gray-600">{{ $product->discount_percentage }}% discount</span>
                            </div>
                        @else
                            <span class="text-5xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                        @endif
                    </div>

                    <!-- Stock Status -->
                    <div class="mb-8">
                        @if($product->stock_quantity > 0)
                            <div class="flex items-center p-4 bg-green-50 rounded-2xl border border-green-200">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800">In Stock</p>
                                    <p class="text-sm text-green-600">{{ $product->stock_quantity }} units available</p>
                                </div>
                            </div>
                        @else
                            <div class="flex items-center p-4 bg-red-50 rounded-2xl border border-red-200">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-red-800">Out of Stock</p>
                                    <p class="text-sm text-red-600">Item currently unavailable</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="mb-8 p-6 bg-white rounded-2xl border border-gray-200 shadow-sm">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Product Description
                        </h3>
                        <p class="text-gray-700 leading-relaxed text-lg">{{ $product->description }}</p>
                    </div>

                    <!-- Add to Cart -->
                    <!-- Add to Cart Component -->
                    <div class="mb-8 p-6 bg-white rounded-2xl border border-gray-200 shadow-sm">
                        @livewire('add-to-cart', ['product' => $product])
                    </div>

                    <!-- Product Features -->
                    @if($product->features && count($product->features) > 0)
                        <div class="mb-8 p-6 bg-white rounded-2xl border border-gray-200 shadow-sm">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Key Features
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach($product->features as $feature)
                                    <div class="feature-item flex items-center p-3 rounded-xl transition-all duration-300">
                                        <div class="flex-shrink-0 w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </div>
                                        <span class="text-gray-800 font-medium">{{ $feature }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Product Details Tabs -->
                    <div class="space-y-6">
                        
                        <!-- Specifications -->
                        @if($product->specifications && count($product->specifications) > 0)
                            <div class="spec-card border border-gray-200 rounded-2xl overflow-hidden shadow-sm">
                                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                                    <h3 class="text-xl font-bold text-gray-900 flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                        Technical Specifications
                                    </h3>
                                </div>
                                <div class="p-6">
                                    <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                        @foreach($product->specifications as $key => $value)
                                            <div class="flex justify-between py-3 border-b border-gray-100 last:border-b-0">
                                                <dt class="text-sm font-semibold text-gray-600">{{ $key }}</dt>
                                                <dd class="text-sm text-gray-900 font-medium">{{ $value }}</dd>
                                            </div>
                                        @endforeach
                                    </dl>
                                </div>
                            </div>
                        @endif

                        <!-- Additional Info -->
                        <div class="spec-card border border-gray-200 rounded-2xl overflow-hidden shadow-sm">
                            <div class="bg-gradient-to-r from-blue-50 to-blue-100 px-6 py-4 border-b border-gray-200">
                                <h3 class="text-xl font-bold text-gray-900 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Product Information
                                </h3>
                            </div>
                            <div class="p-6">
                                <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                    @if($product->model)
                                        <div class="flex justify-between py-3 border-b border-gray-100">
                                            <dt class="text-sm font-semibold text-gray-600">Model</dt>
                                            <dd class="text-sm text-gray-900 font-medium">{{ $product->model }}</dd>
                                        </div>
                                    @endif
                                    @if($product->sku)
                                        <div class="flex justify-between py-3 border-b border-gray-100">
                                            <dt class="text-sm font-semibold text-gray-600">SKU</dt>
                                            <dd class="text-sm text-gray-900 font-medium">{{ $product->sku }}</dd>
                                        </div>
                                    @endif
                                    @if($product->weight)
                                        <div class="flex justify-between py-3 border-b border-gray-100">
                                            <dt class="text-sm font-semibold text-gray-600">Weight</dt>
                                            <dd class="text-sm text-gray-900 font-medium">{{ $product->weight }} kg</dd>
                                        </div>
                                    @endif
                                    @if($product->dimensions)
                                        <div class="flex justify-between py-3 border-b border-gray-100">
                                            <dt class="text-sm font-semibold text-gray-600">Dimensions</dt>
                                            <dd class="text-sm text-gray-900 font-medium">{{ $product->dimensions }}</dd>
                                        </div>
                                    @endif
                                    @if($product->warranty)
                                        <div class="flex justify-between py-3 border-b border-gray-100">
                                            <dt class="text-sm font-semibold text-gray-600">Warranty</dt>
                                            <dd class="text-sm text-gray-900 font-medium">{{ $product->warranty }}</dd>
                                        </div>
                                    @endif
                                    <div class="flex justify-between py-3">
                                        <dt class="text-sm font-semibold text-gray-600">Condition</dt>
                                        <dd class="text-sm text-gray-900 font-medium">{{ ucfirst($product->condition) }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts && count($relatedProducts) > 0)
            <div class="bg-gradient-to-br from-gray-50 to-gray-100 py-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h2 class="text-4xl font-bold text-gray-900 mb-4">You Might Also Like</h2>
                        <p class="text-lg text-gray-600">Discover more premium equipment from the same category</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        @foreach($relatedProducts as $related)
                            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 group transform hover:-translate-y-2">
                                <div class="relative h-64 bg-gray-100 overflow-hidden">
                                    <img src="{{ $related->main_image_url }}" alt="{{ $related->name }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    
                                    @if($related->is_on_sale)
                                        <div class="absolute top-4 left-4 bg-red-600 text-white px-3 py-1 rounded-full text-sm font-bold">
                                            {{ $related->discount_percentage }}% OFF
                                        </div>
                                    @endif
                                    
                                    @if($related->is_featured)
                                        <div class="absolute top-4 right-4 bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-bold">
                                            ⭐ Featured
                                        </div>
                                    @endif
                                </div>

                                <div class="p-6">
                                    <div class="mb-3">
                                        @if($related->brand)
                                            <p class="text-sm font-semibold text-red-600 mb-1">{{ $related->brand }}</p>
                                        @endif
                                        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-red-600 transition-colors duration-300">{{ $related->name }}</h3>
                                    </div>
                                    
                                    <!-- Rating -->
                                    @if($related->rating && $related->review_count)
                                        <div class="flex items-center mb-3">
                                            <div class="flex items-center space-x-1">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <svg class="w-4 h-4 {{ $i <= $related->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                @endfor
                                            </div>
                                            <span class="ml-2 text-xs text-gray-600">({{ $related->review_count }})</span>
                                        </div>
                                    @endif
                                    
                                    <div class="flex items-center justify-between mb-4">
                                        <div>
                                            @if($related->is_on_sale)
                                                <span class="text-xl font-bold text-red-600">${{ number_format($related->sale_price, 2) }}</span>
                                                <span class="text-sm text-gray-500 line-through ml-2">${{ number_format($related->price, 2) }}</span>
                                            @else
                                                <span class="text-xl font-bold text-gray-900">${{ number_format($related->price, 2) }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <a href="{{ route('products.show', $related) }}" 
                                       class="block w-full bg-gray-100 hover:bg-red-600 text-gray-800 hover:text-white text-center py-3 px-4 rounded-xl font-semibold transition-all duration-300 group-hover:bg-red-600 group-hover:text-white">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center mb-4">
                        <span class="text-3xl font-bold">Gym<span class="text-red-400">In</span></span>
                    </div>
                    <p class="text-gray-400 mb-6 max-w-md">Your trusted partner for professional gym equipment and fitness solutions. Quality equipment for serious athletes and fitness enthusiasts.</p>
                    
                    <div class="flex space-x-4">
                        <a href="#" class="bg-gray-800 hover:bg-red-600 p-2 rounded-lg transition-colors duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="bg-gray-800 hover:bg-red-600 p-2 rounded-lg transition-colors duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="bg-gray-800 hover:bg-red-600 p-2 rounded-lg transition-colors duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.097.118.112.222.085.343-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.758-1.378l-.749 2.848c-.269 1.045-1.004 2.352-1.498 3.146 1.123.345 2.306.535 3.55.535 6.624 0 11.99-5.367 11.99-11.987C24.007 5.367 18.641.001 12.017.001z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-6">Quick Links</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ url('/') }}" class="text-gray-400 hover:text-white transition-colors duration-300">Home</a></li>
                        <li><a href="{{ route('products.index') }}" class="text-gray-400 hover:text-white transition-colors duration-300">All Equipment</a></li>
                        <li><a href="{{ url('/about') }}" class="text-gray-400 hover:text-white transition-colors duration-300">About Us</a></li>
                        <li><a href="{{ url('/contact') }}" class="text-gray-400 hover:text-white transition-colors duration-300">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Support</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-6">Categories</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('products.category', 'cardio') }}" class="text-gray-400 hover:text-white transition-colors duration-300">Cardio Equipment</a></li>
                        <li><a href="{{ route('products.category', 'strength') }}" class="text-gray-400 hover:text-white transition-colors duration-300">Strength Training</a></li>
                        <li><a href="{{ route('products.category', 'accessories') }}" class="text-gray-400 hover:text-white transition-colors duration-300">Accessories</a></li>
                        <li><a href="{{ route('products.category', 'supplements') }}" class="text-gray-400 hover:text-white transition-colors duration-300">Supplements</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-12 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm">&copy; 2024 GymIn Equipment Store. All rights reserved.</p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-300">Privacy Policy</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-300">Terms of Service</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-300">Shipping Info</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript for image gallery -->
    <script>
        function changeMainImage(imageSrc, thumbnail) {
            document.getElementById('mainImage').src = imageSrc;
            
            // Remove active class from all thumbnails
            document.querySelectorAll('.grid > div').forEach(div => {
                div.classList.remove('thumbnail-active');
            });
            
            // Add active class to clicked thumbnail
            thumbnail.classList.add('thumbnail-active');
        }
    </script>

    @livewireScripts
</body>
</html>