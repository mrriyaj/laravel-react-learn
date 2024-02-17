<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check if the user is authorized to view products
        if (Gate::denies('view_any_product')) {
            abort(403, 'Unauthorized access!');
        }

        return Inertia::render('Products/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check if the user is authorized to create products
        if (Gate::denies('create_product')) {
            abort(403, 'Unauthorized access!');
        }

        return Inertia::render('Products/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check if the user is authorized to store a product
        if (Gate::denies('create_product')) {
            abort(403, 'Unauthorized access!');
        }

        // Logic for storing a product

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // Check if the user is authorized to view this product
        if (Gate::denies('view_product', $product)) {
            abort(403, 'Unauthorized access!');
        }

        return Inertia::render('Products/Show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // Check if the user is authorized to edit this product
        if (Gate::denies('update_product', $product)) {
            abort(403, 'Unauthorized access!');
        }

        return Inertia::render('Products/Edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Check if the user is authorized to update this product
        if (Gate::denies('update_product', $product)) {
            abort(403, 'Unauthorized access!');
        }

        // Logic for updating a product

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Check if the user is authorized to delete this product
        if (Gate::denies('delete_product', $product)) {
            abort(403, 'Unauthorized access!');
        }

        // Logic for deleting a product

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
