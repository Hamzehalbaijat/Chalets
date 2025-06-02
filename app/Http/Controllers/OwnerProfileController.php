<?php

namespace App\Http\Controllers;

use App\Models\OwnerProfile; // تأكد من أن هذا الموديل موجود
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Chalet;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;


class OwnerProfileController extends Controller
{
    /**
     
     */
//     public function index()
// {
//     $owner = auth()->user(); // جلب المستخدم الحالي (الـ owner)

//     if ($owner->role !== 'Owner') {
//         return redirect()->route('home')->with('error', 'Unauthorized');
//     }

//     $chalets = $owner->chalets; // جلب جميع الشاليهات الخاصة بالـ owner

//     return view('Owner.Owner', compact('chalets'));
// }
public function index()
{
    // Get the authenticated user
    $owner = User::where('role', 'owner')->where('id', auth()->id())->first();

    // Check if no owner exists for the authenticated user
    if (!$owner) {
        return "No Owner user found in the database or you are not authorized to access this page.";
    }

    // Retrieve the chalets associated with the authenticated owner
    $chalets = $owner->chalets;

    // Check if the owner has no chalets
    if ($chalets->isEmpty()) {
        return "No chalets found for this owner.";
    }

    // Return view with chalets
    return view('owner.owner', compact('chalets'));
}


    /**
    
     */
    public function create()
    {
        return view('owner.create'); 
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_day' => 'required|numeric',
            'discount' => 'nullable|numeric|min:0|max:100',
            'status' => 'required|in:available,not available',
            'bedrooms' => 'required|integer|min:1',
            'bathrooms' => 'required|integer|min:1',
            'wifi' => 'sometimes|boolean',
            'pool' => 'sometimes|boolean',
            'air_conditioners' => 'sometimes|integer|min:0',
            'parking_spaces' => 'sometimes|integer|min:0',
            'area' => 'nullable|integer|min:0',
            'barbecue' => 'sometimes|boolean',
            'view' => 'required|in:sea,mountain,city,none',
            'kitchen' => 'sometimes|boolean',
            'kids_play_area' => 'sometimes|boolean',
            'pets_allowed' => 'sometimes|boolean',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $chalet = Chalet::create(array_merge(
            $request->except('images'),
            ['owner_id' => auth()->id() ?? 1]
        ));
    
        // حفظ الصور في جدول chalet_images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName=time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('storage'),$imageName);
                Image::create([
                    'chalet_id' => $chalet->id,
                    'image' => $imageName,
                ]);
            }
        }
    
        return redirect()->route('Owner.index')->with('success', 'Chalet added successfully!');
    }
    
    public function show($id)
    {
        $chalet = Chalet::find($id); // التأكد أن العقار يخص المستخدم
        return view('owner.show', compact('chalet'));
    }

    // عرض نموذج تعديل العقار
    public function edit($id)
    {
      $chalet =Chalet::find($id);
      return view('owner.edit', compact('chalet'));
    }
    
        
    
    
   

    public function update(Request $request, $id)
    {
        $chalet = Chalet::find($id);
    
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_day' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'status' => 'required|in:available,not available',
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
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        // تحديث البيانات
        $chalet->update([
            'name' => $request->name,
            'address' => $request->address,
            'description' => $request->description,
            'price_per_day' => $request->price_per_day,
            'discount' => $request->discount,
            'status' => $request->status,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'wifi' => $request->wifi ?? 0,
            'pool' => $request->pool ?? 0,
            'air_conditioners' => $request->air_conditioners,
            'parking_spaces' => $request->parking_spaces,
            'area' => $request->area,
            'barbecue' => $request->barbecue ?? 0,
            'view' => $request->view,
            'kitchen' => $request->kitchen ?? 0,
            'kids_play_area' => $request->kids_play_area ?? 0,
            'pets_allowed' => $request->pets_allowed ?? 0,
        ]);
    
        // تحديث الصور إذا تم رفع صور جديدة
        if ($request->hasFile('images')) {
            // حذف الصور القديمة
            foreach ($chalet->images as $oldImage) {
                Storage::disk('public')->delete($oldImage->image);
                $oldImage->delete();
            }
    
            // حفظ الصور الجديدة
            foreach ($request->file('images') as $image) {
                $path = $image->store('chalets', 'public');
                $chalet->images()->create(['image' => $path]);
            }
        }
    
        return redirect()->route('Owner.index')->with('success', 'Chalet updated successfully!');
    }
    

public function destroy($id)
{
    $chalet = Chalet::find($id);

    // حذف الصور المرتبطة
    foreach ($chalet->images as $image) {
        Storage::delete('public/' . $image->image);
        $image->delete();
    }

    $chalet->delete();

    return redirect()->route('Owner.index')->with('success', 'Property deleted successfully!');
}

public function showChaletBooking($chalet_id)
{
    $chalet = Chalet::with('users')->findOrFail($chalet_id);

    return view('Owner.owner', compact('chalet'));
}

}  


