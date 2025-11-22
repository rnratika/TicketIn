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
}