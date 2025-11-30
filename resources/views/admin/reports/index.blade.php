<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-black leading-tight tracking-tight">
            Laporan Global (Admin)
        </h2>
    </x-slot>

    <div class="py-12 bg-[#FAFAFA] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                <div class="bg-white p-8 rounded-3xl shadow-2xl shadow-[#E73812]/20 border-2 border-[#E73812]/20 hover:shadow-2xl hover:-translate-y-1 transition duration-300 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-[#E73812]/5 rounded-bl-full -mr-4 -mt-4 transition group-hover:bg-[#E73812]/10"></div>
                    <div class="relative z-10">
                        <div class="text-[#B8948C] text-xs font-bold uppercase tracking-widest mb-2">Total Pendapatan</div>
                        <div class="text-3xl font-bold text-[#E73812]">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-2xl shadow-[#E73812]/20 border-2 border-[#E73812]/20 hover:shadow-2xl hover:-translate-y-1 transition duration-300 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-black/5 rounded-bl-full -mr-4 -mt-4 transition group-hover:bg-black/10"></div>
                    <div class="relative z-10">
                        <div class="text-[#B8948C] text-xs font-bold uppercase tracking-widest mb-2">Tiket Terjual</div>
                        <div class="text-3xl font-bold text-black">{{ $totalTicketsSold }}</div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-2xl shadow-[#E73812]/20 border-2 border-[#E73812]/20 hover:shadow-2xl hover:-translate-y-1 transition duration-300 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-[#F5CB49]/10 rounded-bl-full -mr-4 -mt-4 transition group-hover:bg-[#F5CB49]/20"></div>
                    <div class="relative z-10">
                        <div class="text-[#B8948C] text-xs font-bold uppercase tracking-widest mb-2">Total Event</div>
                        <div class="text-3xl font-bold text-black">{{ $totalEvents }}</div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-2xl shadow-[#E73812]/20 border-2 border-[#E73812]/20 hover:shadow-2xl hover:-translate-y-1 transition duration-300 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-[#E08B36]/10 rounded-bl-full -mr-4 -mt-4 transition group-hover:bg-[#E08B36]/20"></div>
                    <div class="relative z-10">
                        <div class="text-[#B8948C] text-xs font-bold uppercase tracking-widest mb-2">Total Organizer</div>
                        <div class="text-3xl font-bold text-black">{{ $totalOrganizers }}</div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-2xl shadow-[#E73812]/20 p-10 text-center border-2 border-[#E73812]/20 flex flex-col items-center">
                <div class="w-16 h-16 bg-[#FAFAFA] rounded-full flex items-center justify-center mb-4 border-2 border-[#B8948C]/10">
                    <svg class="w-8 h-8 text-[#E73812]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-black mb-2">Ringkasan Data Platform</h3>
                <p class="text-[#B8948C] max-w-2xl mx-auto">Laporan ini mencakup seluruh data transaksi, tiket, dan event yang tercatat di platform TicketIn secara real-time untuk keperluan monitoring Admin.</p>
            </div>

        </div>
    </div>
</x-app-layout>