 <div class="fixed top-0 left-0 right-0 mx-auto max-w-7xl px-6 pt-4 z-[100]">
     <nav id="main-nav"
         class="bg-white/70 backdrop-blur-xl rounded-full px-8 py-3 flex items-center justify-between shadow-sm border border-[#E2E8E4] relative">

         <div class="flex items-center">
             <span class="text-3xl serif-italic text-[#4A5568] font-bold tracking-tight cursor-pointer">Tenang-in</span>
         </div>

         <div class="hidden md:flex items-center space-x-10 text-sm font-semibold text-[#6B7280]">
             <div class="relative group">
                 <button onclick="toggleMegaMenu(event)"
                     class="flex items-center cursor-pointer hover:text-[#5F7A61] transition focus:outline-none py-4">
                     <span>Konseling</span>
                     <svg id="arrow-icon" class="ml-1 h-4 w-4 opacity-50 transition-transform" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                     </svg>
                 </button>
             </div>

             <a href="#" class="hover:text-[#5F7A61] transition">Tes Psikologi</a>
             <a href="{{ route('about') }}"
                 class="{{ request()->routeIs('about') ? 'text-[#5F7A61]' : 'hover:text-[#5F7A61]' }}">
                 Tentang Kami
             </a>
             <a href="#" class="hover:text-[#5F7A61] transition">List Psikolog</a>
         </div>

         <div class="flex items-center space-x-1">
             <button
                 class="rounded-l-full bg-[#5F7A61] px-8 py-3 text-sm font-bold text-white shadow-md hover:bg-[#4E6650] transition">
                 Booking Sesi
             </button>
             <button
                 class="rounded-r-full bg-[#4A5568] px-8 py-3 text-sm font-bold text-white shadow-md hover:bg-[#3D4654] transition">
                 Masuk
             </button>
         </div>

         <!-- --- MEGA MENU DROPDOWN (HIDDEN BY DEFAULT) --- -->
         <div id="mega-menu"
             class="hidden absolute left-0 right-0 top-[110%] mt-2 w-full bg-white/95 backdrop-blur-2xl rounded-[32px] shadow-2xl p-8 border border-[#E2E8E4] grid grid-cols-1 md:grid-cols-3 gap-4 z-50">

             <!-- Item: Individual -->
             <a href="{{ route('individual') }}"
                 class="flex items-start p-4 rounded-2xl hover:bg-[#F8FAFC] transition-colors border border-transparent hover:border-[#E2E8E4] group">
                 <div
                     class="w-12 h-12 rounded-2xl bg-orange-50 flex items-center justify-center mr-4 shrink-0 group-hover:scale-110 transition-transform">
                     <span class="text-2xl">👩‍💻</span>
                 </div>
                 <div>
                     <h4 class="font-bold text-[#4A5568] mb-1 group-hover:text-[#5F7A61]">Individual</h4>
                     <p class="text-[11px] text-[#A0AEC0] leading-relaxed">Konseling privat bersama Psikolog
                         untuk berbagai isu personal.</p>
                 </div>
             </a>

             <!-- Item: Pasangan -->
             <a href="#"
                 class="flex items-start p-4 rounded-2xl hover:bg-[#F8FAFC] transition-colors border border-transparent hover:border-[#E2E8E4] group">
                 <div
                     class="w-12 h-12 rounded-2xl bg-rose-50 flex items-center justify-center mr-4 shrink-0 group-hover:scale-110 transition-transform">
                     <span class="text-2xl">👩‍❤️‍👨</span>
                 </div>
                 <div>
                     <h4 class="font-bold text-[#4A5568] mb-1 group-hover:text-[#5F7A61]">Pasangan</h4>
                     <p class="text-[11px] text-[#A0AEC0] leading-relaxed">Bantu hubungan Anda kembali harmonis
                         dengan bantuan profesional.</p>
                 </div>
             </a>

             <!-- Item: Keluarga -->
             <a href="#"
                 class="flex items-start p-4 rounded-2xl hover:bg-[#F8FAFC] transition-colors border border-transparent hover:border-[#E2E8E4] group">
                 <div
                     class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center mr-4 shrink-0 group-hover:scale-110 transition-transform">
                     <span class="text-2xl">👨‍👩‍👧‍👦</span>
                 </div>
                 <div>
                     <h4 class="font-bold text-[#4A5568] mb-1 group-hover:text-[#5F7A61]">Keluarga</h4>
                     <p class="text-[11px] text-[#A0AEC0] leading-relaxed">Selesaikan dinamika konflik keluarga
                         untuk rumah yang lebih tenang.</p>
                 </div>
             </a>
         </div>
     </nav>
 </div>
