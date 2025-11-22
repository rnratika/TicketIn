<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Laporan Penjualan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-xl p-6">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 rounded-lg">
                        <tr>
                            <th class="px-6 py-3 rounded-l-lg">Event</th>
                            <th class="px-6 py-3 text-center">Tiket Terjual</th>
                            <th class="px-6 py-3 text-right rounded-r-lg">Total Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stats as $stat)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $stat['event_name'] }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2.5 py-0.5 rounded">
                                    {{ $stat['total_tickets_sold'] }} Sold
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-indigo-600">
                                Rp {{ number_format($stat['total_revenue'], 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center py-6">Belum ada data penjualan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>