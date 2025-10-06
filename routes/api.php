<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PackageApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\AuthController;

// Authentication routes for Flutter
Route::prefix('v1/auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', [AuthController::class, 'user']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::put('/profile', [AuthController::class, 'updateProfile']);
    });
});

// Public API routes for Flutter
Route::prefix('v1')->group(function () {
    // Product endpoints - specific routes first
    Route::get('/products/search', [ProductApiController::class, 'search']);
    Route::get('/products/category/{category}', [ProductApiController::class, 'byCategory']);
    Route::get('/products/{id}/images', [ProductApiController::class, 'images']);
    Route::get('/products/{id}', [ProductApiController::class, 'show']);
    Route::get('/products', [ProductApiController::class, 'index']);
    
    // Category endpoints
    Route::get('/categories', [ProductApiController::class, 'categories']);
    
    // Special collections
    Route::get('/featured-products', [ProductApiController::class, 'featured']);
    Route::get('/latest-products', [ProductApiController::class, 'latest']);
    Route::get('/sale-products', [ProductApiController::class, 'onSale']);
});

// Legacy package routes
Route::get('/packages', [PackageApiController::class, 'index']);
Route::get('/packages/{package}', [PackageApiController::class, 'show']);

// Protected API routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    // Package management (admin only)
    Route::middleware('can:admin')->group(function () {
        Route::post('/packages', [PackageApiController::class, 'store']);
        Route::put('/packages/{package}', [PackageApiController::class, 'update']);
        Route::delete('/packages/{package}', [PackageApiController::class, 'destroy']);
    });
});
