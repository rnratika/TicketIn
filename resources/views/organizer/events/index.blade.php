<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manajemen Acara
            </h2>
            <a href="{{ route('organizer.events.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold py-2 px-4 rounded-lg shadow transition">
                + Buat Event Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                                <tr>
                                    <th class="px-6 py-3">Nama Event</th>
                                    <th class="px-6 py-3">Tanggal</th>
                                    <th class="px-6 py-3">Lokasi</th>
                                    <th class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($events as $event)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        <div class="flex items-center">
                                            @if($event->image)
                                                <img class="w-10 h-10 rounded object-cover mr-3" src="{{ asset('storage/' . $event->image) }}">
                                            @else
                                                <div class="w-10 h-10 rounded bg-gray-200 mr-3"></div>
                                            @endif
                                            {{ $event->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $event->start_time->format('d M Y, H:i') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $event->location }}
                                    </td>
                                    <td class="px-6 py-4 text-center space-x-2">
                                        <a href="{{ route('organizer.events.edit', $event->id) }}" class="font-medium text-blue-600 hover:underline">Edit</a>
                                        <form action="{{ route('organizer.events.destroy', $event->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus event ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="font-medium text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-8">Belum ada event yang dibuat.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>