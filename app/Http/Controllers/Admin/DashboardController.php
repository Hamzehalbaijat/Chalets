<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Chalet;
use App\Models\Booking;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        $totalChalets = Chalet::count();

        $totalBookings = Booking::count();

        $totalRevenue = Booking::sum('total_price');

        $recentBookings = Booking::with(['user', 'chalet'])->latest()->take(5)->get();

        $notifications = Contact::latest()->take(5)->get();

        $renterCount = User::where('role', 'user')->count();
        $lessorCount = User::where('role', 'owner')->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalChalets',
            'totalBookings',
            'totalRevenue',
            'recentBookings',
            'notifications',
            'renterCount',
            'lessorCount'
        ));
    }
    }

