<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganizerEventController extends Controller
{
    // Menampilkan Event milik Organizer sendiri
    public function index()
    {
        $events = Event::where('organizer_id', auth()->id())->latest()->get();
        return view('organizer.events.index', compact('events'));
    }

    public function create()
    {
        return view('organizer.events.create');
    }

    // Simpan Event + Tiket sekaligus
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'start_time' => 'required|date',
            'location' => 'required|string',
            'image' => 'nullable|image|max:2048',
            // Validasi Array Tiket
            'tickets' => 'required|array|min:1',
            'tickets.*.name' => 'required|string',
            'tickets.*.price' => 'required|numeric|min:0',
            'tickets.*.quota' => 'required|integer|min:1',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
        }

        // 1. Buat Event
        $event = Event::create([
            'organizer_id' => auth()->id(),
            'name' => $request->name,
            'description' => $request->description,
            'start_time' => $request->start_time,
            'location' => $request->location,
            'image' => $imagePath,
        ]);

        // 2. Buat Tiket
        foreach ($request->tickets as $ticketData) {
            $event->tickets()->create($ticketData);
        }

        return redirect()->route('organizer.events.index')->with('success', 'Event berhasil dibuat.');
    }

    public function edit(Event $event)
    {
        $this->authorizeAccess($event);
        return view('organizer.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $this->authorizeAccess($event);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'start_time' => 'required|date',
            'location' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($event->image) Storage::disk('public')->delete($event->image);
            $event->image = $request->file('image')->store('events', 'public');
        }

        $event->update($request->only(['name', 'description', 'start_time', 'location', 'image']));

        return redirect()->route('organizer.events.index')->with('success', 'Event diperbarui.');
    }

    public function destroy(Event $event)
    {
        $this->authorizeAccess($event);
        
        if ($event->image) Storage::disk('public')->delete($event->image);
        $event->delete();

        return back()->with('success', 'Event dihapus.');
    }

    // Helper function untuk keamanan
    private function authorizeAccess($event)
    {
        if ($event->organizer_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    }

     public function attendees(Event $event)
    {
        // Pastikan event milik organizer ini
        if ($event->organizer_id !== auth()->id()) {
            abort(403);
        }

        // Ambil booking terkait event ini
        $bookings = Booking::whereHas('ticket', function($q) use ($event) {
            $q->where('event_id', $event->id);
        })->with(['user', 'ticket'])->latest()->get();

        return view('organizer.events.attendees', compact('event', 'bookings'));
    }

    // BARU: Approve Pesanan
    public function approveBooking(Booking $booking)
    {
        // Validasi kepemilikan event
        if ($booking->ticket->event->organizer_id !== auth()->id()) {
            abort(403);
        }

        $booking->update(['status' => 'approved']);
        return back()->with('success', 'Pesanan disetujui.');
    }

    // BARU: Reject Pesanan
    public function rejectBooking(Booking $booking)
    {
        if ($booking->ticket->event->organizer_id !== auth()->id()) {
            abort(403);
        }

        DB::transaction(function () use ($booking) {
            $booking->update(['status' => 'rejected']);
            // Kembalikan kuota
            $booking->ticket->increment('quota', $booking->quantity);
        });

        return back()->with('success', 'Pesanan ditolak dan kuota dikembalikan.');
    }
}