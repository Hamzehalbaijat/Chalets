<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chalet;
class BookingController extends Controller
{

    public function createBooking(Request $request, $chaletId)
    {
        $validated = $request->validate([
            'start' => 'required|date|after_or_equal:today',
            'end' => 'required|date|after:start',
            'adults' => 'required|integer|min:1',
            'children' => 'required|integer|min:0',
        ]);

        $chalet = Chalet::findOrFail($chaletId);
        $user = auth()->user();

        $existingBooking = $chalet->bookings()
        ->where(function ($query) use ($validated) {
            $query->where('start', '<', $validated['end'])
                    ->where('end', '>', $validated['start']);
        })->exists();
    

        if ($existingBooking) {
            return redirect()->route('showingAllChalets')
                ->with('error', 'This chalet is already booked for the selected dates.');
        }

        $discount = $chalet->discount ?? 0;
        $days = (new \DateTime($validated['start']))->diff(new \DateTime($validated['end']))->days;
        $totalPrice = ($chalet->price_per_day * $days) * ((100 - $discount) / 100);
        

        session([
            'booking_data' => $validated,
            'chalet_id' => $chaletId,
            'total_price' => $totalPrice,
            'discount' => $chalet->discount ?? 0 
        ]);

        return redirect()->route('payment.page');
    }

//------------------------------------------------- for payment --------------------------------------------------------------
    public function showPaymentPage()
    {
        if (!session()->has('booking_data')) {
            return redirect()->route('showingAllChalets')->with('error', 'Invalid booking request.');
        }

        return view('user.payment', [
            'booking_data' => session('booking_data'),
            'total_price' => session('total_price'),
            'chalet_id' => session('chalet_id'),
            'discount' => session('discount')
        ]);
    }
//----------------------------------------------------------------------------------------------------------------------------
public function confirmPayment()
{
    if (!session()->has('booking_data')) {
        return redirect()->route('showingAllChalets')->with('error', 'Invalid payment request.');
    }

    if (!auth()->check()) {
        return redirect()->route('login')->with('error', 'You must be logged in to make a booking.');
    }

    $user = auth()->user();
    $chalet = Chalet::find(session('chalet_id'));

    if (!$chalet) {
        return redirect()->route('showingAllChalets')->with('error', 'Chalet not found.');
    }

    $booking = $user->bookings()->create([
        'chalet_id' => $chalet->id,
        'start' => session('booking_data.start'),
        'end' => session('booking_data.end'),
        'total_price' => session('total_price'),
    ]);

    session()->forget(['booking_data', 'chalet_id', 'total_price']);

    return redirect()->route('showingAllChalets')->with('success', 'Booking successfully completed!');
}

}