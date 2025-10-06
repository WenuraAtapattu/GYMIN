@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-red-600 to-black shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="{{ route('welcome') }}" class="text-2xl font-bold text-white">GymIn</a>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <a href="{{ route('welcome') }}" class="text-white hover:text-red-200 px-3 py-2 rounded-md text-sm font-medium">Home</a>
                            <a href="{{ route('products.index') }}" class="text-white hover:text-red-200 px-3 py-2 rounded-md text-sm font-medium">Equipment</a>
                            <a href="{{ route('about') }}" class="text-red-200 px-3 py-2 rounded-md text-sm font-medium">About</a>
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
    <div class="bg-gradient-to-r from-red-600 to-black py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold text-white sm:text-5xl">About GymIn</h1>
                <p class="mt-4 text-xl text-red-100">Your trusted partner in fitness transformation</p>
            </div>
        </div>
    </div>

    <!-- About Content -->
    <div class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-6">Our Story</h2>
                    <p class="text-lg text-gray-600 mb-6">
                        GymIn was founded with a simple mission: to make fitness accessible, enjoyable, and effective for everyone. We believe that every person deserves the opportunity to transform their body and mind through proper fitness guidance and nutrition.
                    </p>
                    <p class="text-lg text-gray-600 mb-6">
                        Our platform combines cutting-edge technology with expert knowledge from certified trainers and nutritionists to provide you with personalized fitness solutions that actually work.
                    </p>
                    <div class="grid grid-cols-2 gap-6 mt-8">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-red-600">1000+</div>
                            <div class="text-gray-600">Happy Members</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-red-600">50+</div>
                            <div class="text-gray-600">Expert Trainers</div>
                        </div>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-red-500 to-black p-8 rounded-2xl text-white">
                    <h3 class="text-2xl font-bold mb-4">Our Mission</h3>
                    <p class="mb-4">
                        To empower individuals to achieve their fitness goals through personalized training programs, expert guidance, and a supportive community.
                    </p>
                    <h3 class="text-2xl font-bold mb-4">Our Vision</h3>
                    <p>
                        To become the leading digital fitness platform that transforms lives and builds healthier communities worldwide.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Section -->
    <div class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900">Meet Our Expert Team</h2>
                <p class="mt-4 text-lg text-gray-600">Certified professionals dedicated to your success</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                    <div class="bg-red-500 w-20 h-20 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <span class="text-white text-2xl font-bold">JD</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">John Doe</h3>
                    <p class="text-red-600 mb-2">Head Trainer</p>
                    <p class="text-gray-600">15+ years of experience in personal training and fitness coaching.</p>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                    <div class="bg-black w-20 h-20 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <span class="text-white text-2xl font-bold">SM</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">Sarah Miller</h3>
                    <p class="text-red-600 mb-2">Nutrition Specialist</p>
                    <p class="text-gray-600">Certified nutritionist specializing in sports nutrition and meal planning.</p>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                    <div class="bg-red-500 w-20 h-20 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <span class="text-white text-2xl font-bold">MJ</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">Mike Johnson</h3>
                    <p class="text-red-600 mb-2">Strength Coach</p>
                    <p class="text-gray-600">Expert in strength training and muscle building programs.</p>
                </div>
            </div>
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
</div>
@endsection