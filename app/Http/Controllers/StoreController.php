<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Category;
use App\Models\Events;
use App\Models\Networks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::with(['categories', 'events', 'currentNetwork', 'availableNetwork'])
                       ->orderBy('sort_order')
                       ->paginate(10);

        return view('admin.stores.index', compact('stores'));
    }

public function create()
{
    $categories = Category::pluck('category_name', 'id');
    $events     = Events::pluck('event_name', 'id');
    $networks   = Networks::pluck('name', 'id');

    $store = new Store();
    // create form ke liye empty relations taake Blade me ->categories / ->events safe rahen
    $store->setRelation('categories', collect([]));
    $store->setRelation('events', collect([]));

    return view('admin.stores.create', compact('categories', 'events', 'networks', 'store'));
}
    public function store(Request $request)
    {
    $validated = $request->validate([
            'store_name'        => 'required|string|max:255',
            'seo_url'           => 'required|string|unique:stores,seo_url',
            'facebook_url'      => 'nullable|url',
            'twitter_url'       => 'nullable|url',
            'instagram_url'     => 'nullable|url',
            'youtube_url'       => 'nullable|url',
            'current_network'   => 'nullable|exists:networks,id',
            'available_network' => 'nullable|exists:networks,id',
            'categories'        => 'nullable|array',
            'categories.*'      => 'exists:categories,id',
            'events'            => 'nullable|array',
            'events.*'          => 'exists:events,id',
            'faqs'              => 'nullable|string',
        ]);

    // Log incoming faqs payload for debugging — will appear in storage/logs/laravel.log
    Log::info('StoreController@store incoming faqs', ['faqs' => $request->input('faqs')]);

    // fix: exclude the actual input names (categories, events)
    $data = $request->except(['categories', 'events']);

        // Store Logo Upload
        if ($request->hasFile('store_logo')) {
            $data['store_logo'] = $request->file('store_logo')->store('stores', 'public');
        }

        // Cover Image Upload
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('stores', 'public');
        }

        // sort_order set karna (last + 1)
        $last = Store::max('sort_order') ?? 0;
        $data['sort_order'] = $last + 1;

        $store = Store::create($data);

        // ✅ Attach categories & events to pivot
        $store->categories()->sync($request->categories ?? []);
        $store->events()->sync($request->events ?? []);

        return redirect()->route('admin.stores.index')->with('success', 'Store created successfully!');
    }


public function edit(Store $store)
{
    $categories = Category::pluck('category_name', 'id');
    $events     = Events::pluck('event_name', 'id');
    $networks   = Networks::pluck('name', 'id');

    $store->load(['categories','events']); // edit pe pre-load

    return view('admin.stores.edit', compact('store', 'categories', 'events', 'networks'));
}

    public function update(Request $request, Store $store)
    {
        $validated = $request->validate([
            'store_name'        => 'required|string|max:255',
            'seo_url'           => 'required|string|unique:stores,seo_url,' . $store->id,
            'facebook_url'      => 'nullable|url',
            'twitter_url'       => 'nullable|url',
            'instagram_url'     => 'nullable|url',
            'youtube_url'       => 'nullable|url',
            'current_network'   => 'nullable|exists:networks,id',
            'available_network' => 'nullable|exists:networks,id',
            'categories'        => 'nullable|array',
            'categories.*'      => 'exists:categories,id',
            'events'            => 'nullable|array',
            'events.*'          => 'exists:events,id',
            'faqs'              => 'nullable|string',
        ]);

    $data = $request->except(['categories', 'events']);

        // Store Logo Update
        if ($request->hasFile('store_logo')) {
            if ($store->store_logo && Storage::disk('public')->exists($store->store_logo)) {
                Storage::disk('public')->delete($store->store_logo);
            }
            $data['store_logo'] = $request->file('store_logo')->store('stores', 'public');
        }

        // Cover Image Update
        if ($request->hasFile('cover_image')) {
            if ($store->cover_image && Storage::disk('public')->exists($store->cover_image)) {
                Storage::disk('public')->delete($store->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('stores', 'public');
        }

        $store->update($data);

        // ✅ Sync categories & events
        $store->categories()->sync($request->categories ?? []);
        $store->events()->sync($request->events ?? []);

        return redirect()->route('admin.stores.index')->with('success', 'Store updated successfully!');
    }

    public function destroy(Store $store)
    {
        if ($store->store_logo && Storage::disk('public')->exists($store->store_logo)) {
            Storage::disk('public')->delete($store->store_logo);
        }
        if ($store->cover_image && Storage::disk('public')->exists($store->cover_image)) {
            Storage::disk('public')->delete($store->cover_image);
        }

        $store->categories()->detach();
        $store->events()->detach();
        $store->delete();

        return redirect()->route('admin.stores.index')->with('success', 'Store deleted successfully!');
    }

    // ✅ Bulk Delete
    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        if (!$ids || count($ids) === 0) {
            return back()->with('error', 'No stores selected.');
        }

        $stores = Store::whereIn('id', $ids)->get();

        foreach ($stores as $store) {
            if ($store->store_logo && Storage::disk('public')->exists($store->store_logo)) {
                Storage::disk('public')->delete($store->store_logo);
            }
            if ($store->cover_image && Storage::disk('public')->exists($store->cover_image)) {
                Storage::disk('public')->delete($store->cover_image);
            }
            $store->categories()->detach();
            $store->events()->detach();
            $store->delete();
        }

        return back()->with('success', 'Selected stores deleted successfully.');
    }

    // ✅ Reorder
    public function reorder(Request $request)
    {
        $request->validate([
            'order'              => 'required|array',
            'order.*.id'         => 'required|integer|exists:stores,id',
            'order.*.sort_order' => 'required|integer|min:1',
        ]);

        foreach ($request->order as $item) {
            Store::where('id', $item['id'])->update(['sort_order' => $item['sort_order']]);
        }

        return response()->json(['status' => 'success']);
    }
}
