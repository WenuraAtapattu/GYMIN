<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $category = $request->get('category');
        $search = $request->get('search');
        
        $products = Product::active()
            ->when($category, function ($query, $category) {
                return $query->category($category);
            })
            ->when($search, function ($query, $search) {
                return $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%")
                      ->orWhere('brand', 'like', "%{$search}%")
                      ->orWhere('specifications', 'like', "%{$search}%");
                });
            })
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $categories = [
            'cardio' => 'Cardio Equipment',
            'strength' => 'Strength Training',
            'accessories' => 'Accessories',
            'supplements' => 'Supplements'
        ];

        return view('products.index', compact('products', 'categories', 'category', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $relatedProducts = Product::active()
            ->where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }

    /**
     * Display products by category.
     */
    public function category($category)
    {
        $categoryNames = [
            'cardio' => 'Cardio Equipment',
            'strength' => 'Strength Training',
            'weights' => 'Weights & Dumbbells',
            'accessories' => 'Accessories & Gear',
            'supplements' => 'Supplements & Nutrition'
        ];

        $categoryName = $categoryNames[$category] ?? 'Products';
        
        $products = Product::active()
            ->category($category)
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('products.category', compact('products', 'category', 'categoryName'));
    }

    /**
     * Get search suggestions for autocomplete.
     */
    public function searchSuggestions(Request $request)
    {
        $query = $request->get('q');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $suggestions = Product::active()
            ->where(function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('brand', 'like', "%{$query}%");
            })
            ->limit(5)
            ->get(['name', 'brand'])
            ->map(function($product) {
                return [
                    'name' => $product->name,
                    'brand' => $product->brand,
                    'suggestion' => $product->name
                ];
            })
            ->unique('suggestion')
            ->values();

        return response()->json($suggestions);
    }
}
