<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Chalet;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    
     
    public function index(Request $request)
    {
        $query = Review::with(['user', 'chalet']);

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
    
        if ($request->filled('chalet_id')) {
            $query->where('chalet_id', $request->chalet_id);
        }
    
        if ($request->filled('rate')) {
            $query->where('rate', $request->rate);
        }

        $reviews = $query->paginate(10);
        $users = User::all();
        $chalets = Chalet::all();


        return view('admin.reviews.index', compact('reviews', 'users', 'chalets'));
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return redirect()->route('admin.reviews.index')->with('success', 'Review deleted successfully.');
    }
}