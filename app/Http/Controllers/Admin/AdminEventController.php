<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // untuk hapus gambar

class AdminEventController extends Controller
{
    public function index()
    {
        $events = Event::with('organizer')->latest()->get();
        return view('admin.events.index', compact('events'));
    }

    public function destroy(Event $event)
    {
        if ($event->image) Storage::disk('public')->delete($event->image); 
        $event->delete();
        return back()->with('success', 'Event berhasil dihapus oleh Admin.');
    }

    public function reports()
    {
        $totalRevenue = Booking::where('status', 'approved')->sum('total_price');
        $totalTicketsSold = Booking::where('status', 'approved')->sum('quantity');
        $totalEvents = Event::count();
        $totalOrganizers = User::where('role', 'organizer')->count();

        return view('admin.reports.index', compact('totalRevenue', 'totalTicketsSold', 'totalEvents', 'totalOrganizers'));
    }

    public function create()
    {
        return view('organizer.events.create', ['isAdmin' => true]); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'start_time' => 'required|date',
            'location' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'tickets' => 'required|array|min:1',
            'tickets.*.name' => 'required|string',
            'tickets.*.price' => 'required|numeric|min:0',
            'tickets.*.quota' => 'required|integer|min:1',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('events', 'public') : null;

        $event = Event::create([
            'organizer_id' => auth()->id(),
            'name' => $request->name,
            'description' => $request->description,
            'start_time' => $request->start_time,
            'location' => $request->location,
            'image' => $imagePath,
        ]);

        foreach ($request->tickets as $ticketData) {
            $event->tickets()->create($ticketData);
        }
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dibuat oleh Admin.');
    }

    public function edit(Event $event)
    {
        return view('organizer.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'start_time' => 'required|date',
            'location' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // upload gambar baru
        if ($request->hasFile('image')) {
            if ($event->image) Storage::disk('public')->delete($event->image);
            $event->image = $request->file('image')->store('events', 'public');
        }

        // update data event
        $event->update($request->only(['name', 'description', 'start_time', 'location', 'image']));

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui oleh Admin.');
    }
}