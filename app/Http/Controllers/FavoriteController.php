<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $events = auth()->user()->favorites()->with('organizer')->latest()->get();
        return view('favorites.index', compact('events'));
    }

    public function toggle(Event $event)
    {
        auth()->user()->favorites()->toggle($event->id);
        return back()->with('success', 'Daftar favorit diperbarui.');
    }
}