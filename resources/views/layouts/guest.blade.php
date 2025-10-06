<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'GymIn') }} - Fitness Platform</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="bg-gradient-to-br from-red-600 via-black to-red-800 min-h-screen">
        <div class="font-sans text-gray-900 antialiased min-h-screen flex flex-col justify-center items-center px-6 py-12">
            <!-- Gym-themed background overlay -->
            <div class="absolute inset-0 bg-black opacity-50"></div>
            
            <!-- Navigation back to home -->
            <div class="relative z-10 w-full max-w-md mb-6">
                <a href="{{ route('welcome') }}" class="text-white hover:text-red-300 flex items-center transition duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to GymIn
                </a>
            </div>
            
            <div class="relative z-10 w-full max-w-md">
                {{ $slot }}
            </div>
        </div>

        @livewireScripts
    </body>
</html>
