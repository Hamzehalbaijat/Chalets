<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chalet;
use App\Models\User;
use App\Models\Contact;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail; // Add this line
use App\Mail\ContactFormMail;

class StoreController extends Controller
{

    //---------------------------------------------------------------------------------------------------------------------
    public function showingAllChalets(Request $request)
    {

        $query = Chalet::with(['images', 'reviews', 'bookings'])
            ->withAvg('reviews', 'rate');

        if ($request->filled('location')) {
            $query->where('address', 'like', '%' . $request->location . '%');
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = Carbon::parse($request->start_date)->format('Y-m-d');
            $endDate = Carbon::parse($request->end_date)->format('Y-m-d');

            $query->whereDoesntHave('bookings', function ($q) use ($startDate, $endDate) {
                $q->where(function ($q) use ($startDate, $endDate) {
                    $q->where('start', '<=', $endDate)
                        ->where('end', '>=', $startDate);
                });
            });
        }

        if ($request->filled('min_price')) {
            $query->where('price_per_day', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price_per_day', '<=', $request->max_price);
        }

        $chalets = $query->paginate(12);

        return view('user.chalets', compact('chalets'));
    }
    //--------------------------------------------------------------------------------------------------------
    public function store(Request $request)
    {
        //
    }

    public function showDetails(Chalet $chalet)
    {
        $chalet->load(['reviews', 'images']);
        $bookings = Booking::where('chalet_id', $chalet->id)->get();

        $bookedDates = [];
        foreach ($bookings as $booking) {
            $period = Carbon::parse($booking->start)->daysUntil(Carbon::parse($booking->end));
            foreach ($period as $date) {
                $bookedDates[] = $date->format('Y-m-d');
            }
        }

        return view('user.show', compact('chalet', 'bookedDates'));
    }

    //----------------------------------------------------------------------------------------------------------
    public function edit(string $id)
    {
        //
    }
    //-------------------------------------------------------------------------------------------------------
    public function update(Request $request, string $id)
    {
    }
    //-----------------------------------------------------------------------------------------------------------
    public function addComment(Request $request)
    {

        $user = Auth::user() ?? User::first();
        $request->validate([
            'chalet_id' => 'required|exists:chalets,id',
            'comment' => 'required|string|max:255',
            'rate' => 'required|integer|min:1|max:5',
        ]);

        Review::create([
            'user_id' => $user->id,
            'chalet_id' => $request->chalet_id,
            'comment' => $request->comment,
            'rate' => $request->rate
        ]);

        return redirect()->back()->with('success', 'Comment added successfully!');
    }
    //---------------------------------------------------------------------------------------------------------------------
    //--------------------------------------------- for contact---------------------------------------------------------------
    public function contact()
    {
        return view('user.contact');
    }

   public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        // Store the contact message
        Contact::create($validated);

        // Send email
        Mail::to('albaijathamzeh@gmail.com')->send(new ContactFormMail($validated));

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
      
}


