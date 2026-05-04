<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    [x-cloak] { display: none !important; }
    /* Font agar mirip dengan referensi */
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
    
    .nav-font { font-family: 'Plus Jakarta Sans', sans-serif; }
</style>

<nav class="fixed top-6 left-1/2 -translate-x-1/2 w-[95%] max-w-7xl z-[100] nav-font">
    <div class="relative bg-white shadow-sm rounded-[2rem] px-8 py-4 flex justify-between items-center border border-gray-100">
        
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-[#0A4D68] rounded-lg flex items-center justify-center">
                <span class="text-white font-bold italic">T</span>
            </div>
            <span class="text-2xl font-extrabold tracking-tight text-[#0A4D68]">Tenang-in</span>
        </div>
        
        <div class="hidden md:flex items-center gap-8 text-[15px] font-semibold text-[#0A4D68]/80">
            
            <div class="static group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button class="flex items-center gap-1.5 hover:text-[#D98324] transition-all py-2">
                    Konseling
                    <svg class="w-4 h-4 transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div x-show="open" 
                     x-cloak
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     class="absolute left-0 right-0 top-full mt-4 z-[999]">
                    
                    <div class="bg-white border border-gray-50 rounded-[2.5rem] shadow-[0_30px_60px_-15px_rgba(0,0,0,0.1)] p-8">
                        <div class="grid grid-cols-3 gap-6">
                            
                            <a href="{{ route('individual') }}" class="group flex items-start gap-4 p-5 rounded-3xl hover:bg-gray-50 transition-all border border-transparent hover:border-gray-100">
                                <div class="w-14 h-14 shrink-0 bg-blue-50 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3652/3652191.png" class="w-10 h-10 object-contain" alt="Individual">
                                </div>
                                <div>
                                    <h5 class="text-[#0A4D68] font-bold text-lg mb-1">Individual</h5>
                                    <p class="text-gray-500 text-xs leading-relaxed">Konseling satu lawan satu dengan psikolog profesional secara privat.</p>
                                </div>
                            </a>

                            <a href="#" class="group flex items-start gap-4 p-5 rounded-3xl hover:bg-gray-50 transition-all border border-transparent hover:border-gray-100">
                                <div class="w-14 h-14 shrink-0 bg-orange-50 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3652/3652213.png" class="w-10 h-10 object-contain" alt="Couple">
                                </div>
                                <div>
                                    <h5 class="text-[#0A4D68] font-bold text-lg mb-1">Couple</h5>
                                    <p class="text-gray-500 text-xs leading-relaxed">Membangun komunikasi yang lebih sehat bersama pasangan Anda.</p>
                                </div>
                            </a>

                            <a href="#" class="group flex items-start gap-4 p-5 rounded-3xl hover:bg-gray-50 transition-all border border-transparent hover:border-gray-100">
                                <div class="w-14 h-14 shrink-0 bg-green-50 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3652/3652244.png" class="w-10 h-10 object-contain" alt="Family">
                                </div>
                                <div>
                                    <h5 class="text-[#0A4D68] font-bold text-lg mb-1">Family</h5>
                                    <p class="text-gray-500 text-xs leading-relaxed">Menyelesaikan konflik keluarga dan mempererat hubungan antar anggota.</p>
                                </div>
                            </a>

                            {{-- <a href="#" class="group flex items-start gap-4 p-5 rounded-3xl hover:bg-gray-50 transition-all border border-transparent hover:border-gray-100">
                                <div class="w-14 h-14 shrink-0 bg-yellow-50 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3652/3652185.png" class="w-10 h-10 object-contain" alt="MHCU">
                                </div>
                                <div>
                                    <h5 class="text-[#0A4D68] font-bold text-lg mb-1">MHCU</h5>
                                    <p class="text-gray-500 text-xs leading-relaxed">Paket asesmen mental untuk mengetahui kondisi stres dan kecemasan.</p>
                                </div>
                            </a>

                            <a href="#" class="group flex items-start gap-4 p-5 rounded-3xl hover:bg-gray-50 transition-all border border-transparent hover:border-gray-100">
                                <div class="w-14 h-14 shrink-0 bg-purple-50 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3652/3652231.png" class="w-10 h-10 object-contain" alt="Hipnoterapi">
                                </div>
                                <div>
                                    <h5 class="text-[#0A4D68] font-bold text-lg mb-1">Hipnoterapi</h5>
                                    <p class="text-gray-500 text-xs leading-relaxed">Metode terapi bawah sadar untuk mengatasi trauma atau kebiasaan buruk.</p>
                                </div>
                            </a> --}}

                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('test_psikologi') }}" class="hover:text-[#D98324] transition-colors py-2 {{ request()->routeIs('test_psikologi') ? 'text-[#D98324]' : '' }}">Tes Psikologi</a>
            <a href="{{ route('about') }}" class="hover:text-[#D98324] transition-colors py-2 {{ request()->routeIs('about') ? 'text-[#D98324]' : '' }}">Tentang Kami</a>
            <a href="{{ route('user.psychologist.index') }}" class="hover:text-[#D98324] transition-colors py-2 {{ request()->routeIs('user.psychologist.index', 'user.psychologist.detail') ? 'text-[#D98324]' : '' }}">List Psikolog</a>
        </div>

        <div class="flex items-center gap-3">
            <a href="#" class="bg-[#D98324] text-white px-7 py-2.5 rounded-full text-sm font-bold hover:bg-[#b86d1d] transition-all shadow-sm">Booking Sesi</a>
            <a href="{{ route('login') }}" class="bg-[#0A4D68] text-white px-7 py-2.5 rounded-full text-sm font-bold hover:bg-[#083a4f] transition-all shadow-sm">Masuk</a>
        </div>
    </div>
</nav>