<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserRegistered;

class RegisterController extends Controller
{
    public function show()
    {
        return view('register');
    }
    
    public function checkUsername(Request $request)
    {
        $exists = User::where('username', $request->username)->exists();
        return response()->json(['exists' => $exists]);
    }
    
    public function checkEmail(Request $request)
    {
        $exists = User::where('email', $request->email)->exists();
        return response()->json(['exists' => $exists]);
    }
    
    public function register(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:100',
            'username' => 'required|string|min:3|max:50|unique:users',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|min:8|regex:/[0-9]/|regex:/[\W_]/|confirmed',
            'phone' => 'required|regex:/^[0-9]{10,}$/',
            'whatsapp_number' => 'nullable|string|regex:/^\+[1-9]\d{7,14}$/',
            'address' => 'required|string',
            'user_image' => 'required|image|max:2048',
        ]);
        
        $userImagePath = $request->file('user_image')->store('uploads', 'public');
        $userImagePath = 'storage/uploads/' . basename($userImagePath);
        
        $user = User::create([
            'full_name' => $validated['full_name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'],
            'whatsapp_number' => $validated['whatsapp_number'],
            'address' => $validated['address'],
            'user_image' => $userImagePath,
        ]);
        // ini_set('max_execution_time', 120);
        // Mail::to('20220271@stud.fci-cu.edu.eg')->send(new NewUserRegistered($user->username)); 
        if ($request->input('ajax')) {
            return response()->json([
                'success' => true,
                'redirect' => route('welcome', ['username' => $user->username])
            ]);
        }
        
        return redirect()->route('welcome', ['username' => $user->username]);
    }
    
    public function welcome($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return view('welcome', compact('user'));
    }
}