<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-black leading-tight tracking-tight">
                    Daftar Peserta
                </h2>
                <p class="text-sm text-[#B8948C] mt-1">Event: <span class="font-bold text-black">{{ $event->name }}</span></p>
            </div>
            <a href="{{ route('organizer.reports.index') }}" class="text-[#B8948C] hover:text-black font-bold text-sm">&larr; Kembali ke Laporan</a>
        </div>
    </x-slot>

    <div class="py-12 bg-[#FAFAFA] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-r-xl shadow-sm font-bold text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-2xl shadow-[#E73812]/20 sm:rounded-3xl border-2 border-[#E73812]/20 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-white uppercase bg-[#E73812]">
                            <tr>
                                <th class="px-8 py-5 tracking-wider font-bold rounded-tl-3xl">Nama Peserta</th>
                                <th class="px-6 py-5 tracking-wider font-bold">Tiket</th>
                                <th class="px-6 py-5 tracking-wider font-bold">Total Bayar</th>
                                <th class="px-6 py-5 text-center tracking-wider font-bold">Status</th>
                                <th class="px-6 py-5 text-center tracking-wider font-bold rounded-tr-3xl">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#B8948C]/10">
                            @forelse($bookings as $booking)
                            <tr class="bg-white hover:bg-[#fff5f2] transition duration-200">
                                <td class="px-8 py-6">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-black">{{ $booking->user->name }}</span>
                                        <span class="text-xs text-[#B8948C]">{{ $booking->user->email }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    <span class="bg-gray-100 text-black text-xs font-bold px-2 py-1 rounded border border-gray-200">
                                        {{ $booking->ticket->name }} (x{{ $booking->quantity }})
                                    </span>
                                </td>
                                <td class="px-6 py-6 font-bold text-[#E73812]">
                                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-6 text-center">
                                    @if($booking->status == 'approved')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                            Approved
                                        </span>
                                    @elseif($booking->status == 'pending')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-[#F5CB49]/20 text-[#E08B36] animate-pulse">
                                            Pending
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-100 text-red-700">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-6 text-center">
                                    @if($booking->status == 'pending')
                                        <div class="flex justify-center gap-2">
                                            <form action="{{ route('organizer.bookings.approve', $booking->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white p-2 rounded-lg transition shadow-md" title="Approve">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                </button>
                                            </form>
                                            <form action="{{ route('organizer.bookings.reject', $booking->id) }}" method="POST" onsubmit="return confirm('Tolak pesanan ini?');">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white p-2 rounded-lg transition shadow-md" title="Reject">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-xs text-[#B8948C]">-</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-[#B8948C]">Belum ada peserta.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>