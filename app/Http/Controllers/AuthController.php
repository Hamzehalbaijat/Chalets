<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.login_reg');
    }

    public function showLoginForm()
    {
        return view('auth.login_reg');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            session([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'user_role' => $user->role,
            ]);

            return match ($user->role) {
                'admin' => redirect()->route('admin.users.index')->with('success', 'Welcome, Admin!'),
                'owner' => redirect()->route('Owner.dashboard')->with('success', 'Welcome, Owner!'),
                default => redirect()->route('user.home')->with('success', 'Welcome, User!'),
            };
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    // --------------------------
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        Auth::login($user);

        session([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_role' => $user->role,
        ]);

        return redirect()->route('login');
        }
    // --------------------
    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('login')->with('message', 'You have been logged out successfully!');
    }
}