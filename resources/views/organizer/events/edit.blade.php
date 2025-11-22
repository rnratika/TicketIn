<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Event: {{ $event->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-xl p-6">
                <form action="{{ route('organizer.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block font-medium text-sm text-gray-700 mb-1">Nama Event</label>
                            <input type="text" name="name" value="{{ old('name', $event->name) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700 mb-1">Waktu Mulai</label>
                            <input type="datetime-local" name="start_time" value="{{ old('start_time', $event->start_time->format('Y-m-d\TH:i')) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium text-sm text-gray-700 mb-1">Lokasi</label>
                        <input type="text" name="location" value="{{ old('location', $event->location) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium text-sm text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" rows="5" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('description', $event->description) }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium text-sm text-gray-700 mb-2">Gambar Saat Ini</label>
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" class="h-32 w-auto rounded mb-2 object-cover">
                        @endif
                        <label class="block font-medium text-xs text-gray-500 mb-1">Ganti Gambar (Opsional)</label>
                        <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('organizer.events.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md text-sm font-medium hover:bg-gray-300">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700 shadow">Update Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>