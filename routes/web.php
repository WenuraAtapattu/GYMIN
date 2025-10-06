<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Additional pages
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/services', function () {
    return view('services');
})->name('services');

// Product routes (public)
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/category/{category}', [ProductController::class, 'category'])->name('products.category');
Route::get('/products/search/suggestions', [ProductController::class, 'searchSuggestions'])->name('products.search.suggestions');

// Legacy package routes (keeping for backward compatibility)
Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
Route::get('/packages/{package}', [PackageController::class, 'show'])->name('packages.show');

// Test page route
Route::get('/admin-test', function () {
    return view('admin-test');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        try {
            // Check if user is admin
            $user = Auth::user();
            if ($user && $user->is_admin) {
                return redirect()->route('admin.dashboard');
            }
            // Redirect non-admin users to user dashboard
            return redirect()->route('user.dashboard');
        } catch (\Exception $e) {
            Log::error('Dashboard error: ' . $e->getMessage());
            return view('dashboard');
        }
    })->name('dashboard');
    
    // User Dashboard Route
    Route::get('/user/dashboard', \App\Livewire\UserDashboard::class)->name('user.dashboard');
    
    // User Orders
    Route::get('/user/orders', \App\Livewire\User\Orders::class)->name('user.orders');
    
    // Admin routes
    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', \App\Livewire\AdminDashboard::class)->name('admin.dashboard');
    });
    
    // Protected package routes
    Route::resource('packages', PackageController::class)->except(['index', 'show']);
    
    // Livewire component routes
    Route::get('/cart', function () {
        return view('cart');
    })->name('cart');
    
    Route::get('/workout-planner', function () {
        return view('workout-planner');
    })->name('workout.planner');
    
    Route::get('/diet-tracker', function () {
        return view('diet-tracker');
    })->name('diet.tracker');
    
    Route::get('/admin', function () {
        return view('admin');
    })->name('admin')->middleware('can:admin');
});
