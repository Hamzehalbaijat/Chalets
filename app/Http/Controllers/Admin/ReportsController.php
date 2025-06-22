<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Chalet;
use App\Models\Contact;
use App\Models\Review;
use App\Models\Rating;
use Illuminate\Support\Facades\DB; 


class ReportsController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalLessors = User::where('role', 'owner')->count();
        $totalRenters = User::where('role', 'user')->count();

           $totalRevenue = Booking::sum('total_price');

        $topChalets = Booking::select('chalets.name', DB::raw('COUNT(bookings.id) as total_bookings'))
            ->join('chalets', 'bookings.chalet_id', '=', 'chalets.id')
            ->groupBy('chalets.name')
            ->orderByDesc('total_bookings')
            ->limit(5)
            ->get();

        return view('admin.reports.index', compact('totalUsers', 'totalLessors', 'totalRenters',  'totalRevenue','topChalets'));
    }
}