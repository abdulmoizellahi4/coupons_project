<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Customer;
use App\Notifications\NewEventNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;

class EventsController extends Controller
{
    public function index()
    {
        // Coupons ki tarah sort_order par hi listing
        $events = Events::orderBy('sort_order')->get();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_name'          => 'required|string|max:255',
            'event_type'          => 'nullable|string|max:255',
            'date_available'      => 'nullable|date',
            'date_expiry'         => 'nullable|date',
            'seo_url'             => 'required|string|max:255|unique:events,seo_url',
            'meta_title'          => 'nullable|string|max:255',
            'meta_keywords'       => 'nullable|string|max:255',
            'meta_description'    => 'nullable|string',
            'event_short_content' => 'nullable|string',
            'detail_description'  => 'nullable|string',
            'front_image'         => 'nullable|image|max:2048',
            'button_icon'         => 'nullable|image|max:2048',
            'cover_image'         => 'nullable|image|max:2048',
            'no_coupon_cover'     => 'nullable|image|max:2048',
        ]);

        $validated['status'] = $request->boolean('status');
        $validated['show_footer'] = $request->boolean('show_footer');

        // Files upload
        foreach (['front_image', 'button_icon', 'cover_image', 'no_coupon_cover'] as $field) {
            if ($request->hasFile($field)) {
                $validated[$field] = $request->file($field)->store('uploads/events', 'public');
            }
        }

        // Last sort_order + 1 (empty table handle)
        $last = Events::max('sort_order') ?? 0;
        $validated['sort_order'] = $last + 1;

        $event = Events::create($validated);

        // Send email notifications to all subscribed customers
        $subscribedCustomers = Customer::subscribed()->get();
        if ($subscribedCustomers->count() > 0) {
            Notification::send($subscribedCustomers, new NewEventNotification($event));
        }

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully and notifications sent to ' . $subscribedCustomers->count() . ' subscribers.');
    }

    public function edit(Events $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Events $event)
    {
        $validated = $request->validate([
            'event_name'          => 'required|string|max:255',
            'event_type'          => 'nullable|string|max:255',
            'date_available'      => 'nullable|date',
            'date_expiry'         => 'nullable|date',
            'seo_url'             => 'required|string|max:255|unique:events,seo_url,' . $event->id,
            'meta_title'          => 'nullable|string|max:255',
            'meta_keywords'       => 'nullable|string|max:255',
            'meta_description'    => 'nullable|string',
            'event_short_content' => 'nullable|string',
            'detail_description'  => 'nullable|string',
            'front_image'         => 'nullable|image|max:2048',
            'button_icon'         => 'nullable|image|max:2048',
            'cover_image'         => 'nullable|image|max:2048',
            'no_coupon_cover'     => 'nullable|image|max:2048',
        ]);

        $validated['status'] = $request->boolean('status');
        $validated['show_footer'] = $request->boolean('show_footer');

        // Replace files (purani file delete karke)
        foreach (['front_image', 'button_icon', 'cover_image', 'no_coupon_cover'] as $field) {
            if ($request->hasFile($field)) {
                if ($event->{$field} && Storage::disk('public')->exists($event->{$field})) {
                    Storage::disk('public')->delete($event->{$field});
                }
                $validated[$field] = $request->file($field)->store('uploads/events', 'public');
            }
        }

        $event->update($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Events $event)
    {
        // Optional: files cleanup
        foreach (['front_image', 'button_icon', 'cover_image', 'no_coupon_cover'] as $field) {
            if ($event->{$field} && Storage::disk('public')->exists($event->{$field})) {
                Storage::disk('public')->delete($event->{$field});
            }
        }

        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }

    // ===== Bulk Delete (Coupons jaisa) =====
    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if (!$ids) {
            return back()->with('error', 'No events selected.');
        }

        $events = Events::whereIn('id', $ids)->get();

        // Optional: files cleanup per event
        foreach ($events as $event) {
            foreach (['front_image', 'button_icon', 'cover_image', 'no_coupon_cover'] as $field) {
                if ($event->{$field} && Storage::disk('public')->exists($event->{$field})) {
                    Storage::disk('public')->delete($event->{$field});
                }
            }
            $event->delete();
        }

        return back()->with('success', 'Selected events deleted successfully.');
    }

    // ===== Row Reorder (JS se aane wale keys: id + sort_order) =====
    public function reorder(Request $request)
    {
        $request->validate([
            'order'             => 'required|array',
            'order.*.id'        => 'required|integer|exists:events,id',
            'order.*.sort_order'=> 'required|integer|min:1',
        ]);

        foreach ($request->order as $item) {
            Events::where('id', $item['id'])->update(['sort_order' => $item['sort_order']]);
        }

        return response()->json(['status' => 'success']);
    }
}
