<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-black leading-tight tracking-tight">
                    Tiket Saya
                </h2>
                <p class="text-sm text-[#B8948C] mt-1">Riwayat lengkap pemesanan event Anda.</p>
            </div>
            
            <!-- Statistik Ringkas (Opsional) -->
            <div class="hidden md:flex gap-3">
                <div class="bg-white px-4 py-2 rounded-xl border border-[#B8948C]/20 shadow-sm flex items-center">
                    <div class="w-2 h-2 rounded-full bg-[#E73812] mr-2"></div>
                    <span class="text-xs font-bold text-black">{{ $bookings->count() }} Transaksi</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-[#FAFAFA] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-r-xl shadow-sm flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-bold text-sm">{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            @endif

            <!-- Content Card (Style Table Organizer) -->
            <div class="bg-white shadow-2xl shadow-[#E73812]/20 sm:rounded-3xl border-2 border-[#E73812]/20 overflow-hidden">
                
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <!-- Table Header -->
                        <thead class="text-xs text-white uppercase bg-[#E73812]">
                            <tr>
                                <th class="px-8 py-5 tracking-wider font-bold rounded-tl-3xl">Event Detail</th>
                                <th class="px-6 py-5 tracking-wider font-bold">Jadwal & Lokasi</th>
                                <th class="px-6 py-5 text-center tracking-wider font-bold">Status</th>
                                <th class="px-6 py-5 text-right tracking-wider font-bold">Total Harga</th>
                                <th class="px-6 py-5 text-center tracking-wider font-bold rounded-tr-3xl">Aksi</th>
                            </tr>
                        </thead>
                        
                        <!-- Table Body -->
                        <tbody class="divide-y divide-[#B8948C]/10">
                            @forelse($bookings as $booking)
                            <tr class="bg-white hover:bg-[#fff5f2] transition duration-200 group">
                                
                                <!-- Column: Event & Ticket Info -->
                                <td class="px-8 py-6">
                                    <div class="flex flex-col">
                                        <span class="text-xs font-bold text-[#E73812] uppercase tracking-widest mb-1">
                                            #ORDER-{{ $booking->id }}
                                        </span>
                                        <span class="text-base font-bold text-black group-hover:text-[#E73812] transition mb-0.5">
                                            {{ $booking->ticket->event->name }}
                                        </span>
                                        <div class="flex items-center text-xs text-[#B8948C] font-medium">
                                            <span class="bg-[#FAFAFA] border border-[#B8948C]/20 px-2 py-0.5 rounded text-black mr-2">
                                                {{ $booking->ticket->name }}
                                            </span>
                                            <span>{{ $booking->quantity }} Tiket</span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Column: Schedule -->
                                <td class="px-6 py-6">
                                    <div class="flex flex-col gap-1">
                                        <div class="flex items-center text-black font-bold">
                                            <svg class="w-4 h-4 mr-2 text-[#E73812]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            {{ $booking->ticket->event->start_time->format('d M Y') }}
                                        </div>
                                        <div class="flex items-center text-xs text-[#B8948C] font-medium">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            {{ $booking->ticket->event->location }}
                                        </div>
                                    </div>
                                </td>

                                <!-- Column: Status -->
                                <td class="px-6 py-6 text-center">
                                    @if($booking->status == 'approved')
                                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-green-100 text-green-700 border border-green-200">
                                            <span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span> Berhasil
                                        </span>
                                    @elseif($booking->status == 'canceled')
                                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-red-50 text-red-600 border border-red-100">
                                            <span class="w-2 h-2 rounded-full bg-red-500 mr-2"></span> Dibatalkan
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-[#F5CB49]/20 text-[#E08B36] border border-[#F5CB49]/50">
                                            <span class="w-2 h-2 rounded-full bg-[#E08B36] mr-2 animate-pulse"></span> Pending
                                        </span>
                                    @endif
                                </td>

                                <!-- Column: Total Price -->
                                <td class="px-6 py-6 text-right">
                                    <span class="block font-bold text-[#E73812] text-base">
                                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                    </span>
                                </td>

                                <!-- Column: Action -->
                                <td class="px-6 py-6 text-center">
                                    @if($booking->status == 'approved')
                                        <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?');">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="text-red-500 hover:text-white hover:bg-red-600 border border-red-200 px-4 py-2 rounded-lg font-bold text-xs transition duration-200 flex items-center justify-center mx-auto group/btn">
                                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                Batalkan
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-xs text-[#B8948C] italic font-medium">-</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <!-- Empty State -->
                            <tr>
                                <td colspan="5" class="px-6 py-24 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-24 h-24 bg-[#FAFAFA] rounded-full flex items-center justify-center mb-6 border-2 border-dashed border-[#B8948C]/30 group hover:border-[#E73812] transition">
                                            <svg class="w-12 h-12 text-[#B8948C] group-hover:text-[#E73812] transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                                        </div>
                                        <h3 class="text-xl font-bold text-black">Belum ada tiket</h3>
                                        <p class="text-[#B8948C] text-sm mt-2 mb-8 max-w-md leading-relaxed">Temukan event seru dan mulailah petualangan Anda!</p>
                                        <a href="{{ route('home') }}" class="bg-[#E73812] hover:bg-black text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-red-200 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex items-center">
                                            Cari Event Sekarang <span class="ml-2">&rarr;</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>