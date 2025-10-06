<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductApiController extends Controller
{
    /**
     * Get all products with pagination and filtering
     */
    public function index(Request $request): JsonResponse
    {
        $query = Product::query();

        // Search by name or description
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->has('category') && !empty($request->category)) {
            $query->where('category', $request->category);
        }

        // Filter by price range
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by availability
        if ($request->has('in_stock') && $request->in_stock === 'true') {
            $query->where('stock_quantity', '>', 0);
        }

        // Sort options
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        
        if (in_array($sortBy, ['name', 'price', 'created_at', 'stock_quantity'])) {
            $query->orderBy($sortBy, $sortOrder);
        }

        // Pagination
        $perPage = min($request->get('per_page', 15), 50); // Max 50 items per page
        $products = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Products retrieved successfully',
            'data' => [
                'products' => $products->items(),
                'pagination' => [
                    'current_page' => $products->currentPage(),
                    'last_page' => $products->lastPage(),
                    'per_page' => $products->perPage(),
                    'total' => $products->total(),
                    'has_more_pages' => $products->hasMorePages()
                ]
            ]
        ]);
    }

    /**
     * Get single product details
     */
    public function show($id): JsonResponse
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product retrieved successfully',
            'data' => $product
        ]);
    }

    /**
     * Get product categories
     */
    public function categories(): JsonResponse
    {
        $categories = Product::select('category')
                            ->distinct()
                            ->whereNotNull('category')
                            ->pluck('category')
                            ->filter()
                            ->values();

        return response()->json([
            'success' => true,
            'message' => 'Categories retrieved successfully',
            'data' => $categories
        ]);
    }

    /**
     * Get featured products
     */
    public function featured(): JsonResponse
    {
        $featuredProducts = Product::where('is_featured', true)
                                  ->orWhere('sale_price', '>', 0) // Products on sale
                                  ->orderBy('created_at', 'desc')
                                  ->take(10)
                                  ->get();

        return response()->json([
            'success' => true,
            'message' => 'Featured products retrieved successfully',
            'data' => $featuredProducts
        ]);
    }

    /**
     * Search products
     */
    public function search(Request $request): JsonResponse
    {
        $request->validate([
            'query' => 'required|string|min:2|max:100'
        ]);

        $searchQuery = $request->get('query');
        
        $products = Product::where(function($q) use ($searchQuery) {
            $q->where('name', 'LIKE', "%{$searchQuery}%")
              ->orWhere('description', 'LIKE', "%{$searchQuery}%")
              ->orWhere('category', 'LIKE', "%{$searchQuery}%");
        })
        ->orderBy('name')
        ->take(20)
        ->get();

        return response()->json([
            'success' => true,
            'message' => 'Search results retrieved successfully',
            'data' => [
                'query' => $searchQuery,
                'results_count' => $products->count(),
                'products' => $products
            ]
        ]);
    }

    /**
     * Get products by category
     */
    public function byCategory($category): JsonResponse
    {
        $products = Product::where('category', $category)
                          ->orderBy('name')
                          ->paginate(20);

        if ($products->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No products found in this category'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Products retrieved successfully',
            'data' => [
                'category' => $category,
                'products' => $products->items(),
                'pagination' => [
                    'current_page' => $products->currentPage(),
                    'last_page' => $products->lastPage(),
                    'per_page' => $products->perPage(),
                    'total' => $products->total(),
                    'has_more_pages' => $products->hasMorePages()
                ]
            ]
        ]);
    }

    /**
     * Get product images
     */
    public function images($id): JsonResponse
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $images = [];
        
        // Main image
        if ($product->main_image) {
            $images[] = [
                'type' => 'main',
                'url' => $product->main_image_url,
                'path' => $product->main_image
            ];
        }

        // Additional images
        if ($product->images && is_array($product->images)) {
            foreach ($product->images as $index => $image) {
                $images[] = [
                    'type' => 'additional',
                    'index' => $index,
                    'url' => asset('storage/' . $image),
                    'path' => $image
                ];
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Product images retrieved successfully',
            'data' => [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'images' => $images,
                'total_images' => count($images)
            ]
        ]);
    }

    /**
     * Get latest products
     */
    public function latest(): JsonResponse
    {
        $products = Product::orderBy('created_at', 'desc')
                          ->take(10)
                          ->get();

        return response()->json([
            'success' => true,
            'message' => 'Latest products retrieved successfully',
            'data' => $products
        ]);
    }

    /**
     * Get products on sale
     */
    public function onSale(): JsonResponse
    {
        $products = Product::whereNotNull('sale_price')
                          ->where('sale_price', '>', 0)
                          ->orderBy('created_at', 'desc')
                          ->get();

        return response()->json([
            'success' => true,
            'message' => 'Sale products retrieved successfully',
            'data' => $products
        ]);
    }
}
