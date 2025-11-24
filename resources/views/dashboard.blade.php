<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-black leading-tight tracking-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#FAFAFA] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Welcome Banner -->
            <!-- Style disamakan dengan nuansa premium: Gradient Gelap + Aksen Merah -->
            <div class="bg-gradient-to-r from-[#E73812] to-[#F5CB49] rounded-3xl p-10 text-white shadow-2xl shadow-[#E73812]/30 mb-10 relative overflow-hidden border border-[#B8948C]/10">
                <div class="relative z-10">
                    <h3 class="text-4xl font-bold mb-2 tracking-tight">Halo, {{ Auth::user()->name }}!</h3>
                    <p class="text-white font-medium text-lg">Selamat datang kembali di TicketIn.</p>
                </div>
                
                <!-- Dekorasi Background -->
                <div class="absolute right-0 top-0 h-full w-1/2 bg-gradient-to-l from-[#E73812]/20 to-transparent pointer-events-none"></div>
                <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-[#F5CB49] rounded-full blur-3xl opacity-5 pointer-events-none"></div>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- Card 1: Role -->
                <div class="bg-white p-8 rounded-3xl shadow-xl shadow-[#B8948C]/5 border border-[#B8948C]/20 hover:shadow-2xl transition duration-300 group relative overflow-hidden">
                    <div class="flex items-center justify-between mb-6 relative z-10">
                        <h4 class="text-[#B8948C] font-bold text-xs uppercase tracking-widest">Role Anda</h4>
                        <div class="w-12 h-12 rounded-2xl bg-[#FAFAFA] flex items-center justify-center text-[#E73812] border border-[#B8948C]/10 group-hover:scale-110 group-hover:bg-black group-hover:text-white transition duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                    </div>
                    <div class="relative z-10">
                        <span class="inline-block bg-black text-white px-4 py-1.5 rounded-lg text-sm font-bold shadow-md mb-2 capitalize group-hover:bg-[#E73812] transition duration-300">
                            {{ Auth::user()->role }}
                        </span>
                        <p class="text-sm text-[#B8948C] mt-2 font-medium">Akses penuh sesuai peran.</p>
                    </div>
                </div>

                <!-- Card 2: Status -->
                <div class="bg-white p-8 rounded-3xl shadow-xl shadow-[#B8948C]/5 border border-[#B8948C]/20 hover:shadow-2xl transition duration-300 group relative overflow-hidden">
                    <div class="flex items-center justify-between mb-6 relative z-10">
                        <h4 class="text-[#B8948C] font-bold text-xs uppercase tracking-widest">Status Akun</h4>
                        <div class="w-12 h-12 rounded-2xl bg-[#FAFAFA] flex items-center justify-center text-green-600 border border-[#B8948C]/10 group-hover:scale-110 group-hover:bg-green-600 group-hover:text-white transition duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <div class="relative z-10">
                        <span class="inline-block bg-green-100 text-green-700 px-4 py-1.5 rounded-lg text-sm font-bold border border-green-200 capitalize">
                            {{ Auth::user()->status }}
                        </span>
                        <p class="text-sm text-[#B8948C] mt-2 font-medium">Akun Anda dalam keadaan baik.</p>
                    </div>
                </div>

                <!-- Card 3: Settings (Action) -->
                <a href="{{ route('profile.edit') }}" class="group bg-white p-8 rounded-3xl shadow-xl shadow-[#B8948C]/5 border border-[#B8948C]/20 hover:border-[#E73812] transition duration-300 cursor-pointer relative overflow-hidden">
                    <!-- Dekorasi Hover -->
                    <div class="absolute top-0 right-0 w-24 h-24 bg-[#E73812]/5 rounded-3x1 transition duration-500 group-hover:bg-[#E73812]/10"></div>
                    
                    <div class="flex items-center justify-between mb-6 relative z-10">
                        <h4 class="text-[#B8948C] font-bold text-xs uppercase tracking-widest group-hover:text-[#E73812] transition">Pengaturan</h4>
                        <div class="w-12 h-12 rounded-2xl bg-black text-white flex items-center justify-center group-hover:bg-[#E73812] transition duration-300 shadow-lg group-hover:shadow-orange-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                    </div>
                    
                    <div class="relative z-10">
                        <h3 class="text-2xl font-bold text-black group-hover:text-[#E73812] transition mb-1">Edit Profil</h3>
                        <p class="text-sm text-[#B8948C] flex items-center font-medium">
                            Kelola informasi akun 
                            <span class="ml-2 transform group-hover:translate-x-2 transition duration-300 text-[#E73812] text-lg">&rarr;</span>
                        </p>
                    </div>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>