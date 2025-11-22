<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Laporan Global (Admin)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-indigo-500">
                    <div class="text-gray-500 text-sm font-medium uppercase">Total Pendapatan</div>
                    <div class="mt-2 text-2xl font-bold text-gray-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-green-500">
                    <div class="text-gray-500 text-sm font-medium uppercase">Tiket Terjual</div>
                    <div class="mt-2 text-2xl font-bold text-gray-900">{{ $totalTicketsSold }}</div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-blue-500">
                    <div class="text-gray-500 text-sm font-medium uppercase">Total Event</div>
                    <div class="mt-2 text-2xl font-bold text-gray-900">{{ $totalEvents }}</div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-purple-500">
                    <div class="text-gray-500 text-sm font-medium uppercase">Total Organizer</div>
                    <div class="mt-2 text-2xl font-bold text-gray-900">{{ $totalOrganizers }}</div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 text-center text-gray-500">
                <p>Laporan ini mencakup seluruh data transaksi dan event di platform TicketIn.</p>
            </div>

        </div>
    </div>
</x-app-layout>