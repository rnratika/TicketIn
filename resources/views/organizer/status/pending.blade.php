<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Status Akun
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                <div class="mb-4">
                    <svg class="mx-auto h-16 w-16 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Akun Anda Sedang Ditinjau</h3>
                <p class="text-gray-600 mb-6">
                    Terima kasih telah mendaftar sebagai Event Organizer di TicketIn.<br>
                    Admin kami sedang memverifikasi data Anda. Silakan cek kembali secara berkala.
                </p>
                <div class="inline-block bg-yellow-50 border border-yellow-200 rounded-xl p-3 text-sm text-yellow-800">
                    Status saat ini: <strong>PENDING</strong>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>