<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chalet;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ChaletController extends Controller
{
    public function index(Request $request)
    {
        $query = Chalet::with(['owner', 'images']);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        if ($request->filled('max_price')) {
            $query->where('price_per_day', '<=', $request->max_price);
        }

        $validLocations = ['Amman', 'Zarqa', 'Irbid', 'Ajloun', 'Jerash', 'Mafraq', 
                          'Balqa', 'Madaba', 'Karak', 'Tafilah', 'Maan', 'Aqaba'];
        if ($request->filled('location') && in_array($request->location, $validLocations)) {
            $query->where('address', $request->location);
        }

        $chalets = $query->latest()->paginate(10);

        return view('admin.chalets.index', compact('chalets'));
    }

    public function toggleStatus($id)
    {
        DB::beginTransaction();
        try {
            $chalet = Chalet::findOrFail($id);
            $newStatus = $chalet->status == 'available' ? 'not available' : 'available';
            $chalet->update(['status' => $newStatus]);
            
            DB::commit();
            return redirect()->back()
                   ->with('success', "Chalet status changed to {$newStatus} successfully.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                   ->with('error', 'Status update failed: '.$e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            
            $chalet = Chalet::withTrashed()->findOrFail($id);
            
            if ($chalet->trashed()) {
                $chalet->forceDelete();
                $message = 'Chalet permanently deleted successfully.';
            } else {
                $chalet->delete();
                $message = 'Chalet moved to trash successfully.';
            }
            
            DB::commit();
            
            return redirect()->route('admin.chalets.index')
                   ->with('success', $message);
                   
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                   ->with('error', 'Delete failed: '.$e->getMessage());
        }
    }
    public function create()
    {
        $owners = User::where('role', 'lessor')->get();
        return view('admin.chalets.create', compact('owners'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'owner_id' => 'required|exists:users,id',
            'price_per_day' => 'required|numeric|min:0',
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
            'bedrooms' => 'required|integer|min:1',
            'bathrooms' => 'required|integer|min:1',
            'wifi' => 'boolean',
            'pool' => 'boolean',
            'air_conditioners' => 'integer|min:0',
            'parking_spaces' => 'integer|min:0',
            'area' => 'nullable|integer|min:0',
            'barbecue' => 'boolean',
            'view' => 'required|in:sea,mountain,city,none',
            'kitchen' => 'boolean',
            'kids_play_area' => 'boolean',
            'pets_allowed' => 'boolean',
        ]);

        DB::beginTransaction();
        try {
            $validated['status'] = 'available';
            Chalet::create($validated);
            
            DB::commit();
            return redirect()->route('admin.chalets.index')
                   ->with('success', 'Chalet created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Creation failed: '.$e->getMessage())
                   ->withInput();
        }
    }

    public function show(Chalet $chalet)
    {
        return view('admin.chalets.show', compact('chalet'));
    }

    public function edit(Chalet $chalet)
    {
        $owners = User::where('role', 'lessor')->get();
        return view('admin.chalets.edit', compact('chalet', 'owners'));
    }
    public function update(Request $request, $id)
    {
        $chalet = Chalet::findOrFail($id);
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price_per_day' => 'required|numeric|min:0',
            'address' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $chalet->name = $validatedData['name'];
            $chalet->price_per_day = $validatedData['price_per_day'];
            $chalet->address = $validatedData['address'];
            
            $saved = $chalet->save();
            
            if (!$saved) {
                throw new \Exception('Failed to save changes to database');
            }

            DB::commit();
            
            return redirect()->route('admin.chalets.index')
                   ->with('success', 'Chalet updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()
                   ->with('error', 'Failed to update chalet: ' . $e->getMessage())
                   ->withInput();
        }
    }
}