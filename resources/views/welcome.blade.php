<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GymIn - Your Fitness Journey Starts Here</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <!-- Navigation -->
        <nav class="bg-gradient-to-r from-red-600 to-black shadow-lg relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <h1 class="text-2xl font-bold text-white">GymIn</h1>
                            <p class="text-xs text-red-200">Equipment Store</p>
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <a href="/" class="text-white hover:text-red-200 px-3 py-2 rounded-md text-sm font-medium">Home</a>
                                
                                <!-- Products Dropdown -->
                                <div class="relative group">
                                    <button class="text-white hover:text-red-200 px-3 py-2 rounded-md text-sm font-medium flex items-center">
                                        Products
                                        <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                    <!-- Dropdown Menu -->
                                    <div class="absolute left-0 mt-2 w-64 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                                        <div class="py-2">
                                            <div class="px-4 py-2 text-sm font-semibold text-gray-700 border-b">Equipment Categories</div>
                                            <a href="{{ route('products.category', 'cardio') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition duration-200">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                                    </svg>
                                                    Cardio Equipment
                                                </div>
                                            </a>
                                            <a href="{{ route('products.category', 'strength') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition duration-200">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                                    </svg>
                                                    Strength Training
                                                </div>
                                            </a>
                                            <a href="{{ route('products.category', 'weights') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition duration-200">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                    </svg>
                                                    Weights & Dumbbells
                                                </div>
                                            </a>
                                            <a href="{{ route('products.category', 'accessories') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition duration-200">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"/>
                                                    </svg>
                                                    Accessories & Gear
                                                </div>
                                            </a>
                                            <a href="{{ route('products.category', 'supplements') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition duration-200">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                                    </svg>
                                                    Supplements & Nutrition
                                                </div>
                                            </a>
                                            <div class="border-t mt-2 pt-2">
                                                <a href="{{ route('products.index') }}" class="block px-4 py-2 text-sm font-semibold text-red-600 hover:bg-red-50 transition duration-200">
                                                    View All Products →
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <a href="{{ route('about') }}" class="text-white hover:text-red-200 px-3 py-2 rounded-md text-sm font-medium">About</a>
                                <a href="{{ route('contact') }}" class="text-white hover:text-red-200 px-3 py-2 rounded-md text-sm font-medium">Contact</a>
                            </div>
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
                                    <!-- Cart count badge (you can add Livewire component for dynamic count) -->
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
                                    
                                    <!-- Dropdown Menu -->
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
                                <a href="{{ route('login') }}" class="text-white hover:text-red-200 px-3 py-2 rounded-md text-sm font-medium">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="bg-white text-red-600 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition duration-200">Register</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative bg-gray-900 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-red-600 to-black opacity-75"></div>
            <div class="relative max-w-7xl mx-auto py-24 px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
                        Premium Gym Equipment Store
                    </h1>
                    <p class="mt-6 max-w-3xl mx-auto text-xl text-gray-300">
                        Transform your home or commercial gym with our professional-grade fitness equipment. From cardio machines to strength training gear, we have everything you need to build the perfect workout space.
                    </p>
                    <div class="mt-8 flex justify-center space-x-4">
                        <a href="/products" class="bg-red-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-700 transition duration-200 transform hover:scale-105">
                            Shop Equipment
                        </a>
                        <a href="#featured" class="bg-white text-red-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-200">
                            Featured Products
                        </a>
                    </div>
                </div>
            </div>
        </div>
                    </h1>
                    <p class="mt-6 max-w-lg mx-auto text-xl text-red-100 sm:max-w-3xl">
                        Join GymIn and discover the perfect fitness package for your goals. From personal training to nutrition plans, we've got everything you need to succeed.
                    </p>
                    <div class="mt-10 max-w-sm mx-auto sm:max-w-none sm:flex sm:justify-center">
                        <div class="space-y-4 sm:space-y-0 sm:space-x-4 sm:flex">
                            <a href="{{ route('products.index') }}" class="flex items-center justify-center px-4 py-3 border border-transparent text-base font-medium rounded-md text-red-600 bg-white hover:bg-gray-50 sm:px-8 transition duration-200 transform hover:scale-105">
                                Shop Equipment
                            </a>
                            <a href="#features" class="flex items-center justify-center px-4 py-3 border border-transparent text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-700 sm:px-8 transition duration-200 transform hover:scale-105">
                                Learn More
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div id="features" class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:text-center">
                    <h2 class="text-base text-red-600 font-semibold tracking-wide uppercase">Features</h2>
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                        Everything you need to reach your fitness goals
                    </p>
                    <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                        Our comprehensive platform provides all the tools and guidance you need for a successful fitness journey.
                    </p>
                </div>

                <div class="mt-16">
                    <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                        <div class="relative">
                            <dt>
                                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-red-500 text-white">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Personalized Training</p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-500">
                                Get custom workout routines designed specifically for your fitness level and goals.
                            </dd>
                        </div>

                        <div class="relative">
                            <dt>
                                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-black text-white">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Nutrition Planning</p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-500">
                                Customized meal plans and diet tracking to fuel your workouts and recovery.
                            </dd>
                        </div>

                        <div class="relative">
                            <dt>
                                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-red-500 text-white">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Expert Trainers</p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-500">
                                Work with certified personal trainers who understand your unique needs and challenges.
                            </dd>
                        </div>

                        <div class="relative">
                            <dt>
                                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-black text-white">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Progress Tracking</p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-500">
                                Monitor your progress with detailed analytics and achieve your goals faster.
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-gradient-to-r from-red-600 to-black">
            <div class="max-w-2xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                    <span class="block">Ready to start your fitness journey?</span>
                </h2>
                <p class="mt-4 text-lg leading-6 text-red-100">
                    Join thousands of members who have transformed their lives with GymIn.
                </p>
                <a href="{{ route('products.index') }}" class="mt-8 w-full inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-red-600 bg-white hover:bg-gray-50 sm:w-auto transition duration-200 transform hover:scale-105">
                    Get Started Today
                </a>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-black">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="col-span-1 md:col-span-2">
                        <h3 class="text-2xl font-bold text-white mb-4">GymIn</h3>
                        <p class="text-gray-300 max-w-md">
                            Your ultimate fitness companion. Transform your body, mind, and life with our comprehensive gym and nutrition programs.
                        </p>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-red-400 uppercase tracking-wider mb-4">Services</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-300 hover:text-white transition duration-200">Personal Training</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition duration-200">Nutrition Plans</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition duration-200">Group Classes</a></li>
                            <li><a href="{{ route('products.index') }}" class="text-gray-300 hover:text-white transition duration-200">Gym Equipment</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-red-400 uppercase tracking-wider mb-4">Company</h4>
                        <ul class="space-y-2">
                            <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-white transition duration-200">About Us</a></li>
                            <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-white transition duration-200">Contact</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition duration-200">Privacy Policy</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition duration-200">Terms of Service</a></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-8 border-t border-gray-700 pt-8">
                    <p class="text-center text-gray-400">
                        &copy; {{ date('Y') }} GymIn. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </body>
</html>