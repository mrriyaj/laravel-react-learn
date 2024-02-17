<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check if the user is authorized to view categories
        if (Gate::denies('view_any_category')) {
            abort(403, 'Unauthorized access!');
        }

        return Inertia::render('Categories/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check if the user is authorized to create categories
        if (Gate::denies('create_category')) {
            abort(403, 'Unauthorized access!');
        }

        return Inertia::render('Categories/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check if the user is authorized to store a category
        if (Gate::denies('create_category')) {
            abort(403, 'Unauthorized access!');
        }

        // Logic for storing a category

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        // Check if the user is authorized to view this category
        if (Gate::denies('view_category', $category)) {
            abort(403, 'Unauthorized access!');
        }

        return Inertia::render('Categories/Show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // Check if the user is authorized to edit this category
        if (Gate::denies('update_category', $category)) {
            abort(403, 'Unauthorized access!');
        }

        return Inertia::render('Categories/Edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Check if the user is authorized to update this category
        if (Gate::denies('update_category', $category)) {
            abort(403, 'Unauthorized access!');
        }

        // Logic for updating a category

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Check if the user is authorized to delete this category
        if (Gate::denies('delete_category', $category)) {
            abort(403, 'Unauthorized access!');
        }

        // Logic for deleting a category

        return response()->json(['message' => 'Category deleted successfully']);
    }
}
