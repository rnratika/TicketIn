<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TicketIn - Temukan Event Seru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-[#FAFAFA] text-black">
    
    @include('layouts.navigation')

    <div class="relative bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto pt-20 pb-10 px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block py-1 px-3 rounded-full bg-[#F5CB49]/20 text-[#E08B36] text-xs font-extrabold uppercase tracking-wider mb-6 border border-[#F5CB49]/50">
                The Best Ticketing Platform
            </span>
            
            <h1 class="text-5xl md:text-6xl font-extrabold text-black tracking-tight mb-6">
                Find Your Next <br>
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-[#E73812] to-[#E08B36]">Unforgettable Experience</span>
            </h1>
            <p class="text-[#B8948C] max-w-2xl mx-auto mb-10 font-medium">
                Dari konser musik hingga workshop kreatif, temukan dan pesan tiket acara favoritmu dalam hitungan detik.
            </p>

            <form action="{{ route('home') }}" method="GET" class="max-w-2xl mx-auto relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-[#E73812] to-[#F5CB49] rounded-full blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative flex items-center bg-white rounded-full shadow-xl p-2 border border-[#B8948C]/20">
                    <svg class="w-6 h-6 text-[#B8948C] ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" name="search" value="{{ request('search') }}" class="w-full p-3 text-black outline-none placeholder-[#B8948C] font-medium" placeholder="Cari konser, artis, atau lokasi...">
                    <button type="submit" class="bg-black hover:bg-[#E73812] text-white px-8 py-3 rounded-full font-bold transition duration-300">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="pt-8 pb-20 bg-[#FAFAFA]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl font-extrabold text-black border-l-8 border-[#E73812] pl-4">Event Terbaru</h2>
                    <p class="text-[#B8948C] mt-2 pl-6">Jangan sampai ketinggalan acara yang sedang tren.</p>
                </div>
                <a href="#" class="text-[#E73812] font-bold hover:text-black transition flex items-center">Lihat Semua <span class="ml-2 text-xl">&rarr;</span></a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($events as $event)
                <a href="{{ route('events.show', $event->id) }}" class="group bg-white rounded-3xl shadow-sm border-2 border-[#E73812]/20 hover:shadow-3xl hover:shadow-[#E73812]/20 hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col h-full">
                    <div class="h-56 relative overflow-hidden">
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" class="w-full h-full object-cover transition duration-700">
                        @else
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center text-[#B8948C]">No Image</div>
                        @endif
                        <div class="absolute top-4 left-4 bg-white/80 backdrop-blur-md px-3 py-1.5 rounded-lg text-sm font-bold text-black shadow-sm">
                            {{ $event->start_time->format('d M Y') }}
                        </div>
                    </div>
                    
                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="text-xl font-bold text-black mb-2 line-clamp-2 group-hover:text-[#E73812] transition">{{ $event->name }}</h3>

                        <div class="flex items-center text-[#B8948C] text-xs font-bold mb-3">
                            <svg class="w-4 h-4 mr-1.5 text-[#E73812]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $event->location }}
                        </div>

                        <p class="text-[#B8948C] text-sm line-clamp-2 flex-1 font-medium">{{ $event->description }}</p>
                        
                        <div class="border-t border-gray-100 pt-4 flex items-center justify-between mt-auto">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-black flex items-center justify-center text-xs font-bold text-white">
                                    {{ substr($event->organizer->name, 0, 1) }}
                                </div>
                                <span class="text-xs font-bold text-black">{{ $event->organizer->name }}</span>
                            </div>
                            <span class="text-lg font-extrabold text-[#E73812]">
                                {{ $event->tickets->min('price') == 0 ? 'Free' : 'Rp '.number_format($event->tickets->min('price')/1000).'k+' }}
                            </span>
                        </div>
                    </div>
                </a>
                @empty
                <div class="col-span-3 py-20 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-[#F5CB49]/20 mb-4 text-[#E08B36]">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-black">Belum ada event</h3>
                    <p class="text-[#B8948C]">Coba cari kata kunci lain atau kembali nanti.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</body>
</html>