<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $packages = Package::active()->paginate(12);
        return view('packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('packages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration_months' => 'required|integer|min:1',
            'features' => 'required|array',
            'image_url' => 'nullable|url',
            'category' => 'required|in:basic,premium,elite,trainer',
            'discount_percentage' => 'nullable|numeric|min:0|max:100'
        ]);

        Package::create($validated);

        return redirect()->route('packages.index')
                        ->with('success', 'Package created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package): View
    {
        return view('packages.show', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package): View
    {
        return view('packages.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Package $package): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration_months' => 'required|integer|min:1',
            'features' => 'required|array',
            'image_url' => 'nullable|url',
            'category' => 'required|in:basic,premium,elite,trainer',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'is_active' => 'boolean'
        ]);

        $package->update($validated);

        return redirect()->route('packages.index')
                        ->with('success', 'Package updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package): RedirectResponse
    {
        $package->delete();

        return redirect()->route('packages.index')
                        ->with('success', 'Package deleted successfully!');
    }
}
