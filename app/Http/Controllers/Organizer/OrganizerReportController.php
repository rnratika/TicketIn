<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Booking;

class OrganizerReportController extends Controller
{
    public function index()
    {
        // Ambil event milik organizer beserta tiket dan booking
        $events = Event::where('organizer_id', auth()->id())
                    ->with(['tickets', 'bookings']) // bookings lewat hasManyThrough
                    ->get();

        // Hitung statistik sederhana
        $stats = $events->map(function($event) {
            return [
                'event_name' => $event->name,
                'total_tickets_sold' => $event->bookings->count(), // Asumsi 1 booking 1 item, jika quantity > 1 perlu sum('quantity')
                'total_revenue' => $event->bookings->where('status', 'approved')->sum('total_price'),
            ];
        });

        return view('organizer.reports.index', compact('stats'));
    }
}