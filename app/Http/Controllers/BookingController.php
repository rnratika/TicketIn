<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    // Menyimpan Pesanan (CORE LOGIC)
    public function store(Request $request, Ticket $ticket)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            DB::transaction(function () use ($request, $ticket) {
                // 1. Lock tiket untuk mencegah race condition
                $ticketLocked = Ticket::where('id', $ticket->id)->lockForUpdate()->first();

                // 2. Cek Kuota
                if ($ticketLocked->quota < $request->quantity) {
                    throw new \Exception('Maaf, tiket sudah habis atau kuota tidak mencukupi.');
                }

                // 3. Kurangi Kuota
                $ticketLocked->decrement('quota', $request->quantity);

                // 4. Buat Booking
                Booking::create([
                    'user_id' => auth()->id(),
                    'ticket_id' => $ticketLocked->id,
                    'quantity' => $request->quantity,
                    'total_price' => $ticketLocked->price * $request->quantity,
                    'status' => 'approved', // Asumsi pembayaran langsung berhasil
                ]);
            });

            return redirect()->route('booking.history')->with('success', 'Tiket berhasil dipesan!');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    // Melihat Riwayat
    public function history()
    {
        $bookings = Booking::where('user_id', auth()->id())
                    ->with(['ticket.event'])
                    ->latest()
                    ->get();

        return view('bookings.history', compact('bookings'));
    }

    // Membatalkan Pesanan
    public function cancel(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        if ($booking->status === 'canceled') {
            return back()->with('error', 'Pesanan sudah dibatalkan.');
        }

        DB::transaction(function () use ($booking) {
            // Ubah status
            $booking->update(['status' => 'canceled']);
            
            // Kembalikan kuota
            $booking->ticket->increment('quota', $booking->quantity);
        });

        return back()->with('success', 'Pesanan berhasil dibatalkan.');
    }
}