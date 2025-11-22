<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Acara Favorit Saya
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded">{{ session('success') }}</div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($events as $event)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition">
                        <div class="h-48 bg-gray-200 relative">
                            @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" class="w-full h-full object-cover">
                            @else
                                <div class="flex items-center justify-center h-full text-gray-400">No Image</div>
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-lg mb-2">{{ $event->name }}</h3>
                            <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ $event->description }}</p>
                            
                            <div class="flex justify-between items-center mt-4 pt-4 border-t">
                                <a href="{{ route('events.show', $event->id) }}" class="text-indigo-600 font-medium text-sm hover:underline">Lihat Detail</a>
                                
                                <form action="{{ route('favorites.toggle', $event->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:text-red-800 p-2" title="Hapus Favorit">
                                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 text-gray-500">
                        Anda belum menyimpan acara favorit.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>