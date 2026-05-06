<!-- Script Alpine.js untuk Dropdown -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    [x-cloak] { display: none !important; }
    /* Font Jakarta Sans untuk kesan Modern & Premium */
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
    
    .nav-font { font-family: 'Plus Jakarta Sans', sans-serif; }
    .nav-shadow { shadow-[0_20px_50px_-15px_rgba(10,77,104,0.1)]; }
</style>

<nav class="fixed top-6 left-1/2 -translate-x-1/2 w-[95%] max-w-7xl z-[100] nav-font">
    <div class="relative bg-white/90 backdrop-blur-md shadow-sm rounded-[2.5rem] px-8 py-4 flex justify-between items-center border border-white/20">
        
        <!-- Logo Tenang-in -->
        <a href="/" class="flex items-center gap-2 group">
            <div class="w-9 h-9 bg-[#0A4D68] rounded-xl flex items-center justify-center transition-transform group-hover:rotate-6">
                <span class="text-white font-bold italic text-xl">T</span>
            </div>
            <span class="text-2xl font-extrabold tracking-tight text-[#0A4D68]">Tenang-in</span>
        </a>
        
        <!-- Main Navigation Items -->
        <div class="hidden md:flex items-center gap-8 text-[15px] font-semibold text-[#0A4D68]/80">
            @if(auth()->check() && auth()->user()->role == 'user')
                <a href="{{ route('user.dashboard.index') }}" class="hover:text-[#D98324] transition-colors py-2 {{ request()->routeIs('user.dashboard.index') ? 'text-[#D98324]' : '' }}">Dashboard</a>
                <a href="{{ route('user.psychologist.index') }}" class="hover:text-[#D98324] transition-colors py-2 {{ request()->routeIs('user.psychologist.index', 'user.psychologist.detail') ? 'text-[#D98324]' : '' }}">Konseling</a>
                <a href="{{ route('user.schedule.index') }}" class="hover:text-[#D98324] transition-colors py-2 {{ request()->routeIs('user.schedule.index') ? 'text-[#D98324]' : '' }}">Jadwal Saya</a>

                <a href="{{ route('user.chat') }}" class="hover:text-[#D98324] transition-colors py-2 {{ request()->routeIs('user.chat') ? 'text-[#D98324]' : '' }}">AI Teman Cerita</a>
                <a href="#" class="hover:text-[#D98324] transition-colors py-2">Rekam Medis</a>
                <a href="{{ route('profile.edit') }}" class="hover:text-[#D98324] transition-colors py-2 {{ request()->routeIs('profile.edit') ? 'text-[#D98324]' : '' }}">Pengaturan Profil</a>
            @else
            
            <!-- Dropdown Konseling -->
            <div class="static group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button class="flex items-center gap-1.5 hover:text-[#D98324] transition-all py-2">
                    Konseling
                    <svg class="w-4 h-4 transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <!-- Mega Menu Dropdown -->
                <div x-show="open" 
                     x-cloak
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     class="absolute left-0 right-0 top-full mt-4 z-[999]">
                    
                    <div class="bg-white border border-gray-50 rounded-[2.5rem] shadow-[0_30px_60px_-15px_rgba(0,0,0,0.1)] p-8">
                        <div class="grid grid-cols-3 gap-6">
                            <!-- Menu Individual -->
                            <a href="#" class="group flex items-start gap-4 p-5 rounded-3xl hover:bg-gray-50 transition-all border border-transparent hover:border-gray-100">
                                <div class="w-14 h-14 shrink-0 bg-blue-50 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3652/3652191.png" class="w-10 h-10 object-contain" alt="Individual">
                                </div>
                                <div>
                                    <h5 class="text-[#0A4D68] font-bold text-lg mb-1">Individual</h5>
                                    <p class="text-gray-500 text-xs leading-relaxed">Konseling privat satu lawan satu dengan psikolog ahli.</p>
                                </div>
                            </a>

                            <!-- Menu Couple -->
                            <a href="#" class="group flex items-start gap-4 p-5 rounded-3xl hover:bg-gray-50 transition-all border border-transparent hover:border-gray-100">
                                <div class="w-14 h-14 shrink-0 bg-orange-50 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3652/3652213.png" class="w-10 h-10 object-contain" alt="Couple">
                                </div>
                                <div>
                                    <h5 class="text-[#0A4D68] font-bold text-lg mb-1">Couple</h5>
                                    <p class="text-gray-500 text-xs leading-relaxed">Perbaiki komunikasi dan keharmonisan bersama pasangan.</p>
                                </div>
                            </a>

                            <!-- Menu Family -->
                            <a href="#" class="group flex items-start gap-4 p-5 rounded-3xl hover:bg-gray-50 transition-all border border-transparent hover:border-gray-100">
                                <div class="w-14 h-14 shrink-0 bg-green-50 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3652/3652244.png" class="w-10 h-10 object-contain" alt="Family">
                                </div>
                                <div>
                                    <h5 class="text-[#0A4D68] font-bold text-lg mb-1">Family</h5>
                                    <p class="text-gray-500 text-xs leading-relaxed">Selesaikan konflik dan pererat ikatan keluarga Anda.</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            
            <a href="{{ route('test_psikologi') }}" class="hover:text-[#D98324] transition-colors py-2 {{ request()->routeIs('test_psikologi') ? 'text-[#D98324]' : '' }}">Tes Psikologi</a>
            <a href="{{ route('user.psychologist.index') }}" class="hover:text-[#D98324] transition-colors py-2 {{ request()->routeIs('user.psychologist.index', 'user.psychologist.detail') ? 'text-[#D98324]' : '' }}">List Psikolog</a>
            <a href="{{ route('about') }}" class="hover:text-[#D98324] transition-colors py-2 {{ request()->routeIs('about') ? 'text-[#D98324]' : '' }}">Tentang Kami</a>
            @endif
        </div>

        <!-- Auth Action Buttons / Profile Section -->
        <div class="flex items-center gap-3">
            @guest
                <!-- Tombol jika belum login -->
                <a href="{{ route('user.psychologist.index') }}" class="hidden sm:block bg-[#D98324] text-white px-6 py-2.5 text-sm font-bold rounded-full hover:bg-[#c47520] hover:scale-105 transition-all shadow-md">Booking Sesi</a>
                <a href="{{ route('login') }}" class="bg-[#0A4D68] text-white px-8 py-3 rounded-full text-sm font-bold hover:bg-[#083a4f] transition-all shadow-md active:scale-95">Masuk</a>
            @endguest

            @auth
                <!-- Tampilan jika sudah login (Avatar Dropdown) -->
                <div class="relative" x-data="{ userOpen: false }">
                    <button @click="userOpen = !userOpen" class="flex items-center gap-3 bg-gray-50 hover:bg-gray-100 p-1.5 pr-5 rounded-full transition-all border border-gray-100">
                        <div class="w-9 h-9 bg-[#0A4D68] rounded-full flex items-center justify-center text-white text-xs font-black shadow-inner">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <div class="text-left hidden sm:block">
                            <p class="text-[10px] text-gray-400 font-bold leading-none uppercase mb-0.5">Pasien</p>
                            <p class="text-sm font-bold text-[#0A4D68] leading-none">{{ explode(' ', Auth::user()->name)[0] }}</p>
                        </div>
                        <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 transition-transform" :class="userOpen ? 'rotate-180' : ''"></i>
                    </button>

                    <!-- Dropdown Content -->
                    <div x-show="userOpen" 
                         @click.away="userOpen = false" 
                         x-cloak
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="absolute right-0 mt-3 w-56 bg-white border border-gray-100 rounded-[2rem] shadow-2xl p-3 z-[1000]">
                        
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-5 py-3.5 hover:bg-gray-50 rounded-2xl text-sm font-semibold text-gray-700 transition-colors group">
                            <div class="w-8 h-8 rounded-xl bg-gray-100 flex items-center justify-center group-hover:bg-white transition-colors">
                                <i class="fa-regular fa-user text-gray-400 group-hover:text-indigo-600"></i>
                            </div>
                            Profil Saya
                        </a>
                        
                        <div class="my-2 border-t border-gray-50"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-5 py-3.5 hover:bg-red-50 rounded-2xl text-sm font-bold text-red-500 transition-colors group">
                                <div class="w-8 h-8 rounded-xl bg-red-100/50 flex items-center justify-center group-hover:bg-white transition-colors">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                </div>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</nav>