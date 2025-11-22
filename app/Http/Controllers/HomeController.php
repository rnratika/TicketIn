<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query()->with('organizer');

        // Fitur Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
        }

        // Urutkan berdasarkan event terbaru
        $events = $query->latest()->get();

        return view('welcome', compact('events'));
    }

    public function show(Event $event)
    {
        // Load relasi tickets agar bisa dibeli
        $event->load(['tickets', 'organizer', 'reviews.user']); 
        return view('events.show', compact('event'));
    }
}