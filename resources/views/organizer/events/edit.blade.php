<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-black leading-tight">Edit Event: {{ $event->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl shadow-[#B8948C]/5 sm:rounded-3xl border border-[#B8948C]/20 p-8">
                <form action="{{ route('organizer.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block font-bold text-sm text-black mb-2">Nama Event</label>
                            <input type="text" name="name" value="{{ old('name', $event->name) }}" class="w-full rounded-xl border-[#B8948C]/30 shadow-sm focus:border-[#E73812] focus:ring-[#E73812]" required>
                        </div>
                        <div>
                            <label class="block font-bold text-sm text-black mb-2">Waktu Mulai</label>
                            <input type="datetime-local" name="start_time" value="{{ old('start_time', $event->start_time->format('Y-m-d\TH:i')) }}" class="w-full rounded-xl border-[#B8948C]/30 shadow-sm focus:border-[#E73812] focus:ring-[#E73812]" required>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block font-bold text-sm text-black mb-2">Lokasi</label>
                        <input type="text" name="location" value="{{ old('location', $event->location) }}" class="w-full rounded-xl border-[#B8948C]/30 shadow-sm focus:border-[#E73812] focus:ring-[#E73812]" required>
                    </div>

                    <div class="mb-6">
                        <label class="block font-bold text-sm text-black mb-2">Deskripsi</label>
                        <textarea name="description" rows="5" class="w-full rounded-xl border-[#B8948C]/30 shadow-sm focus:border-[#E73812] focus:ring-[#E73812]" required>{{ old('description', $event->description) }}</textarea>
                    </div>

                    <div class="mb-8">
                        <label class="block font-bold text-sm text-black mb-2">Gambar Saat Ini</label>
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" class="h-40 w-auto rounded-xl mb-4 object-cover border border-[#B8948C]/20 shadow-sm">
                        @endif
                        <label class="block font-bold text-xs text-[#B8948C] mb-2 uppercase tracking-wide">Ganti Gambar (Opsional)</label>
                        <input type="file" name="image" class="block w-full text-sm text-[#B8948C] file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-[#fff5f2] file:text-[#E73812] hover:file:bg-[#E73812] hover:file:text-white transition cursor-pointer">
                    </div>

                    <div class="flex justify-end space-x-3 pt-6 border-t border-[#B8948C]/20">
                        <a href="{{ route('organizer.events.index') }}" class="px-6 py-2.5 bg-white border border-[#B8948C]/30 text-[#B8948C] rounded-xl font-bold text-sm hover:bg-gray-50 transition">Batal</a>
                        <button type="submit" class="px-8 py-2.5 bg-[#E73812] text-white rounded-xl font-bold text-sm hover:bg-black transition shadow-lg shadow-red-100">Update Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>