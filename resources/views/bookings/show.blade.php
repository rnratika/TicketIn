<x-app-layout>
    <style>
        @media print {
            @page {
                size: landscape;
                margin: 0;
            }

            body {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                background-color: #fff !important;
                margin: 0 !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                height: 100vh !important;
            }

            nav, header, footer, .no-print, .bg-gray-100 {
                display: none !important;
            }

            .py-12, .min-h-screen {
                padding: 0 !important;
                min-height: auto !important;
                background: transparent !important;
                width: 100% !important;
                display: flex !important;
                justify-content: center !important;
            }

            .print-container {
                width: 900px !important;
                max-width: 100% !important;
                margin: 0 auto !important;
                padding: 0 !important;
                position: relative !important;
            }

            .ticket-card {
                display: flex !important;
                flex-direction: row !important;
                width: 100% !important;
                height: 350px !important;
                border: 2px solid #ddd !important;
                border-radius: 20px !important;
                box-shadow: none !important;
                overflow: hidden !important;
                page-break-inside: avoid;
            }

            .ticket-left {
                width: 65% !important;
                border-right: 3px dashed #E73812 !important;
                border-bottom: none !important;
                padding: 30px !important;
                display: flex !important;
                flex-direction: column !important;
                justify-content: center !important;
            }

            .ticket-right {
                width: 35% !important;
                background-color: #E73812 !important;
                color: white !important;
                display: flex !important;
                flex-direction: column !important;
                justify-content: center !important;
                align-items: center !important;
            }

            .text-white { color: #fff !important; }
            .bg-black { background-color: #000 !important; }
            .ticket-right p { color: white !important; }

            .ticket-right .bg-white svg { 
                color: #000000 !important; 
                fill: #000000 !important; 
            }
            
            .absolute.rounded-full {
                display: none !important; 
            }
            
            .status-badge {
                display: none !important;
            }
        }
    </style>

    <x-slot name="header">
        <div class="flex justify-between items-center no-print">
            <h2 class="font-extrabold text-2xl text-black leading-tight tracking-tight">
                E-Ticket
            </h2>
            <a href="{{ route('booking.history') }}" class="text-[#B8948C] hover:text-black font-bold text-sm flex items-center">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-[#FAFAFA] min-h-screen flex justify-center items-start print:bg-white print:py-0 print:h-auto">
        <div class="max-w-4xl w-full px-4 sm:px-6 lg:px-8 print-container">

            <div class="ticket-card bg-white rounded-[2rem] shadow-2xl shadow-[#B8948C]/20 overflow-hidden flex flex-col md:flex-row border border-[#B8948C]/10 relative">
                
                <div class="absolute top-1/2 -left-4 w-8 h-8 bg-[#FAFAFA] rounded-full z-10 no-print"></div>
                <div class="absolute top-1/2 -right-4 w-8 h-8 bg-[#FAFAFA] rounded-full z-10 no-print"></div>
                
                <div class="ticket-left md:w-2/3 p-8 md:p-10 border-b md:border-b-0 md:border-r-4 border-dashed border-[#E73812] relative">

                    <div class="status-badge absolute top-6 right-8 no-print">
                        @if($booking->status == 'approved')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-extrabold border border-green-200 uppercase tracking-wider">
                                Paid & Confirmed
                            </span>
                        @elseif($booking->status == 'pending')
                            <span class="bg-[#F5CB49]/20 text-[#E08B36] px-3 py-1 rounded-full text-xs font-extrabold border border-[#F5CB49]/50 uppercase tracking-wider animate-pulse">
                                Awaiting Approval
                            </span>
                        @else
                            <span class="bg-red-50 text-red-600 px-3 py-1 rounded-full text-xs font-extrabold border border-red-200 uppercase tracking-wider">
                                {{ $booking->status }}
                            </span>
                        @endif
                    </div>

                    <div class="mb-2 flex items-center">
                        <span class="text-[#E73812] font-extrabold text-lg tracking-tighter">Ticket</span>
                        <span class="text-black font-extrabold text-lg tracking-tighter">In.</span>
                        <span class="mx-3 text-[#B8948C] text-xs font-bold uppercase tracking-[0.2em]">Official Ticket</span>
                    </div>

                    <h1 class="text-3xl md:text-4xl font-extrabold text-[#E73812] leading-tight mb-2">
                        {{ $booking->ticket->event->name }}
                    </h1>

                    <div class="flex items-start gap-6 mb-8">
                        <div class="w-24 h-24 rounded-2xl overflow-hidden bg-black flex-shrink-0 shadow-lg shadow-[#E73812]/20 print:shadow-none print:border print:border-gray-300">
                            @if($booking->ticket->event->image)
                                <img src="{{ asset('storage/' . $booking->ticket->event->image) }}" class="w-full h-full object-cover opacity-90">
                            @else
                                <div class="flex items-center justify-center h-full text-white text-xs font-bold">IMG</div>
                            @endif
                        </div>
                        
                        <div class="space-y-3 flex-1">
                            <div>
                                <p class="text-[#B8948C] text-xs uppercase font-bold">Tanggal & Waktu</p>
                                <p class="text-black font-bold text-lg">{{ $booking->ticket->event->start_time->format('d F Y') }}</p>
                                <p class="text-black font-bold text-sm">{{ $booking->ticket->event->start_time->format('H:i') }} WIB</p>
                            </div>
                            <div>
                                <p class="text-[#B8948C] text-xs uppercase font-bold">Lokasi</p>
                                <p class="text-black font-bold text-sm">{{ $booking->ticket->event->location }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <p class="text-[#B8948C] text-xs uppercase font-bold">Pemilik Tiket</p>
                            <p class="text-black font-extrabold text-lg">{{ Auth::user()->name }}</p>
                        </div>
                        <div>
                            <p class="text-[#B8948C] text-xs uppercase font-bold">Jenis Tiket</p>
                            <p class="text-[#E73812] font-extrabold text-lg">{{ $booking->ticket->name }} <span class="text-black text-sm font-medium">(x{{ $booking->quantity }})</span></p>
                        </div>
                    </div>
                </div>

                <div class="ticket-right md:w-1/3 p-8 bg-[#E73812] text-white flex flex-col items-center justify-center relative overflow-hidden">
                    
                    <div class="relative z-10 text-center w-full">
                        <p class="text-white/80 text-xs uppercase font-bold tracking-widest mb-4">Scan This Code</p>
                        
                        <div class="bg-white p-3 rounded-xl shadow-xl mb-6 mx-auto w-40 h-40 flex items-center justify-center print:shadow-none">
                            <svg class="w-full h-full text-black" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M3 3h6v6H3V3zm2 2v2h2V5H5zm8-2h6v6h-6V3zm2 2v2h2V5h-2zM3 13h6v6H3v-6zm2 2v2h2v-2H5zm13-2h3v2h-3v-2zm-3 2h2v2h-2v-2zm3 2h3v2h-3v-2zM3 3h6v6H3V3zm13 0h6v6h-6V3zM3 13h6v6H3v-6z"/>
                                <rect x="9" y="9" width="2" height="2" fill="currentColor"/>
                                <rect x="13" y="9" width="2" height="2" fill="currentColor"/>
                                <rect x="9" y="13" width="2" height="2" fill="currentColor"/>
                                <path d="M17 17h2v2h-2z" fill="currentColor"/>
                            </svg>
                        </div>

                        <p class="text-white/90 font-mono text-sm font-bold tracking-widest mb-1">#{{ $booking->id }}</p>
                        <p class="text-white/60 text-[10px] uppercase">Booking ID</p>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-center gap-4 no-print">
                <button onclick="window.print()" class="bg-black text-white px-6 py-3 rounded-xl font-bold text-sm hover:bg-[#E73812] transition shadow-lg flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Cetak Tiket
                </button>
                
                @if($booking->status == 'approved' || $booking->status == 'pending')
                    <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?');">
                        @csrf @method('PATCH')
                        <button type="submit" class="bg-white text-red-600 border border-red-200 px-6 py-3 rounded-xl font-bold text-sm hover:bg-red-50 transition shadow-sm flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            Batalkan Pesanan
                        </button>
                    </form>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>