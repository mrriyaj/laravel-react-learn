<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::denies('view_any_user')) {
            abort(403, 'Unauthorized access!');
        }

        // Customize your logic for displaying users based on the user's role

        return Inertia::render('admin/index');

        $loggedInUser = Auth::user();
        $users = User::query();

        if ($loggedInUser->user_type === 'superadmin') {
            $users->where('user_type', '!=', 'superadmin');
        } elseif ($loggedInUser->user_type === 'admin') {
            $users->whereNotIn('user_type', ['superadmin', 'admin']);
        }

        $users = $users->get();

        return Inertia::render('admin/index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::denies('create_user')) {
            abort(403, 'Unauthorized access!');
        }

        return Inertia::render('admin/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Gate::denies('create_user')) {
            abort(403, 'Unauthorized access!');
        }

        // Add your logic for storing a user
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'user_type' => 'required|in:superadmin,admin,shopowner,user',
        ]);

        User::create($validatedData);

        return redirect()->route('admin.index')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Gate::denies('view_user')) {
            abort(403, 'Unauthorized access!');
        }

        $user = User::findOrFail($id);

        return Inertia::render('admin/show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Gate::denies('update_user')) {
            abort(403, 'Unauthorized access!');
        }

        $user = User::findOrFail($id);

        return Inertia::render('admin/edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Gate::denies('update_user')) {
            abort(403, 'Unauthorized access!');
        }

        $user = User::findOrFail($id);

        // Add your logic for updating a user

        return redirect()->route('admin.index')->with('success', 'User updated successfully!');
    

        $user = User::findOrFail($id);
    
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|min:8', // Make the password field nullable
            'user_type' => 'required|in:superadmin,admin,shopowner,user',
        ]);
    
        // Check if a new password is provided
        if ($request->password) {
            // Update the validated data with the hashed password using bcrypt
            $validatedData['password'] = bcrypt($request->password);
        } else {
            // If no new password is provided, remove the 'password' key from the array
            unset($validatedData['password']);
        }
    
        $user->update($validatedData);
    
        return redirect()->route('admin.index')->with('success', 'User updated successfully!');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Gate::denies('delete_user')) {
            abort(403, 'Unauthorized access!');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);

        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'user deleted successfully']);
    }
}

