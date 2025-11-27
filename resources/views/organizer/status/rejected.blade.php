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
                    <svg class="mx-auto h-16 w-16 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Permohonan Ditolak</h3>
                <p class="text-gray-600 mb-6">
                    Mohon maaf, akun Event Organizer Anda tidak dapat disetujui oleh Admin.<br>
                    Silakan hapus akun ini dan daftar kembali jika ada kesalahan data.
                </p>
                
                <form action="{{ route('organizer.deleteAccount') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini permanen?');">
                    @csrf
                    <button type="submit" class="bg-red-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-red-700 transition">
                        Hapus Akun Saya
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>