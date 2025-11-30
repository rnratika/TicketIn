<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query()->with('organizer');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
        }

        $events = $query->latest()->get();

        return view('welcome', compact('events'));
    }

    public function show(Event $event)
    {
        $event->load(['tickets', 'organizer', 'reviews.user']); 
        return view('events.show', compact('event'));
    }
}