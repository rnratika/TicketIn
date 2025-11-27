<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-black leading-tight tracking-tight">
            Admin: Manage All Events
        </h2>
    </x-slot>

    <div class="py-12 bg-[#FAFAFA] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Success Message -->
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

            <!-- ACTION BAR (TOMBOL CREATE) -->
            <div class="flex flex-col md:flex-row justify-between items-end md:items-center mb-6 gap-4">
                <div>
                    <h3 class="text-lg font-bold text-black">Daftar Semua Event</h3>
                    <p class="text-sm text-[#B8948C]">Kelola dan pantau seluruh event yang terdaftar di platform.</p>
                </div>
                
                <a href="{{ route('admin.events.create') }}" class="group bg-[#E73812] hover:bg-black text-white text-sm font-bold py-3 px-6 rounded-xl shadow-lg shadow-red-200 hover:shadow-xl transition-all duration-300 flex items-center transform hover:-translate-y-0.5">
                    <span class="bg-white/20 p-1 rounded-lg mr-2 group-hover:rotate-90 transition duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                    </span>
                    Buat Event (Admin)
                </a>
            </div>

            <!-- Content Card -->
            <div class="bg-white shadow-2xl shadow-[#E73812]/20 sm:rounded-3xl border-2 border-[#E73812]/20 overflow-hidden">
                
                <!-- Table Container -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <!-- Table Header -->
                        <thead class="text-xs text-white uppercase bg-[#E73812]">
                            <tr>
                                <th class="px-8 py-5 tracking-wider font-bold">Event</th>
                                <th class="px-6 py-5 tracking-wider font-bold">Organizer</th>
                                <th class="px-6 py-5 tracking-wider font-bold">Jadwal</th>
                                <th class="px-6 py-5 tracking-wider font-bold">Lokasi</th>
                                <th class="px-6 py-5 text-center tracking-wider font-bold">Aksi</th>
                            </tr>
                        </thead>
                        
                        <!-- Table Body -->
                        <tbody class="divide-y divide-[#B8948C]/10">
                            @forelse($events as $event)
                            <tr class="bg-white hover:bg-[#fff5f2] transition duration-200 group">
                                
                                <!-- Column: Event Name & Image -->
                                <td class="px-8 py-6">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-12 w-12 relative overflow-hidden rounded-xl border border-[#B8948C]/20 shadow-sm group-hover:shadow-md transition">
                                            @if($event->image)
                                                <img class="h-full w-full object-cover transform group-hover:scale-110 transition duration-500" src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}">
                                            @else
                                                <div class="h-full w-full bg-gray-100 flex items-center justify-center text-[#B8948C] font-bold text-xs">IMG</div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-base font-bold text-black group-hover:text-[#E73812] transition">{{ $event->name }}</div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Column: Organizer -->
                                <td class="px-6 py-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-[#E73812]/10 text-[#E73812] border border-[#E73812]/20">
                                        {{ $event->organizer->name }}
                                    </span>
                                </td>

                                <!-- Column: Date -->
                                <td class="px-6 py-6">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-black">{{ $event->start_time->format('d M Y') }}</span>
                                        <span class="text-xs text-[#B8948C] font-medium">{{ $event->start_time->format('H:i') }} WIB</span>
                                    </div>
                                </td>

                                <!-- Column: Location -->
                                <td class="px-6 py-6">
                                    <div class="flex items-center text-sm font-medium text-black">
                                        <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-[#E73812]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        {{ $event->location }}
                                    </div>
                                </td>

                                <!-- Column: Actions -->
                                <td class="px-6 py-6 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        
                                        <!-- TOMBOL EDIT (Ditambahkan agar Admin bisa Memperbarui) -->
                                        <a href="{{ route('admin.events.edit', $event->id) }}" class="p-2 rounded-lg text-[#E08B36] hover:bg-[#E08B36] hover:text-white border border-[#E08B36]/30 transition tooltip flex items-center justify-center" title="Edit Event">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>

                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Admin: Hapus event ini secara paksa?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 rounded-lg text-red-500 hover:bg-red-500 hover:text-white border border-red-200 transition tooltip flex items-center justify-center" title="Hapus Paksa">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <!-- Empty State -->
                            <tr>
                                <td colspan="5" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-20 h-20 bg-[#FAFAFA] rounded-full flex items-center justify-center mb-4 border-2 border-dashed border-[#B8948C]/30">
                                            <svg class="w-10 h-10 text-[#B8948C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <h3 class="text-lg font-bold text-black">Belum ada event</h3>
                                        <p class="text-[#B8948C] text-sm mt-1 mb-6">Tidak ada event yang terdaftar di sistem.</p>
                                        <a href="{{ route('admin.events.create') }}" class="text-[#E73812] font-bold hover:underline flex items-center">
                                            Buat Event (Admin) &rarr;
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