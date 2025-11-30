<x-app-layout>
    
    <div class="py-12 bg-[#FAFAFA] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                <div class="lg:col-span-7 flex flex-col gap-8">
                    <div class="pb-3">
                        <h1 class="text-5xl font-extrabold text-black tracking-tighter mb-7 leading-none">
                            {{ $event->name }}
                        </h1>

                        <div class="flex flex-wrap items-center gap-5">

                            <div class="flex items-center bg-white border-2 border-[#E73812]/20 px-4 py-2 rounded-full shadow-sm">
                                <svg class="w-5 h-5 text-[#E73812] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="text-sm font-bold text-gray-700">{{ $event->start_time->format('d M Y, H:i') }}</span>
                            </div>

                            <div class="flex items-center bg-white border-2 border-[#E73812]/20 px-4 py-2 rounded-full shadow-sm">
                                <svg class="w-5 h-5 text-[#E73812] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="text-sm font-bold text-gray-700">{{ $event->location }}</span>
                            </div>

                            <div class="flex items-center gap-2 ml-2 pl-4 border-l-2 border-[#E73812]/20">
                                <div class="w-8 h-8 rounded-full bg-[#E73812] flex items-center justify-center text-white font-bold text-sm">
                                    {{ substr($event->organizer->name, 0, 1) }}
                                </div>
                                <div class="flex flex-col justify-center">
                                    <span class="text-[10px] text-[#B8948C] font-bold tracking-widest leading-tight">Diselenggarakan oleh:</span>
                                    <span class="text-sm font-bold text-gray-700 leading-tight">{{ $event->organizer->name }}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-[#E73812]/10 border-2 border-[#E73812]/20">
                        <h3 class="text-xl font-bold text-black mb-4 border-l-4 border-[#E73812] pl-4 leading-none py-1">
                            Deskripsi Acara
                        </h3>
                        <div class="prose prose-base max-w-none text-gray-500 leading-relaxed pl-5">
                            {!! nl2br(e($event->description)) !!}
                        </div>
                    </div>
                    <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-[#E73812]/10 border-2 border-[#E73812]/20">
                        <div class="flex items-center justify-between mb-8 border-l-4 border-[#E73812] pl-4 py-1">
                            <h3 class="text-xl font-bold text-black leading-none">Ulasan Pelanggan</h3>
                            <div class="flex items-center gap-3">
                                <span class="bg-[#E73812] text-white text-sm px-3 py-1.5 rounded-lg font-bold flex items-center shadow-md">
                                    ★ {{ $event->average_rating ?? '0.0' }}
                                </span>
                                <span class="text-sm text-[#B8948C] font-medium">({{ $event->reviews->count() }} ulasan)</span>
                            </div>
                        </div>
                        @auth
                            @php
                                $userHasBooking = \App\Models\Booking::where('user_id', auth()->id())
                                    ->whereIn('ticket_id', $event->tickets->pluck('id'))
                                    ->where('status', 'approved')
                                    ->exists();
                                $userHasReviewed = $event->reviews->where('user_id', auth()->id())->isNotEmpty();
                            @endphp

                            @if($userHasBooking && !$userHasReviewed)
                                <div class="bg-[#FAFAFA] p-6 rounded-2xl border border-[#B8948C]/20 mb-8">
                                    <form action="{{ route('reviews.store', $event->id) }}" method="POST">
                                        @csrf
                                        <div class="flex gap-4 mb-4">
                                            <div class="flex flex-row-reverse justify-end gap-1">
                                                @for($i = 5; $i >= 1; $i--)
                                                    <input type="radio" id="star{{$i}}" name="rating" value="{{$i}}" class="peer hidden" required />
                                                    <label for="star{{$i}}" class="cursor-pointer text-gray-300 peer-checked:text-[#F5CB49] hover:text-[#F5CB49] peer-hover:text-[#F5CB49] transition">
                                                        <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                                    </label>
                                                @endfor
                                            </div>
                                        </div>
                                        <textarea name="comment" rows="3" class="w-full rounded-xl border-[#B8948C]/30 text-sm focus:border-[#E73812] focus:ring-[#E73812] placeholder:text-[#B8948C]/50 mb-4 shadow-sm bg-white" placeholder="Bagikan pengalaman seru Anda..." required></textarea>
                                        <button type="submit" class="bg-black text-white px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-[#E73812] transition shadow-lg">Kirim Ulasan</button>
                                    </form>
                                </div>
                            @endif
                        @endauth

                        <div class="space-y-6 pl-5">
                            @forelse($event->reviews->sortByDesc('created_at') as $review)
                                <div class="flex gap-4 pb-6 border-b border-[#B8948C]/10 last:border-0 last:pb-0">
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center font-bold text-sm text-black border border-[#B8948C]/20">
                                            {{ substr($review->user->name, 0, 1) }}
                                        </div>
                                    </div>
                                    <div class="flex-grow">
                                        <div class="flex items-center gap-3 mb-1">
                                            <h5 class="font-bold text-black text-sm">{{ $review->user->name }}</h5>
                                            <div class="flex text-[#F5CB49] text-xs">
                                                @for($j = 1; $j <= 5; $j++)
                                                    <span class="{{ $j <= $review->rating ? 'opacity-100' : 'opacity-20' }}">★</span>
                                                @endfor
                                            </div>
                                            <span class="text-xs text-[#B8948C] ml-auto">{{ $review->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-gray-500 text-sm leading-relaxed">{{ $review->comment }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="py-12 text-center border-2 border-dashed border-[#B8948C]/20 rounded-2xl bg-[#FAFAFA]">
                                    <p class="text-[#B8948C] text-sm font-medium">Belum ada ulasan untuk event ini.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-5 flex flex-col gap-8">
                    
                    <div class="rounded-[2rem] overflow-hidden shadow-xl shadow-[#E73812]/10 border-2 border-[#E73812]/20 relative group h-[300px] w-full">
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent opacity-80"></div>
                        @else
                            <div class="flex items-center justify-center h-full text-[#B8948C] bg-gray-200 font-bold text-lg">No Image</div>
                        @endif
                        <div class="absolute bottom-6 left-8 right-8 text-white">
                            <p class="text-[10px] font-bold uppercase tracking-widest opacity-90 mb-1 text-[#F5CB49]">Live in Concert</p>
                            <div class="flex items-end gap-3">
                                <span class="text-6xl font-extrabold text-white leading-none drop-shadow-md">{{ $event->start_time->format('d') }}</span>
                                <div class="flex flex-col pb-1.5">
                                    <span class="text-2xl font-bold uppercase leading-none tracking-wide">{{ $event->start_time->format('F') }}</span>
                                    <span class="text-lg font-medium opacity-80 leading-none mt-0.5">{{ $event->start_time->format('Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white shadow-xl shadow-[#E73812]/10 rounded-[2rem] p-7 border-2 border-[#E73812]/20 sticky top-20">
                        @php($eventHasPassed = $event->start_time->isPast())
                        <div class="flex items-center justify-between border-b border-[#B8948C]/10 pb-2">
                            <h3 class="text-2xl font-extrabold text-black">Pilih Tiket</h3>
                            @if($eventHasPassed)
                                <span class="bg-gray-100 text-gray-500 px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-gray-200">
                                    Event Selesai
                                </span>
                            @else
                                <span class="bg-[#fff5f2] text-[#E73812] px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-[#E73812]/10">
                                    Available
                                </span>
                            @endif
                        </div>
                        
                        @if(session('success')) 
                            <div class="mb-6 bg-green-50 text-green-700 p-4 rounded-xl text-xs font-bold text-center border border-green-200 shadow-sm">{{ session('success') }}</div> 
                        @endif
                        @if(session('error')) 
                            <div class="mb-6 bg-red-50 text-red-700 p-4 rounded-xl text-xs font-bold text-center border border-red-200 shadow-sm">{{ session('error') }}</div> 
                        @endif

                        <div class="space-y-5">
                            @foreach($event->tickets as $ticket)
                                <div class="group border border-[#B8948C]/20 rounded-2xl p-6 hover:border-[#E73812] hover:bg-[#fff5f2] transition bg-[#FAFAFA] relative overflow-hidden">
                                    <div class="flex justify-between items-center mb-4 relative z-10">
                                        <div>
                                            <h4 class="font-bold text-lg text-black group-hover:text-[#E73812] transition">{{ $ticket->name }}</h4>
                                            <p class="text-xs text-[#B8948C] font-bold uppercase mt-1 tracking-wide">Sisa: <span class="{{ $ticket->quota < 10 ? 'text-red-500' : 'text-black' }}">{{ $ticket->quota }}</span></p>
                                        </div>
                                        <div class="text-right">
                                            <span class="block font-bold text-[#E73812] text-xl">
                                                {{ $ticket->price == 0 ? 'FREE' : 'Rp '.number_format($ticket->price/1000, 0, ',', '.').'k' }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    @auth
                                        @if(auth()->user()->role == 'user')
                                            @if($eventHasPassed)
                                                <button disabled class="w-full bg-gray-200 text-gray-400 font-bold py-3 rounded-xl cursor-not-allowed text-sm">
                                                    Event Telah Berakhir
                                                </button>
                                            @elseif($ticket->quota > 0)
                                                <form action="{{ route('booking.store', $ticket->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button type="submit" class="w-full bg-[#E73812] hover:bg-black text-white font-bold py-3 rounded-xl transition duration-300 text-sm shadow-md hover:shadow-lg transform active:scale-95">
                                                        Beli Tiket
                                                    </button>
                                                </form>
                                            @else
                                                <button disabled class="w-full bg-gray-200 text-gray-500 font-bold py-3 rounded-xl cursor-not-allowed text-sm">
                                                    Habis Terjual
                                                </button>
                                            @endif
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="block w-full text-center bg-[#E73812] text-white py-3 rounded-xl hover:bg-black transition text-sm font-bold shadow-md hover:shadow-lg transform active:scale-95">
                                            Login untuk Membeli
                                        </a>
                                    @endauth
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @auth
                        @if(auth()->user()->role === 'user')
                            <form action="{{ route('favorites.toggle', $event->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center justify-center gap-2 text-sm font-bold transition py-4 rounded-2xl border 
                                    {{ auth()->user()->favorites->contains($event->id) ? 'bg-[#fff5f2] border-[#E73812] text-[#E73812]' : 'bg-white border-[#E73812] text-[#E73812] hover:text-black hover:border-black' }}">
                                    <svg class="w-5 h-5 {{ auth()->user()->favorites->contains($event->id) ? 'fill-current' : 'fill-none stroke-current' }}" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                    {{ auth()->user()->favorites->contains($event->id) ? 'Tersimpan di Favorit' : 'Simpan ke Favorit' }}
                                </button>
                            </form>
                        @endif
                    @endauth

                </div>

            </div>
        </div>
    </div>
</x-app-layout>