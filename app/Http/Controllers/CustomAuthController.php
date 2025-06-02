<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
class CustomAuthController extends Controller
{
   
    public function showRegisterForm(){
        return view('auth.login_reg');
    }

    
    public function showLoginForm(){
        return view('auth.login_reg'); 
    }

    public function login(Request $request) {
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
    
           
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashbord')->with('success', 'Welcome, Admin!');
                case 'owner':
                    return redirect()->route('owner.dashbord')->with('success', 'Welcome, Owner!');
                case 'user':
                    return redirect()->route('user.index')->with('success', 'Welcome, User!');
                default:
                    return redirect()->route('login')->withErrors(['email' => 'Invalid role']);
            }
        } 
    
        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }
    
    // --------------------------
    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users', 
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,owner', 
        ]);
    
      
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            'role' => $request->role, 
        ]);
    
       
        Auth::login($user);
    
        
        session([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_role' => $user->role,
        ]);
    
        
    }  
    // --------------------
    public function logout(){
        Auth::logout(); 
        session()->flush(); 
        return redirect()->route('login')->with('message', 'You have been logged out successfully!');
    }
}    
    