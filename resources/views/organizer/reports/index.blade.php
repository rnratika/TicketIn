<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-black leading-tight tracking-tight">
                    Laporan Penjualan Saya
                </h2>
                <p class="text-sm text-[#B8948C] mt-1">Pantau performa penjualan tiket event Anda.</p>
            </div>
            
            <!-- Statistik Ringkas (Opsional) -->
            <div class="flex gap-3">
                <div class="bg-white px-4 py-2 rounded-xl border border-[#B8948C]/20 shadow-sm flex items-center">
                    <div class="w-2 h-2 rounded-full bg-[#E73812] mr-2 animate-pulse"></div>
                    <span class="text-xs font-bold text-black">Real-time Data</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-[#FAFAFA] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Content Card -->
            <div class="bg-white shadow-2xl shadow-[#E73812]/20 sm:rounded-3xl border-2 border-[#E73812]/20 overflow-hidden">
                
                <!-- Table Container -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <!-- Table Header -->
                        <thead class="text-xs text-white uppercase bg-[#E73812]">
                            <tr>
                                <th class="px-8 py-5 tracking-wider font-bold rounded-tl-3xl">Event</th>
                                <th class="px-6 py-5 text-center tracking-wider font-bold">Tiket Terjual</th>
                                <th class="px-8 py-5 text-right tracking-wider font-bold">Total Pendapatan</th>
                                <th class="px-6 py-5 text-center tracking-wider font-bold rounded-tr-3xl">Detail Peserta</th> <!-- Kolom Baru -->
                            </tr>
                        </thead>
                        
                        <!-- Table Body -->
                        <tbody class="divide-y divide-[#B8948C]/10">
                            @forelse($stats as $stat)
                            <tr class="bg-white hover:bg-[#fff5f2] transition duration-200 group">
                                
                                <!-- Column: Event Name -->
                                <td class="px-8 py-6">
                                    <div class="flex flex-col">
                                        <span class="text-base font-extrabold text-black group-hover:text-[#E73812] transition">{{ $stat['event_name'] }}</span>
                                        <span class="text-xs text-[#B8948C] mt-0.5 font-medium">Laporan Penjualan Tiket</span>
                                    </div>
                                </td>

                                <!-- Column: Tickets Sold -->
                                <td class="px-6 py-6 text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-black text-white shadow-md">
                                        <svg class="w-3 h-3 mr-1.5 text-[#E73812]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                                        {{ $stat['total_tickets_sold'] }} Sold
                                    </span>
                                </td>

                                <!-- Column: Total Revenue -->
                                <td class="px-8 py-6 text-right">
                                    <span class="block font-extrabold text-[#E73812] text-lg tracking-tight">
                                        Rp {{ number_format($stat['total_revenue'], 0, ',', '.') }}
                                    </span>
                                </td>

                                <!-- [NEW] Column: Actions (Lihat Peserta) -->
                                <td class="px-6 py-6 text-center">
                                    @php
                                        // Ambil ID event berdasarkan nama (Logic View Only)
                                        $eventModel = \App\Models\Event::where('name', $stat['event_name'])->first();
                                    @endphp
                                    
                                    @if($eventModel)
                                        <a href="{{ route('organizer.events.attendees', $eventModel->id) }}" class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-white border-2 border-[#E73812]/10 text-[#B8948C] hover:text-white hover:bg-[#E73812] hover:border-[#E73812] transition shadow-sm group/btn">
                                            <svg class="w-4 h-4 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                            <span class="text-xs font-bold hidden md:inline">Lihat Peserta</span>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <!-- Empty State -->
                            <tr>
                                <td colspan="4" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-20 h-20 bg-[#FAFAFA] rounded-full flex items-center justify-center mb-4 border-2 border-dashed border-[#B8948C]/30">
                                            <svg class="w-10 h-10 text-[#B8948C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                        </div>
                                        <h3 class="text-lg font-bold text-black">Belum ada data penjualan</h3>
                                        <p class="text-[#B8948C] text-sm mt-1">Data akan muncul setelah tiket event Anda terjual.</p>
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