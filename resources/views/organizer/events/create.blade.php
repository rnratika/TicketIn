<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Event Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('organizer.events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Nama Event</label>
                            <input type="text" name="name" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1" required>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Waktu Mulai</label>
                            <input type="datetime-local" name="start_time" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1" required>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium text-sm text-gray-700">Lokasi</label>
                        <input type="text" name="location" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1" required>
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium text-sm text-gray-700">Deskripsi</label>
                        <textarea name="description" rows="4" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1" required></textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium text-sm text-gray-700">Gambar Banner</label>
                        <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" accept="image/*">
                    </div>

                    <hr class="my-6">

                    <h3 class="text-lg font-medium text-gray-900 mb-4">Jenis Tiket</h3>
                    
                    <div id="tickets-container">
                        <div class="ticket-row grid grid-cols-1 md:grid-cols-3 gap-4 mb-4 p-4 bg-gray-50 rounded">
                            <div>
                                <label class="text-xs">Nama Tiket (e.g. VIP)</label>
                                <input type="text" name="tickets[0][name]" class="border-gray-300 rounded-md w-full" required>
                            </div>
                            <div>
                                <label class="text-xs">Harga (Rp)</label>
                                <input type="number" name="tickets[0][price]" class="border-gray-300 rounded-md w-full" required>
                            </div>
                            <div>
                                <label class="text-xs">Kuota</label>
                                <input type="number" name="tickets[0][quota]" class="border-gray-300 rounded-md w-full" required>
                            </div>
                        </div>
                    </div>

                    <button type="button" onclick="addTicketRow()" class="text-sm text-indigo-600 hover:text-indigo-900 font-bold mb-6">+ Tambah Jenis Tiket Lain</button>

                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
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
                <div class="ticket-row grid grid-cols-1 md:grid-cols-3 gap-4 mb-4 p-4 bg-gray-50 rounded">
                    <div>
                        <input type="text" name="tickets[${ticketIndex}][name]" placeholder="Nama Tiket" class="border-gray-300 rounded-md w-full" required>
                    </div>
                    <div>
                        <input type="number" name="tickets[${ticketIndex}][price]" placeholder="Harga" class="border-gray-300 rounded-md w-full" required>
                    </div>
                    <div>
                        <input type="number" name="tickets[${ticketIndex}][quota]" placeholder="Kuota" class="border-gray-300 rounded-md w-full" required>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
            ticketIndex++;
        }
    </script>
</x-app-layout>