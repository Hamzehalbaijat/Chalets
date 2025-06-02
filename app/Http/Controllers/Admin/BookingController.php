<?php

// app/Http/Controllers/Admin/BookingController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Chalet;
use App\Models\User;
use Illuminate\Http\Request;
class BookingController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        $chalets = Chalet::all();
    
        $bookings = Booking::query()
            ->when($request->filled('user_id'), function($query) use ($request) {
                $query->where('user_id', $request->user_id);
            })
            ->when($request->filled('chalet_id'), function($query) use ($request) {
                $query->where('chalet_id', $request->chalet_id);
            })
            ->with(['user', 'chalet'])
            ->latest()
            ->paginate(10)
            ->appends($request->query());
    
        return view('admin.bookings.index', compact('bookings', 'users', 'chalets'));
    }

    public function edit(Booking $booking)
{
   
}

public function update(Request $request, Booking $booking)
{
    $request->validate([
        'chalet_id' => 'required|exists:chalets,id',
        'user_id' => 'required|exists:users,id',
        'start' => 'required|date',
        'end' => 'required|date|after:start',
        'total_price' => 'required|numeric|min:0',
    ]);

    $booking->update($request->all());

    return redirect()->route('admin.bookings.index')
                    ->with('success', 'Booking updated successfully');
}
    
    public function destroy(Booking $booking)
    {
       
    }
    protected function sendBookingStatusNotification(Booking $booking)
    {
        $user = $booking->user;
        $status = $booking->status;
    
        $user->notify(new BookingStatusUpdated($status));
    }
    
}