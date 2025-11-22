<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Event
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                        <div class="h-80 bg-gray-200 relative">
                            @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" class="w-full h-full object-cover" alt="{{ $event->name }}">
                            @else
                                <div class="flex items-center justify-center h-full text-gray-400 bg-gray-100">No Image Available</div>
                            @endif
                        </div>

                        <div class="p-8">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-2">
                                <h1 class="text-3xl font-bold text-gray-900 leading-tight">{{ $event->name }}</h1>
                                <span class="inline-block bg-indigo-50 text-indigo-700 px-4 py-1.5 rounded-full text-sm font-bold self-start md:self-center">
                                    {{ $event->start_time->format('d M Y, H:i') }}
                                </span>
                            </div>
                            
                            @auth
                                @if(auth()->user()->role === 'user')
                                    <div class="mb-6">
                                        <form action="{{ route('favorites.toggle', $event->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="flex items-center text-sm font-medium transition {{ auth()->user()->favorites->contains($event->id) ? 'text-red-600 hover:text-red-800' : 'text-gray-500 hover:text-red-600' }}">
                                                <svg class="w-6 h-6 mr-2 {{ auth()->user()->favorites->contains($event->id) ? 'fill-current' : 'fill-none stroke-current' }}" viewBox="0 0 24 24" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                </svg>
                                                {{ auth()->user()->favorites->contains($event->id) ? 'Tersimpan di Favorit' : 'Simpan ke Favorit' }}
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth

                            <div class="flex items-center text-gray-600 mb-6">
                                <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="font-medium">{{ $event->location }}</span>
                            </div>

                            <hr class="border-gray-100 my-6">

                            <h3 class="font-bold text-lg mb-3 text-gray-900">Deskripsi Acara</h3>
                            <div class="prose text-gray-600 leading-relaxed">
                                {!! nl2br(e($event->description)) !!}
                            </div>
                            
                            <div class="mt-8 pt-6 border-t border-gray-100 flex items-center">
                                <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold mr-3">
                                    {{ substr($event->organizer->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Diselenggarakan oleh</p>
                                    <p class="font-bold text-gray-900">{{ $event->organizer->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-white shadow-sm sm:rounded-xl p-6 sticky top-24 border border-gray-100">
                        <h3 class="text-xl font-bold mb-6 text-gray-900 border-l-4 border-indigo-500 pl-3">Pilih Tiket</h3>
                        
                        @if(session('success'))
                            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 p-3 rounded-lg text-sm">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 p-3 rounded-lg text-sm">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="space-y-4">
                            @foreach($event->tickets as $ticket)
                                <div class="border border-gray-200 rounded-xl p-5 hover:border-indigo-300 hover:shadow-md transition bg-gray-50 relative overflow-hidden">
                                    <div class="absolute top-1/2 -left-2 w-4 h-4 bg-white rounded-full border-r border-gray-200 transform -translate-y-1/2"></div>
                                    <div class="absolute top-1/2 -right-2 w-4 h-4 bg-white rounded-full border-l border-gray-200 transform -translate-y-1/2"></div>

                                    <div class="flex justify-between items-start mb-3 pl-2">
                                        <div>
                                            <h4 class="font-bold text-lg text-gray-800">{{ $ticket->name }}</h4>
                                            <p class="text-xs text-gray-500 flex items-center mt-1">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                                                Sisa Kuota: <span class="font-semibold ml-1 {{ $ticket->quota < 10 ? 'text-red-600' : 'text-gray-700' }}">{{ $ticket->quota }}</span>
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <span class="block font-bold text-indigo-600 text-lg">Rp {{ number_format($ticket->price, 0, ',', '.') }}</span>
                                        </div>
                                    </div>

                                    @auth
                                        @if(auth()->user()->role == 'user')
                                            @if($ticket->quota > 0)
                                                <form action="{{ route('booking.store', $ticket->id) }}" method="POST" class="mt-4">
                                                    @csrf
                                                    <div class="flex space-x-2">
                                                        <input type="number" name="quantity" min="1" max="{{ $ticket->quota }}" value="1" class="w-20 rounded-lg border-gray-300 text-center focus:ring-indigo-500 focus:border-indigo-500 text-sm font-bold">
                                                        <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200 text-sm shadow-lg shadow-indigo-200">
                                                            Beli Tiket
                                                        </button>
                                                    </div>
                                                </form>
                                            @else
                                                <button disabled class="w-full mt-3 bg-gray-200 text-gray-400 font-bold py-2 px-4 rounded-lg cursor-not-allowed text-sm">
                                                    Habis Terjual
                                                </button>
                                            @endif
                                        @else
                                            <div class="mt-3 text-center text-xs text-gray-500 bg-gray-100 py-2 rounded">
                                                Login sebagai <b>User</b> untuk membeli.
                                            </div>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="block w-full text-center mt-3 bg-gray-900 text-white py-2.5 rounded-lg hover:bg-gray-800 transition text-sm font-bold">
                                            Login untuk Membeli
                                        </a>
                                    @endauth
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>