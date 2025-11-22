<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tiket Saya
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid gap-6">
                @forelse($bookings as $booking)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden flex flex-col md:flex-row border border-gray-100">
                        <div class="p-6 flex-1">
                            <div class="flex justify-between items-start">
                                <div>
                                    <span class="inline-block py-1 px-2 rounded bg-indigo-100 text-indigo-800 text-xs font-bold mb-2">
                                        #ORDER-{{ $booking->id }}
                                    </span>
                                    <h3 class="text-xl font-bold text-gray-900">{{ $booking->ticket->event->name }}</h3>
                                    <p class="text-gray-500 text-sm mt-1">{{ $booking->ticket->name }} Ticket</p>
                                </div>
                                <div class="text-right">
                                    @if($booking->status == 'approved')
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">Berhasil</span>
                                    @elseif($booking->status == 'canceled')
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">Dibatalkan</span>
                                    @else
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800">Pending</span>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-6 grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <p class="text-gray-400">Tanggal Event</p>
                                    <p class="font-medium text-gray-800">{{ $booking->ticket->event->start_time->format('d M Y, H:i') }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400">Lokasi</p>
                                    <p class="font-medium text-gray-800">{{ $booking->ticket->event->location }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400">Jumlah</p>
                                    <p class="font-medium text-gray-800">{{ $booking->quantity }} Tiket</p>
                                </div>
                                <div>
                                    <p class="text-gray-400">Total Harga</p>
                                    <p class="font-medium text-indigo-600">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-6 md:w-48 flex flex-col justify-center items-center border-t md:border-t-0 md:border-l border-gray-200 border-dashed relative">
                            <div class="absolute -top-3 left-1/2 md:top-1/2 md:-left-3 w-6 h-6 bg-gray-100 rounded-full"></div>
                            <div class="absolute -bottom-3 left-1/2 md:bottom-auto md:top-1/2 md:-right-3 w-6 h-6 bg-gray-100 rounded-full"></div>
                            
                            @if($booking->status == 'approved')
                                <div class="text-center">
                                    <svg class="w-16 h-16 text-gray-800 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                                    <span class="text-xs text-gray-500 font-mono">Show this at entry</span>
                                    
                                    <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" class="mt-4" onsubmit="return confirm('Yakin ingin membatalkan tiket ini?');">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="text-xs text-red-600 hover:text-red-800 underline">Batalkan Pesanan</button>
                                    </form>
                                </div>
                            @else
                                <span class="text-gray-400 text-sm italic">Tiket tidak aktif</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 bg-white rounded-xl shadow-sm">
                        <p class="text-gray-500">Anda belum memesan tiket apapun.</p>
                        <a href="{{ route('home') }}" class="mt-4 inline-block text-indigo-600 hover:underline">Cari Event Sekarang</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>