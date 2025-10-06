@extends('layouts.app')

@section('title', 'Fitness Packages')

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
                            <a href="{{ route('packages.index') }}" class="text-red-200 px-3 py-2 rounded-md text-sm font-medium">Packages</a>
                            <a href="{{ route('about') }}" class="text-white hover:text-red-200 px-3 py-2 rounded-md text-sm font-medium">About</a>
                            <a href="{{ route('contact') }}" class="text-white hover:text-red-200 px-3 py-2 rounded-md text-sm font-medium">Contact</a>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-white text-red-600 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition duration-200">Dashboard</a>
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
                <h1 class="text-4xl font-extrabold text-white sm:text-5xl">Fitness Packages</h1>
                <p class="mt-4 text-xl text-red-100">Choose the perfect plan for your fitness journey</p>
            </div>
        </div>
    </div>

    <!-- Packages Content -->
    <div class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @livewire('package-list')
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
                        <li><a href="#" class="text-gray-300 hover:text-white transition duration-200">Fitness Packages</a></li>
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