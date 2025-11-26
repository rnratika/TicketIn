<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Review;
use App\Models\Booking;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        $userId = auth()->id();
        $hasBooking = Booking::where('user_id', $userId)
            ->whereIn('ticket_id', $event->tickets->pluck('id'))
            ->where('status', 'approved')
            ->exists();

        if (!$hasBooking) {
            return back()->with('error', 'Anda harus membeli tiket event ini terlebih dahulu untuk memberikan ulasan.');
        }

        $hasReviewed = Review::where('user_id', $userId)
            ->where('event_id', $event->id)
            ->exists();

        if ($hasReviewed) {
            return back()->with('error', 'Anda sudah memberikan ulasan untuk event ini.');
        }

        Review::create([
            'user_id' => $userId,
            'event_id' => $event->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Terima kasih atas ulasan Anda!');
    }
}