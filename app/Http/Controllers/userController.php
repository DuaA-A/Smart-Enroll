<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Optional: You already have a registration form via RegisterController
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Optional: You already handle registration via RegisterController
        $validated = $request->validate([
            'full_name' => 'required|string|max:100',
            'username' => 'required|string|min:3|max:50|unique:users',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|min:8|regex:/[0-9]/|regex:/[\W_]/|confirmed',
            'phone' => 'required|regex:/^[0-9]{10,}$/',
            'whatsapp_number' => 'nullable|regex:/^[0-9]{10,}$/',
            'address' => 'nullable|string',
            'user_image' => 'nullable|image|max:2048', 
        ]);

        if ($request->hasFile('user_image')) {
            $validated['user_image'] = $request->file('user_image')->store('uploads', 'public');
            $validated['user_image'] = 'assets/' . $validated['user_image'];
        }

        $validated['password'] = bcrypt($validated['password']);
        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:100',
            'username' => 'required|string|min:3|max:50|unique:users,username,' . $user->id,
            'email' => 'required|email|max:100|unique:users,email,' . $user->id,
            'phone' => 'required|regex:/^[0-9]{10,}$/',
            'whatsapp_number' => 'nullable|regex:/^\+[1-9]\d{7,14}$/',
            'address' => 'nullable|string',
            'user_image' => 'nullable|image|max:2048', // Max 2MB
        ]);

        if ($request->hasFile('user_image')) {
            // Delete old image if it exists
            if ($user->user_image) {
                Storage::disk('public')->delete(str_replace('assets/', '', $user->user_image));
            }
            $validated['user_image'] = $request->file('user_image')->store('uploads', 'public');
            $validated['user_image'] = 'assets/' . $validated['user_image'];
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Delete the user's image if it exists
        if ($user->user_image) {
            Storage::disk('public')->delete(str_replace('assets/', '', $user->user_image));
        }
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}