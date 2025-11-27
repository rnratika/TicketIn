<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-black leading-tight">
            {{ Auth::user()->role === 'admin' ? 'Admin: Buat Event Baru' : 'Buat Event Baru' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl shadow-[#B8948C]/5 sm:rounded-3xl border border-[#B8948C]/20 p-8">
                
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-600 p-4 rounded-xl text-sm font-medium">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ Auth::user()->role === 'admin' ? route('admin.events.store') : route('organizer.events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block font-bold text-sm text-black mb-2">Nama Event</label>
                            <input type="text" name="name" class="w-full rounded-xl border-[#B8948C]/30 shadow-sm focus:border-[#E73812] focus:ring-[#E73812] transition" placeholder="Contoh: Konser Musik 2024" required>
                        </div>
                        <div>
                            <label class="block font-bold text-sm text-black mb-2">Waktu Mulai</label>
                            <input type="datetime-local" name="start_time" class="w-full rounded-xl border-[#B8948C]/30 shadow-sm focus:border-[#E73812] focus:ring-[#E73812] transition" required>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block font-bold text-sm text-black mb-2">Lokasi</label>
                        <input type="text" name="location" class="w-full rounded-xl border-[#B8948C]/30 shadow-sm focus:border-[#E73812] focus:ring-[#E73812] transition" placeholder="Nama Gedung / Kota" required>
                    </div>

                    <div class="mb-6">
                        <label class="block font-bold text-sm text-black mb-2">Deskripsi</label>
                        <textarea name="description" rows="4" class="w-full rounded-xl border-[#B8948C]/30 shadow-sm focus:border-[#E73812] focus:ring-[#E73812] transition" placeholder="Jelaskan detail acara..." required></textarea>
                    </div>

                    <div class="mb-8">
                        <label class="block font-bold text-sm text-black mb-2">Gambar Banner</label>
                        <input type="file" name="image" class="block w-full text-sm text-[#B8948C] file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-[#fff5f2] file:text-[#E73812] hover:file:bg-[#E73812] hover:file:text-white transition cursor-pointer" accept="image/*">
                    </div>

                    <hr class="my-8 border-[#B8948C]/20">

                    <!-- Ticket Management -->
                    <h3 class="text-lg font-bold text-black mb-4 flex items-center gap-2">
                        <span class="w-2 h-6 bg-[#E73812] rounded-full"></span> Jenis Tiket
                    </h3>
                    
                    <div id="tickets-container" class="space-y-4">
                        <div class="ticket-row grid grid-cols-1 md:grid-cols-3 gap-4 p-5 bg-[#FAFAFA] rounded-2xl border border-[#B8948C]/20">
                            <div>
                                <label class="text-xs font-bold text-[#B8948C] uppercase tracking-wide mb-1 block">Nama Tiket</label>
                                <input type="text" name="tickets[0][name]" placeholder="e.g. VIP" class="w-full rounded-lg border-[#B8948C]/30 focus:border-[#E73812] focus:ring-[#E73812]" required>
                            </div>
                            <div>
                                <label class="text-xs font-bold text-[#B8948C] uppercase tracking-wide mb-1 block">Harga (Rp)</label>
                                <input type="number" name="tickets[0][price]" placeholder="0" class="w-full rounded-lg border-[#B8948C]/30 focus:border-[#E73812] focus:ring-[#E73812]" required>
                            </div>
                            <div>
                                <label class="text-xs font-bold text-[#B8948C] uppercase tracking-wide mb-1 block">Kuota</label>
                                <input type="number" name="tickets[0][quota]" placeholder="100" class="w-full rounded-lg border-[#B8948C]/30 focus:border-[#E73812] focus:ring-[#E73812]" required>
                            </div>
                        </div>
                    </div>

                    <button type="button" onclick="addTicketRow()" class="mt-4 text-sm text-[#E73812] hover:text-black font-bold flex items-center transition">
                        <span class="text-xl mr-1 font-extrabold">+</span> Tambah Jenis Tiket Lain
                    </button>

                    <div class="flex justify-end mt-8 pt-6 border-t border-[#B8948C]/20">
                        <a href="{{ Auth::user()->role === 'admin' ? route('admin.events.index') : route('organizer.events.index') }}" class="px-6 py-2.5 bg-white border border-[#B8948C]/30 text-[#B8948C] rounded-xl font-bold text-sm hover:bg-gray-50 mr-3 transition">Batal</a>
                        
                        <button type="submit" class="px-8 py-2.5 bg-[#E73812] text-white rounded-xl font-bold text-sm hover:bg-black transition shadow-lg shadow-red-100">
                            Simpan Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let ticketIndex = 1;
        function addTicketRow() {
            const container = document.getElementById('tickets-container');
            const html = `
                <div class="ticket-row grid grid-cols-1 md:grid-cols-3 gap-4 p-5 bg-[#FAFAFA] rounded-2xl border border-[#B8948C]/20">
                    <div><input type="text" name="tickets[${ticketIndex}][name]" placeholder="Nama Tiket" class="w-full rounded-lg border-[#B8948C]/30 focus:border-[#E73812] focus:ring-[#E73812]" required></div>
                    <div><input type="number" name="tickets[${ticketIndex}][price]" placeholder="Harga" class="w-full rounded-lg border-[#B8948C]/30 focus:border-[#E73812] focus:ring-[#E73812]" required></div>
                    <div><input type="number" name="tickets[${ticketIndex}][quota]" placeholder="Kuota" class="w-full rounded-lg border-[#B8948C]/30 focus:border-[#E73812] focus:ring-[#E73812]" required></div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
            ticketIndex++;
        }
    </script>
</x-app-layout>