<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function store(Request $request, Ticket $ticket)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        try {
            DB::transaction(function () use ($request, $ticket) {
                $ticketLocked = Ticket::where('id', $ticket->id)->lockForUpdate()->first();

                if ($ticketLocked->quota < $request->quantity) {
                    throw new \Exception('Maaf, tiket sudah habis.');
                }

                $ticketLocked->decrement('quota', $request->quantity);
                Booking::create([
                    'user_id' => auth()->id(),
                    'ticket_id' => $ticketLocked->id,
                    'quantity' => $request->quantity,
                    'total_price' => $ticketLocked->price * $request->quantity,
                    'status' => 'pending', 
                ]);
            });

            return redirect()->route('booking.history')->with('success', 'Pesanan berhasil dibuat! Menunggu persetujuan Organizer');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function history()
    {
        $bookings = Booking::where('user_id', auth()->id())
                    ->with(['ticket.event'])
                    ->latest()
                    ->get();

        return view('bookings.history', compact('bookings'));
    }

    public function cancel(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        if ($booking->status === 'canceled') {
            return back()->with('error', 'Pesanan sudah dibatalkan.');
        }

        DB::transaction(function () use ($booking) {
            $booking->update(['status' => 'canceled']);
            
            $booking->ticket->increment('quota', $booking->quantity);
        });

        return back()->with('success', 'Pesanan berhasil dibatalkan.');
    }
}