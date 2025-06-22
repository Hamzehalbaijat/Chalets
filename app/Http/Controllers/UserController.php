<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Chalet;
use App\Models\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function showhome()
    {
        $chalets = Chalet::with(['images', 'reviews'])  // on home page & random chalets
            ->withAvg('reviews', 'rate')
            ->inRandomOrder()
            ->limit(3)
            ->get();
    
        $discountedChalets = Chalet::with(['images', 'reviews'])  // for discount in home page
            ->withAvg('reviews', 'rate')
            ->where('discount', '>', 0)
            ->orderByDesc('reviews_avg_rate')
            ->limit(3)
            ->get();
    
        return view('user.index', compact('chalets', 'discountedChalets'));
    }
    
    public function showAbout()
    {
        return view('user.index'); // Return the same home page, but scroll to 'about' section
    }
    
    public function showServices()
    {
        return view('user.index'); // Return the same home page, but scroll to 'services' section
    }
    
    public function showDiscountedChalets()
    {
        return view('user.index'); // Return the same home page, but scroll to 'discounted chalets' section
    }
    
    public function showChalets()
    {
        return view('user.index'); // Return the same home page, but scroll to 'chalets' section
    }
    
    

 
    //---------------------------------------------------------------------------------------------
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in.');
        }
        $bookings = Booking::where('user_id', $user->id)->with('chalet')->get();
        return view('user.profile', compact('user', 'bookings'));
    }

    //---------------------------------------------------------------------------------------------
    public function update(Request $request, User $user)
    {
        if (Auth::id() !== $user->id) {
            return redirect()->back()->with('error', 'Unauthorized action');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        return redirect()->route('profile_user.index')->with('success', 'Profile updated successfully.');
    }

    //------------------------------------------------------------------------------------------------------------------------------
    //--------------------------------------- For booking in profile ---------------------------------------------------------------
    public function cancelBooking($id)
    {
        $bookings = Booking::find($id);

        if ($bookings && $bookings->user_id === Auth::id()) {
            $bookings->delete();
            return redirect()->back()->with('success', 'Reservation canceled successfully');
        }

        return redirect()->back()->with('error', 'Reservation not found or you do not have permission to cancel it');
    }


    //--------------------------------------------------------------------------------------------------------------------------------------
}
