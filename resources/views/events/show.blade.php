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

                            <hr class="border-gray-100 my-8">

                            <div>
                                <h3 class="font-bold text-xl mb-6 text-gray-900 flex items-center">
                                    Ulasan Pengunjung
                                    <span class="ml-3 bg-yellow-100 text-yellow-700 text-sm px-3 py-1 rounded-full flex items-center">
                                        <svg class="w-4 h-4 mr-1 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                        {{ $event->average_rating ?? '0.0' }} / 5.0
                                    </span>
                                    <span class="ml-2 text-sm text-gray-400 font-normal">({{ $event->reviews->count() }} ulasan)</span>
                                </h3>

                                @auth
                                    @php
                                        // Cek Booking Approved
                                        $userHasBooking = \App\Models\Booking::where('user_id', auth()->id())
                                            ->whereIn('ticket_id', $event->tickets->pluck('id'))
                                            ->where('status', 'approved')
                                            ->exists();
                                        
                                        // Cek Sudah Review Belum
                                        $userHasReviewed = $event->reviews->where('user_id', auth()->id())->isNotEmpty();
                                    @endphp

                                    @if($userHasBooking && !$userHasReviewed)
                                        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 mb-8">
                                            <h4 class="font-bold text-gray-800 mb-4">Tulis Pengalaman Anda</h4>
                                            <form action="{{ route('reviews.store', $event->id) }}" method="POST">
                                                @csrf
                                                
                                                <div class="mb-4">
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                                                    <div class="flex flex-row-reverse justify-end gap-1">
                                                        @for($i = 5; $i >= 1; $i--)
                                                            <input type="radio" id="star{{$i}}" name="rating" value="{{$i}}" class="peer hidden" required />
                                                            <label for="star{{$i}}" class="cursor-pointer text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-400 peer-hover:text-yellow-400 transition">
                                                                <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                                            </label>
                                                        @endfor
                                                    </div>
                                                </div>

                                                <div class="mb-4">
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Komentar</label>
                                                    <textarea name="comment" rows="3" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Bagaimana keseruan acaranya? Ceritakan disini..." required></textarea>
                                                </div>

                                                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-bold text-sm hover:bg-indigo-700 transition">
                                                    Kirim Ulasan
                                                </button>
                                            </form>
                                        </div>
                                    @elseif($userHasReviewed)
                                        <div class="bg-green-50 text-green-700 p-4 rounded-lg mb-8 text-sm font-medium border border-green-200">
                                            Terima kasih! Anda sudah memberikan ulasan untuk acara ini.
                                        </div>
                                    @endif
                                @endauth

                                <div class="space-y-6">
                                    @forelse($event->reviews->sortByDesc('created_at') as $review)
                                        <div class="flex space-x-4">
                                            <div class="flex-shrink-0">
                                                <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center font-bold text-gray-500 uppercase">
                                                    {{ substr($review->user->name, 0, 1) }}
                                                </div>
                                            </div>
                                            <div class="flex-grow">
                                                <div class="flex items-center justify-between mb-1">
                                                    <h5 class="font-bold text-gray-900">{{ $review->user->name }}</h5>
                                                    <span class="text-xs text-gray-400">{{ $review->created_at->diffForHumans() }}</span>
                                                </div>
                                                <div class="flex text-yellow-400 mb-2">
                                                    @for($j = 1; $j <= 5; $j++)
                                                        <svg class="w-4 h-4 {{ $j <= $review->rating ? 'fill-current' : 'text-gray-300 fill-current' }}" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                                    @endfor
                                                </div>
                                                <p class="text-gray-600 text-sm leading-relaxed">{{ $review->comment }}</p>
                                            </div>
                                        </div>
                                        @if(!$loop->last) <hr class="border-gray-50"> @endif
                                    @empty
                                        <p class="text-gray-500 italic">Belum ada ulasan untuk acara ini.</p>
                                    @endforelse
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