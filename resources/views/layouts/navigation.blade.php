<div class="w-full bg-white sticky top-0 z-50">
<nav x-data="{ open: false }" class="glass-nav transition-all duration-300 shadow-[0_1px_10px_#B8948C]">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <!-- Logo & Brand -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-1 group">
                    <!-- Icon Abstrak -->
                    <div class="w-9 h-9 rounded-xl bg-[#E73812] flex items-center justify-center text-white shadow-lg shadow-[#E73812]/40 group-hover:rotate-12 group-hover:scale-110 transition duration-500 ease-out">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                    </div>
                    <!-- Typography -->
                    <span class="text-3xl font-extrabold tracking-tighter ml-2">
                        <span class="text-[#E73812]">Ticket</span><span class="text-black">In</span><span class="text-black">.</span>
                    </span>
                </a>
                
                <!-- Desktop Menu -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-12 sm:flex h-full items-center">
                    @auth
                        {{-- REVISI: Dashboard Link hanya muncul untuk User Regular --}}
                        @if(Auth::user()->role === 'user')
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-[#B8948C] hover:text-[#E73812] font-semibold transition text-base">
                                Dashboard
                            </x-nav-link>
                        @endif

                        @if(Auth::user()->role === 'admin')
                            <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')" class="text-[#B8948C] hover:text-[#E73812]">Users</x-nav-link>
                            <x-nav-link :href="route('admin.events.index')" :active="request()->routeIs('admin.events.*')" class="text-[#B8948C] hover:text-[#E73812]">Events</x-nav-link>
                            <x-nav-link :href="route('admin.reports.index')" :active="request()->routeIs('admin.reports.*')" class="text-[#B8948C] hover:text-[#E73812]">Reports</x-nav-link>
                        @endif

                        @if(Auth::user()->role === 'organizer')
                            <x-nav-link :href="route('organizer.events.index')" :active="request()->routeIs('organizer.events.*')" class="text-[#B8948C] hover:text-[#E73812]">My Events</x-nav-link>
                            <x-nav-link :href="route('organizer.reports.index')" :active="request()->routeIs('organizer.reports.*')" class="text-[#B8948C] hover:text-[#E73812]">Sales</x-nav-link>
                        @endif

                        @if(Auth::user()->role === 'user')
                            <x-nav-link :href="route('booking.history')" :active="request()->routeIs('booking.history')" class="text-[#B8948C] hover:text-[#E73812]">My Tickets</x-nav-link>
                            <x-nav-link :href="route('favorites.index')" :active="request()->routeIs('favorites.index')" class="text-[#B8948C] hover:text-[#E73812]">Favorites</x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Right Side (Profile/Auth) -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <!-- Dropdown Manual Alpine.js -->
                    <div class="relative" x-data="{ dropdownOpen: false }">
                        <button @click="dropdownOpen = ! dropdownOpen" 
                                class="flex items-center gap-3 pl-2 pr-2 py-2 rounded-full bg-white border border-transparent hover:border-[#E73812]/50 hover:bg-white/80 transition-all duration-300"
                                :class="{ 'border-[#E73812]/50 bg-white/80': dropdownOpen }">
                            <div class="w-6 h-6 rounded-full bg-[#E73812] flex items-center justify-center text-white font-medium text-xs uppercase">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="text-sm font-semibold text-black">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-[#B8948C] transition-transform duration-300" :class="{ 'rotate-180': dropdownOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <!-- Dropdown Content -->
                        <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-cloak
                             class="absolute right-0 z-50 mt-2 w-48 bg-white rounded-xl shadow-2xl border border-[#B8948C]/20 py-2 origin-top-right"
                             x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
                            
                            {{-- <div class="px-4 py-3 border-b border-gray-100 mb-1">
                                <p class="text-sm font-semibold text-black truncate">{{ Auth::user()->email }}</p>
                            </div> --}}

                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-[#E73812]/10 hover:text-[#E73812] transition">Profile Settings</a>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-500/10 transition">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="flex items-center gap-4">
                        <a href="{{ route('login') }}" class="text-sm font-bold text-black hover:text-[#E73812] transition">Log in</a>
                        <a href="{{ route('register') }}" class="px-6 py-2.5 bg-[#E73812] text-white text-sm font-bold rounded-full hover:bg-black hover:shadow-lg hover:shadow-orange-200 transition duration-300">Get Started</a>
                    </div>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-[#B8948C] hover:text-[#E73812] hover:bg-orange-50 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
   <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-[#B8948C]/20">
        <div class="pt-2 pb-3 space-y-1 px-4">
            @auth
                {{-- REVISI: Dashboard Link Mobile --}}
                @if(Auth::user()->role === 'user')
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Dashboard</x-responsive-nav-link>
                @endif
                
                @if(Auth::user()->role === 'admin')
                    <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">Users</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.events.index')" :active="request()->routeIs('admin.events.*')">Events</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.reports.index')" :active="request()->routeIs('admin.reports.*')">Reports</x-responsive-nav-link>
                @endif

                @if(Auth::user()->role === 'organizer')
                    <x-responsive-nav-link :href="route('organizer.events.index')" :active="request()->routeIs('organizer.events.*')">My Events</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('organizer.reports.index')" :active="request()->routeIs('organizer.reports.*')">Sales</x-responsive-nav-link>
                @endif

                @if(Auth::user()->role === 'user')
                    <x-responsive-nav-link :href="route('booking.history')" :active="request()->routeIs('booking.history')">My Tickets</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('favorites.index')" :active="request()->routeIs('favorites.index')">Favorites</x-responsive-nav-link>
                @endif

                <div class="border-t border-[#B8948C]/10 pt-2 mt-2">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left py-2 text-base font-medium text-red-500 pl-3 pr-4 border-l-4 border-transparent">Log Out</button>
                    </form>
                </div>
            @else
                <x-responsive-nav-link :href="route('login')">Log in</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')">Register</x-responsive-nav-link>
            @endauth
        </div>
    </div>
</nav>
</div>