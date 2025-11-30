<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-black leading-tight tracking-tight">
                    User Management
                </h2>
                <p class="text-sm text-[#B8948C] mt-1">Kelola pengguna, organizer, dan admin.</p>
            </div>
            
            <div class="hidden md:flex gap-3">
                <div class="bg-white px-4 py-2 rounded-xl border border-[#B8948C]/20 shadow-sm flex items-center">
                    <div class="w-2 h-2 rounded-full bg-[#E73812] mr-2"></div>
                    <span class="text-xs font-bold text-black">{{ $users->count() }} Total Users</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-[#FAFAFA] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-r-xl shadow-sm flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-bold text-sm">{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            @endif

            <div class="bg-white shadow-2xl shadow-[#E73812]/20 sm:rounded-3xl border-2 border-[#E73812]/20 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-white uppercase bg-[#E73812]">
                            <tr>
                                <th class="px-8 py-5 tracking-wider font-bold rounded-tl-3xl">Nama</th>
                                <th class="px-6 py-5 tracking-wider font-bold">Email</th>
                                <th class="px-6 py-5 tracking-wider font-bold">Role</th>
                                <th class="px-6 py-5 text-center tracking-wider font-bold">Status</th>
                                <th class="px-6 py-5 text-center tracking-wider font-bold rounded-tr-3xl">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-[#B8948C]/10">
                            @forelse($users as $user)
                            <tr class="bg-white hover:bg-[#fff5f2] transition duration-200 group">

                                <td class="px-8 py-6">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-[#E73812]/20 border border-[#E73812] flex items-center justify-center text-[#E73812] font-bold mr-3">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <span class="font-bold text-black group-hover:text-[#E73812] transition">{{ $user->name }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-6 font-medium text-[#B8948C]">
                                    {{ $user->email }}
                                </td>

                                <td class="px-6 py-6 capitalize">
                                    @if($user->role === 'organizer')
                                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-[#E73812]/10 text-[#E73812] border border-[#E73812]/20">
                                            Organizer
                                        </span>
                                    @elseif($user->role === 'admin')
                                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-black text-white border border-black">
                                            Admin
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-gray-100 text-gray-600 border border-gray-200">
                                            User
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-6 text-center">
                                    @if($user->status == 'active')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">
                                            <span class="w-2 h-2 bg-green-500 rounded-full mr-1.5"></span> Active
                                        </span>
                                    @elseif($user->status == 'pending')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-[#F5CB49]/20 text-[#E08B36] border border-[#F5CB49]/50">
                                            <span class="w-2 h-2 bg-[#F5CB49] rounded-full mr-1.5 animate-pulse"></span> Pending
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-50 text-red-600 border border-red-200">
                                            Rejected
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-6 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        
                                        @if($user->role === 'organizer')
                                            @if($user->status !== 'active')
                                                <form action="{{ route('admin.users.approve', $user->id) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="p-2 rounded-lg text-green-600 hover:bg-green-50 border border-green-200 transition tooltip" title="Approve">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                    </button>
                                                </form>
                                            @endif

                                            @if($user->status !== 'rejected')
                                                <form action="{{ route('admin.users.reject', $user->id) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="p-2 rounded-lg text-[#E08B36] hover:bg-orange-50 border border-[#E08B36]/30 transition tooltip" title="Reject">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                                    </button>
                                                </form>
                                            @endif
                                        @endif

                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user ini permanen?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 rounded-lg text-red-500 hover:bg-red-50 border border-red-200 transition tooltip" title="Hapus">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-[#B8948C]">Tidak ada user lain.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>