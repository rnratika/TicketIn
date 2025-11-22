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
        // 1. Validasi Input
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        $userId = auth()->id();

        // 2. Cek apakah user sudah pernah booking event ini dan statusnya approved
        $hasBooking = Booking::where('user_id', $userId)
            ->whereIn('ticket_id', $event->tickets->pluck('id')) // Cek tiket milik event ini
            ->where('status', 'approved')
            ->exists();

        if (!$hasBooking) {
            return back()->with('error', 'Anda harus membeli tiket event ini terlebih dahulu untuk memberikan ulasan.');
        }

        // 3. Cek apakah user sudah pernah review sebelumnya (agar tidak spam)
        $hasReviewed = Review::where('user_id', $userId)
            ->where('event_id', $event->id)
            ->exists();

        if ($hasReviewed) {
            return back()->with('error', 'Anda sudah memberikan ulasan untuk event ini.');
        }

        // 4. Simpan Review
        Review::create([
            'user_id' => $userId,
            'event_id' => $event->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Terima kasih atas ulasan Anda!');
    }
}