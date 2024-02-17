<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check if the user is authorized to view brands
        if (Gate::denies('view_any_brand')) {
            abort(403, 'Unauthorized access!');
        }

        return Inertia::render('Brands/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check if the user is authorized to create brands
        if (Gate::denies('create_brand')) {
            abort(403, 'Unauthorized access!');
        }

        return Inertia::render('Brands/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check if the user is authorized to store a brand
        if (Gate::denies('create_brand')) {
            abort(403, 'Unauthorized access!');
        }

        // Logic for storing a brand

        return redirect()->route('brands.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        // Check if the user is authorized to view this brand
        if (Gate::denies('view_brand', $brand)) {
            abort(403, 'Unauthorized access!');
        }

        return Inertia::render('Brands/Show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        // Check if the user is authorized to edit this brand
        if (Gate::denies('update_brand', $brand)) {
            abort(403, 'Unauthorized access!');
        }

        return Inertia::render('Brands/Edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        // Check if the user is authorized to update this brand
        if (Gate::denies('update_brand', $brand)) {
            abort(403, 'Unauthorized access!');
        }

        // Logic for updating a brand

        return redirect()->route('brands.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        // Check if the user is authorized to delete this brand
        if (Gate::denies('delete_brand', $brand)) {
            abort(403, 'Unauthorized access!');
        }

        // Logic for deleting a brand

        return response()->json(['message' => 'Brand deleted successfully']);
    }
}
