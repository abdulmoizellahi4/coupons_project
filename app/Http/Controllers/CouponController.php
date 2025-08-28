<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Events;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::orderBy('sort_order')->get();
        return view('coupons.index', compact('coupons'));
    }
    
   public function create()
{
    $events = Events::all();
    return view('coupons.create', compact('events'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'coupon_title'   => 'required|string|max:255',
        'brand_store'    => 'required|string|max:255',
        'coupon_code'    => 'nullable|string|max:255',
        'event_id'       => 'nullable|exists:events,id', // foreign key validation
        'submitted_by'   => 'nullable|string|max:255',
        'affiliate_url'  => 'nullable|string|max:255',
        'date_available' => 'nullable|date',
        'date_expiry'    => 'nullable|date',
        'description'    => 'nullable|string',
        'terms'          => 'nullable|string',
        'cover_logo'     => 'nullable|image|max:2048',
    ]);

    $validated['exclusive']   = $request->boolean('exclusive');
    $validated['featured']    = $request->boolean('featured');
    $validated['recommended'] = $request->boolean('recommended');
    $validated['verified']    = $request->boolean('verified');
    $validated['status']      = $request->boolean('status');
    $validated['expiry_soon'] = $request->boolean('expiry_soon');

    if ($request->hasFile('cover_logo')) {
        $validated['cover_logo'] = $request->file('cover_logo')->store('uploads', 'public');
    }

    Coupon::create($validated);

    return redirect()->route('coupons.index')->with('success', 'Coupon Created Successfully');
}

    public function edit(Coupon $coupon)
    {
        $events = Events::all();
        return view('coupons.edit', compact('coupon', 'events'));
    }

public function update(Request $request, $id)
{
    $coupon = Coupon::findOrFail($id);

    $validated = $request->validate([
        'coupon_title'   => 'required|string|max:255',
        'brand_store'    => 'required|string|max:255',
        'coupon_code'    => 'nullable|string|max:255',
        'event_id'       => 'nullable|exists:events,id', // foreign key validation
        'submitted_by'   => 'nullable|string|max:255',
        'affiliate_url'  => 'nullable|string|max:255',
        'date_available' => 'nullable|date',
        'date_expiry'    => 'nullable|date',
        'description'    => 'nullable|string',
        'terms'          => 'nullable|string',
        'cover_logo'     => 'nullable|image|max:2048',
    ]);

    $validated['exclusive']   = $request->boolean('exclusive');
    $validated['featured']    = $request->boolean('featured');
    $validated['recommended'] = $request->boolean('recommended');
    $validated['verified']    = $request->boolean('verified');
    $validated['status']      = $request->boolean('status');
    $validated['expiry_soon'] = $request->boolean('expiry_soon');

    if ($request->hasFile('cover_logo')) {
        if ($coupon->cover_logo && Storage::disk('public')->exists($coupon->cover_logo)) {
            Storage::disk('public')->delete($coupon->cover_logo);
        }
        $validated['cover_logo'] = $request->file('cover_logo')->store('uploads', 'public');
    }

    $coupon->update($validated);

    return redirect()->route('coupons.index')->with('success', 'Coupon Updated Successfully');
}

    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);

        if ($coupon->cover_logo && Storage::disk('public')->exists($coupon->cover_logo)) {
            Storage::disk('public')->delete($coupon->cover_logo);
        }

        $coupon->delete();

        return redirect()->route('coupons.index')->with('success', 'Coupon Deleted Successfully');
    }

        public function reorder(Request $request)
    {
        foreach ($request->order as $item) {
            Coupon::where('id', $item['id'])->update(['sort_order' => $item['sort_order']]);
        }
        return response()->json(['status' => 'success']);
    }
    
    public function bulkDelete(Request $request)
{
    $ids = $request->ids;
    if (!$ids) {
        return redirect()->back()->with('error', 'No records selected');
    }

    $coupons = Coupon::whereIn('id', $ids)->get();
    foreach ($coupons as $coupon) {
        if ($coupon->cover_logo && Storage::disk('public')->exists($coupon->cover_logo)) {
            Storage::disk('public')->delete($coupon->cover_logo);
        }
        $coupon->delete();
    }

    return redirect()->back()->with('success', 'Selected coupons deleted successfully');
}


}
