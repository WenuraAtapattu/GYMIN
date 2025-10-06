<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shopping Cart - GymIn Equipment Store</title>
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
                            <button class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium flex items-center transition duration-200">
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
        @livewire('shopping-cart')
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