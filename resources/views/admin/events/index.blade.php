<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin: Manage All Events
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-xl p-6">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-3">Event</th>
                            <th class="px-6 py-3">Organizer (Pemilik)</th>
                            <th class="px-6 py-3">Tanggal</th>
                            <th class="px-6 py-3">Lokasi</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $event)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $event->name }}</td>
                            <td class="px-6 py-4">
                                <span class="bg-indigo-100 text-indigo-800 text-xs font-bold px-2 py-1 rounded">
                                    {{ $event->organizer->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $event->start_time->format('d M Y') }}</td>
                            <td class="px-6 py-4">{{ $event->location }}</td>
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Admin: Hapus event ini secara paksa?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-bold border border-red-200 bg-red-50 px-3 py-1 rounded hover:bg-red-100">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center py-8">Tidak ada event di sistem.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>