<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;

class AdminEventController extends Controller
{
    // 1. Manage All Events
    public function index()
    {
        $events = Event::with('organizer')->latest()->get();
        return view('admin.events.index', compact('events'));
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return back()->with('success', 'Event berhasil dihapus oleh Admin.');
    }

    // 2. Global Reports
    public function reports()
    {
        $totalRevenue = Booking::where('status', 'approved')->sum('total_price');
        $totalTicketsSold = Booking::where('status', 'approved')->sum('quantity');
        $totalEvents = Event::count();
        $totalOrganizers = User::where('role', 'organizer')->count();

        return view('admin.reports.index', compact('totalRevenue', 'totalTicketsSold', 'totalEvents', 'totalOrganizers'));
    }

    // BARU: Admin Create Event Form
    public function create()
    {
        // Kita bisa reuse view organizer atau buat baru. 
        // Untuk efisiensi, kita reuse view tapi pastikan route form action-nya benar.
        // Di sini saya arahkan ke view khusus admin atau reuse view organizer dengan passing route.
        return view('organizer.events.create', ['isAdmin' => true]); 
    }

    // BARU: Admin Store Event
    public function store(Request $request)
    {
        // Validasi sama persis dengan Organizer
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
            'organizer_id' => auth()->id(), // Admin jadi organizer-nya
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
}