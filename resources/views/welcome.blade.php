<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TicketIn - Temukan Event Seru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-50 text-gray-800">
    
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-indigo-600 tracking-tighter">TicketIn<span class="text-gray-800">.</span></a>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-indigo-600">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-indigo-600">Log in</a>
                        <a href="{{ route('register') }}" class="ml-4 px-4 py-2 rounded-full bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 transition">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="bg-indigo-900 py-20 text-center text-white">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Jelajahi Event Terpopuler</h1>
        <p class="text-indigo-200 mb-8 text-lg">Pesan tiket konser, seminar, dan pameran favoritmu sekarang.</p>
        
        <form action="{{ route('home') }}" method="GET" class="max-w-xl mx-auto px-4">
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari event atau lokasi..." class="w-full py-4 px-6 rounded-full text-gray-800 focus:outline-none focus:ring-4 focus:ring-indigo-500 shadow-lg">
                <button type="submit" class="absolute right-2 top-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full px-6 py-2 transition">Cari</button>
            </div>
        </form>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Event Terbaru</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($events as $event)
            <a href="{{ route('events.show', $event->id) }}" class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition duration-300 overflow-hidden border border-gray-100 block">
                <div class="h-48 bg-gray-200 relative overflow-hidden">
                    @if($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <div class="flex items-center justify-center h-full text-gray-400 bg-gray-100">No Image</div>
                    @endif
                    <div class="absolute top-3 right-3 bg-white/90 backdrop-blur px-3 py-1 rounded-lg text-xs font-bold text-indigo-600 shadow-sm">
                        {{ $event->start_time->format('d M Y') }}
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-indigo-600 transition">{{ $event->name }}</h3>
                    <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $event->description }}</p>
                    <div class="flex items-center text-gray-400 text-xs mb-4">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $event->location }}
                    </div>
                    <div class="border-t pt-4 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs mr-2">
                                {{ substr($event->organizer->name, 0, 1) }}
                            </div>
                            <span class="text-xs text-gray-500">By {{ $event->organizer->name }}</span>
                        </div>
                        <span class="text-indigo-600 font-medium text-sm">Lihat Detail &rarr;</span>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-3 text-center py-12">
                <p class="text-gray-500 text-lg">Belum ada event yang tersedia saat ini.</p>
            </div>
            @endforelse
        </div>
    </div>
</body>
</html>