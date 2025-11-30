<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-black leading-tight tracking-tight">
                    Acara Favorit Saya
                </h2>
                <p class="text-sm text-[#B8948C] mt-1">Daftar event yang telah Anda simpan.</p>
            </div>

            <div class="hidden md:flex gap-3">
                <div class="bg-white px-4 py-2 rounded-xl border border-[#B8948C]/20 shadow-sm flex items-center">
                    <div class="w-2 h-2 rounded-full bg-[#E73812] mr-2 animate-pulse"></div>
                    <span class="text-xs font-bold text-black">{{ $events->count() }} Disimpan</span>
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

            <div class="bg-white shadow-2xl shadow-[#E73812]/20 sm:rounded-3xl border-2 border-[#E73812]/20 overflow-hidden">
                
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-white uppercase bg-[#E73812]">
                            <tr>
                                <th class="px-8 py-5 tracking-wider font-bold rounded-tl-3xl">Event Detail</th>
                                <th class="px-6 py-5 tracking-wider font-bold">Jadwal</th>
                                <th class="px-6 py-5 tracking-wider font-bold">Lokasi</th>
                                <th class="px-6 py-5 text-center tracking-wider font-bold rounded-tr-3xl">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-[#B8948C]/10">
                            @forelse($events as $event)
                            <tr class="bg-white hover:bg-[#fff5f2] transition duration-200 group">

                                <td class="px-8 py-6">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-16 w-16 relative overflow-hidden rounded-xl border border-[#B8948C]/20 shadow-sm group-hover:shadow-md transition">
                                            @if($event->image)
                                                <img class="h-full w-full object-cover transform group-hover:scale-110 transition duration-500" src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}">
                                            @else
                                                <div class="h-full w-full bg-gray-100 flex items-center justify-center text-[#B8948C] font-bold text-xs">IMG</div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <a href="{{ route('events.show', $event->id) }}" class="text-base font-bold text-black group-hover:text-[#E73812] transition hover:underline line-clamp-1">
                                                {{ $event->name }}
                                            </a>
                                            <div class="flex items-center mt-1">
                                                <div class="w-5 h-5 rounded-full bg-black text-white flex items-center justify-center text-[10px] font-bold mr-1.5">
                                                    {{ substr($event->organizer->name, 0, 1) }}
                                                </div>
                                                <span class="text-xs text-[#B8948C] font-medium">{{ $event->organizer->name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-6">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-black">{{ $event->start_time->format('d M Y') }}</span>
                                        <span class="text-xs text-[#B8948C] font-medium">{{ $event->start_time->format('H:i') }} WIB</span>
                                    </div>
                                </td>

                                <td class="px-6 py-6">
                                    <div class="flex items-center text-sm font-medium text-black">
                                        <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-[#E73812]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        {{ $event->location }}
                                    </div>
                                </td>

                                <td class="px-6 py-6 text-center">
                                    <div class="flex items-center justify-center space-x-3">
                                        <a href="{{ route('events.show', $event->id) }}" class="p-2 rounded-lg text-[#E73812] hover:bg-[#E73812] hover:text-white border border-[#E73812]/30 transition tooltip group/btn" title="Lihat Detail">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </a>

                                        <form action="{{ route('favorites.toggle', $event->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="p-2 rounded-lg text-red-500 hover:bg-red-500 hover:text-white border border-red-200 transition tooltip group/btn" title="Hapus dari Favorit">
                                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty

                            <tr>
                                <td colspan="4" class="px-6 py-24 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-24 h-24 bg-[#FAFAFA] rounded-full flex items-center justify-center mb-6 border-2 border-dashed border-[#B8948C]/30 group hover:border-[#E73812] transition">
                                            <svg class="w-10 h-10 text-[#B8948C] group-hover:text-[#E73812] transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                        </div>
                                        <h3 class="text-xl font-bold text-black">Belum ada favorit</h3>
                                        <p class="text-[#B8948C] text-sm mt-2 mb-8 max-w-md mx-auto">Simpan event yang Anda sukai agar mudah ditemukan nanti.</p>
                                        <a href="{{ route('home') }}" class="bg-[#E73812] hover:bg-black text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-red-200 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex items-center">
                                            Jelajahi Event <span class="ml-2">&rarr;</span>
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