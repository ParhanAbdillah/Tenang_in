<x-app-layout>
    @include('landing_page.style')
    <!-- --- SECTION 1: HEADER & HERO CAROUSEL --- -->
    <section class="relative overflow-hidden hero-gradient pb-24 pt-6 min-h-[750px]">

        <!-- --- NAVBAR KAPSUL --- -->
        @include('landing_page.navbar')
        <div class="h-24"></div>

        <!-- --- CAROUSEL SLIDING WRAPPER --- -->
        <div class="overflow-hidden">
            <div id="carousel-track" class="carousel-container">

                <!-- Slide 1 -->
                <div class="carousel-slide mx-auto max-w-7xl px-6 flex flex-col md:flex-row items-center relative z-10">
                    <div class="w-full md:w-3/5 text-[#4A5568] text-center md:text-left mb-16 md:mb-0">
                        <p class="text-sm font-bold mb-4 text-[#5F7A61] uppercase tracking-[0.2em]">Healing & Ketenangan
                        </p>
                        <h1 class="text-4xl md:text-6xl font-bold leading-[1.1] mb-8">
                            Temukan Keseimbangan<br />
                            <span class="text-[#5F7A61] serif-italic font-normal italic">Emosi di Masa Sulit</span>
                        </h1>
                        <p class="text-lg text-[#718096] mb-10 max-w-lg leading-relaxed">
                            Webinar khusus: Memaafkan Orang Tua NPD tanpa mengorbankan ketenangan batin Anda sendiri.
                        </p>
                        <div class="flex items-center space-x-4 mb-10 justify-center md:justify-start">
                            <div class="bg-white/40 p-4 rounded-2xl glass-card text-center min-w-[120px]">
                                <p class="text-[10px] font-bold uppercase text-[#5F7A61] mb-1">Investasi</p>
                                <p class="text-xl font-bold">Rp119k</p>
                            </div>
                            <div class="h-12 w-[1px] bg-[#CBD5E0]"></div>
                            <p class="text-sm font-medium text-[#718096]">Live via Zoom<br>Minggu, 26 April 2026</p>
                        </div>
                        <button
                            class="btn-zen-primary text-white px-12 py-5 rounded-full text-lg font-bold shadow-lg shadow-[#5F7A61]/20">
                            Daftar Sesi Sekarang
                        </button>
                    </div>
                    <div class="w-full md:w-2/5 flex justify-center relative">
                        <div class="absolute inset-0 bg-[#5F7A61]/10 blur-[120px] rounded-full"></div>
                        <div class="relative p-4">
                            <div
                                class="absolute inset-0 border-2 border-[#5F7A61]/20 rounded-t-full translate-x-3 translate-y-3">
                            </div>
                            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&q=80&w=600"
                                alt="Psikolog"
                                class="w-full max-w-sm rounded-t-full shadow-2xl grayscale-[20%] transition-all duration-700">
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-slide mx-auto max-w-7xl px-6 flex flex-col md:flex-row items-center relative z-10">
                    <div class="w-full md:w-3/5 text-[#4A5568] text-center md:text-left mb-16 md:mb-0">
                        <p class="text-sm font-bold mb-4 text-[#5F7A61] uppercase tracking-[0.2em]">Ruang Aman Konseling
                        </p>
                        <h1 class="text-4xl md:text-6xl font-bold leading-[1.1] mb-8">
                            Privasi & Kepercayaan<br />
                            <span class="text-[#5F7A61] serif-italic font-normal italic">Adalah Prioritas Kami</span>
                        </h1>
                        <p class="text-lg text-[#718096] mb-10 max-w-lg leading-relaxed">
                            Bicarakan kecemasan Anda dengan praktisi berlisensi dalam suasana yang tenang dan tanpa
                            penghakiman.
                        </p>
                        <button
                            class="bg-[#4A5568] hover:bg-[#2D3748] text-white px-12 py-5 rounded-full text-lg font-bold shadow-lg transition-all">
                            Pilih Psikolog Anda
                        </button>
                    </div>
                    <div class="w-full md:w-2/5 flex justify-center relative">
                        <div class="absolute inset-0 bg-[#4A5568]/10 blur-[120px] rounded-full"></div>
                        <div class="relative p-4">
                            <div
                                class="absolute inset-0 border-2 border-[#4A5568]/20 rounded-t-full translate-x-3 translate-y-3">
                            </div>
                            <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&q=80&w=600"
                                alt="Sesi Konseling" class="w-full max-w-sm rounded-t-full shadow-2xl">
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Carousel Dots -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex space-x-4 z-20">
            <button onclick="goToSlide(0)" id="dot-0"
                class="dot active-dot w-3 h-2 bg-gray-300 rounded-full transition-all duration-500"></button>
            <button onclick="goToSlide(1)" id="dot-1"
                class="dot w-3 h-2 bg-gray-300 rounded-full transition-all duration-500"></button>
        </div>
    </section>

    <!-- --- SECTION 2: STATS --- -->
    <section class="relative -mt-12 mx-auto max-w-7xl px-6 z-30 mb-20">
        <div
            class="bg-white/90 backdrop-blur-md rounded-[48px] shadow-xl shadow-[#5F7A61]/5 p-12 md:p-16 flex flex-wrap justify-between items-center text-center border border-white">
            <div class="w-full sm:w-1/2 md:w-1/4 mb-10 md:mb-0 px-4 border-r-0 md:border-r border-[#EDF2F0]">
                <div class="text-4xl font-bold text-[#5F7A61] mb-2">2.5jt+</div>
                <p class="text-[11px] text-[#A0AEC0] font-bold uppercase tracking-widest leading-relaxed">Kisah
                    Yang<br>Telah Pulih</p>
            </div>
            <div class="w-full sm:w-1/2 md:w-1/4 mb-10 md:mb-0 px-4 border-r-0 md:border-r border-[#EDF2F0]">
                <div class="text-4xl font-bold text-[#5F7A61] mb-2">100+</div>
                <p class="text-[11px] text-[#A0AEC0] font-bold uppercase tracking-widest leading-relaxed">
                    Psikolog<br>Berlisensi</p>
            </div>
            <div class="w-full sm:w-1/2 md:w-1/4 mb-10 sm:mb-0 px-4 border-r-0 md:border-r border-[#EDF2F0]">
                <div class="text-4xl font-bold text-[#5F7A61] mb-2">98%</div>
                <p class="text-[11px] text-[#A0AEC0] font-bold uppercase tracking-widest leading-relaxed">
                    Tingkat<br>Kepercayaan</p>
            </div>
            <div class="w-full sm:w-1/2 md:w-1/4 px-4">
                <div class="text-4xl font-bold text-[#5F7A61] mb-2">60%</div>
                <p class="text-[11px] text-[#A0AEC0] font-bold uppercase tracking-widest leading-relaxed">Klien
                    Yang<br>Kembali Sesi</p>
            </div>
        </div>
    </section>


    <!-- Section Container 3 -->
    <section class="py-20 px-6 bg-[#E4EBE9]">
        <div class="max-w-6xl mx-auto">

            <!-- Header Section -->
            <div class="text-center mb-16">
                <span class="text-[#3385AF] font-semibold tracking-widest uppercase text-sm mb-3 block">Layanan
                    Kami</span>
                <h2 class="text-3xl md:text-4xl font-bold text-[#1E4D6B] mb-5">
                    Layanan Konseling Tenang-in
                </h2>
                <p class="text-gray-500 max-w-xl mx-auto leading-relaxed text-sm md:text-base">
                    Temukan dukungan profesional yang dipersonalisasi untuk setiap tahap perjalanan kesehatan mental
                    Anda.
                </p>
            </div>

            <!-- Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Card 1: Individual -->
                <div
                    class="group bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 card-transition hover:bg-[#0A3D5A] hover:shadow-2xl hover:-translate-y-1 flex flex-col h-full">
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('img/individual.jpg') }}"
                            alt="[Gambar Konseling Individual]"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold mb-3 text-[#1E4D6B] group-hover:text-white transition-colors">
                            Individual</h3>
                        <p
                            class="text-gray-500 group-hover:text-gray-300 transition-colors mb-6 leading-relaxed text-sm">
                            Konseling privat antara individu bersama Psikolog baik tatap muka maupun online durasi
                            60 menit.
                        </p>
                        <div class="mt-auto">
                            <button
                                class="w-full bg-[#3385AF] group-hover:bg-[#E68A2E] text-white font-semibold py-2.5 px-4 rounded-lg inline-flex items-center justify-center text-sm transition-all duration-300">
                                Mulai Konseling
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Couple -->
                <div
                    class="group bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 card-transition hover:bg-[#0A3D5A] hover:shadow-2xl hover:-translate-y-1 flex flex-col h-full">
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('img/couple.jpg') }}"
                            alt="[Gambar Konseling Pasangan]"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold mb-3 text-[#1E4D6B] group-hover:text-white transition-colors">
                            Couple</h3>
                        <p
                            class="text-gray-500 group-hover:text-gray-300 transition-colors mb-6 leading-relaxed text-sm">
                            Sesi bersama pasangan untuk memperkuat hubungan, tersedia secara tatap muka maupun
                            online.
                        </p>
                        <div class="mt-auto">
                            <button
                                class="w-full bg-[#3385AF] group-hover:bg-[#E68A2E] text-white font-semibold py-2.5 px-4 rounded-lg inline-flex items-center justify-center text-sm transition-all duration-300">
                                Mulai Konseling
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Family -->
                <div
                    class="group bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 card-transition hover:bg-[#0A3D5A] hover:shadow-2xl hover:-translate-y-1 flex flex-col h-full">
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('img/family.jpg') }}"
                            alt="[Gambar Konseling Keluarga]"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold mb-3 text-[#1E4D6B] group-hover:text-white transition-colors">
                            Family</h3>
                        <p
                            class="text-gray-500 group-hover:text-gray-300 transition-colors mb-6 leading-relaxed text-sm">
                            Membangun harmonisasi keluarga melalui bimbingan psikolog profesional secara tatap muka.
                        </p>
                        <div class="mt-auto">
                            <button
                                class="w-full bg-[#3385AF] group-hover:bg-[#E68A2E] text-white font-semibold py-2.5 px-4 rounded-lg inline-flex items-center justify-center text-sm transition-all duration-300">
                                Hubungi Admin
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Section Container 4 -->
    <section class="py-20 px-6 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto">

            <!-- Header Section -->
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-[#1E4D6B] leading-tight">
                    <span class="text-[#E68A2E]">Apapun masalahmu,</span><br>
                    psikolog Tenang-in siap mendengarkan!
                </h2>
                <p class="text-gray-500 mt-6 max-w-3xl mx-auto text-sm md:text-base leading-relaxed">
                    Kamu bisa bebas memilih psikolog berlisensi sesuai preferensi, pengalaman, serta topik keahlian
                    yang sesuai dengan kebutuhanmu.
                </p>
            </div>

            <!-- Carousel Wrapper -->
            <div class="relative group">
                <!-- Carousel Container -->
                <div id="psychologistCarousel"
                    class="flex overflow-x-auto gap-6 no-scrollbar snap-x snap-mandatory py-4 px-2">

                    <!-- Card Psikolog 1 -->
                    <div
                        class="min-w-[300px] md:min-w-[400px] snap-center bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-4 mb-6">
                            <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?q=80&w=200&auto=format&fit=crop"
                                alt="Psikolog" class="w-16 h-16 rounded-full object-cover border-2 border-[#3385AF]">
                            <div class="flex-1">
                                <span class="text-[#3385AF] text-xs font-semibold block uppercase">Psikolog
                                    Pendidikan</span>
                                <h4 class="text-[#1E4D6B] font-bold text-lg leading-tight">Maria Rayna Kartika
                                    Winata, M.Psi., Psikolog</h4>
                            </div>
                        </div>
                        <div class="flex gap-6 mb-6 text-sm text-gray-500">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-[#3385AF]" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                                </svg>
                                600+ Sesi
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-[#E68A2E]" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 011 1v1H4V7zM4 9h12v7a1 1 0 01-1 1H5a1 1 0 01-1-1V9z">
                                    </path>
                                </svg>
                                4 - 10 Tahun
                            </div>
                        </div>
                        <div class="pt-4 border-t border-gray-100">
                            <p class="text-xs text-gray-400 font-medium mb-3">Jadwal Terdekat Besok</p>
                            <div class="flex flex-wrap gap-2">
                                <span
                                    class="bg-[#F0F7FB] text-[#3385AF] text-xs font-bold py-2 px-3 rounded-lg border border-[#DCEEF8]">09:00
                                    - 10:00 <span class="text-gray-400 font-normal">(online)</span></span>
                            </div>
                        </div>
                    </div>

                    <!-- Card Psikolog 2 -->
                    <div
                        class="min-w-[300px] md:min-w-[400px] snap-center bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-4 mb-6">
                            <img src="https://images.unsplash.com/photo-1594824476967-48c8b964273f?q=80&w=200&auto=format&fit=crop"
                                alt="Psikolog" class="w-16 h-16 rounded-full object-cover border-2 border-[#3385AF]">
                            <div class="flex-1">
                                <span class="text-[#3385AF] text-xs font-semibold block uppercase">Psikolog Klinis
                                    Umum</span>
                                <h4 class="text-[#1E4D6B] font-bold text-lg leading-tight">Pamela Andari Priyudha,
                                    M.Psi., Psikolog</h4>
                            </div>
                        </div>
                        <div class="flex gap-6 mb-6 text-sm text-gray-500">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-[#3385AF]" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                                </svg>
                                300+ Sesi
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-[#E68A2E]" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 011 1v1H4V7zM4 9h12v7a1 1 0 01-1 1H5a1 1 0 01-1-1V9z">
                                    </path>
                                </svg>
                                4 - 10 Tahun
                            </div>
                        </div>
                        <div class="pt-4 border-t border-gray-100">
                            <p class="text-xs text-gray-400 font-medium mb-3">Jadwal Terdekat Besok</p>
                            <div class="flex flex-wrap gap-2">
                                <span
                                    class="bg-[#F0F7FB] text-[#3385AF] text-xs font-bold py-2 px-3 rounded-lg border border-[#DCEEF8]">09:00
                                    - 10:00 <span class="text-gray-400 font-normal">(online)</span></span>
                            </div>
                        </div>
                    </div>

                    <!-- Card Psikolog 3 -->
                    <div
                        class="min-w-[300px] md:min-w-[400px] snap-center bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-4 mb-6">
                            <img src="https://images.unsplash.com/photo-1559839734-2b71f1536783?q=80&w=200&auto=format&fit=crop"
                                alt="Psikolog" class="w-16 h-16 rounded-full object-cover border-2 border-[#3385AF]">
                            <div class="flex-1">
                                <span class="text-[#3385AF] text-xs font-semibold block uppercase">Psikolog Klinis
                                    Dewasa</span>
                                <h4 class="text-[#1E4D6B] font-bold text-lg leading-tight">Distyana Dahlia, M.Psi.,
                                    Psikolog</h4>
                            </div>
                        </div>
                        <div class="flex gap-6 mb-6 text-sm text-gray-500">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-[#3385AF]" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                                </svg>
                                400+ Sesi
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-[#E68A2E]" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 011 1v1H4V7zM4 9h12v7a1 1 0 01-1 1H5a1 1 0 01-1-1V9z">
                                    </path>
                                </svg>
                                > 10 Tahun
                            </div>
                        </div>
                        <div class="pt-4 border-t border-gray-100">
                            <p class="text-xs text-gray-400 font-medium mb-3">Jadwal Terdekat Besok</p>
                            <div class="flex flex-wrap gap-2">
                                <span
                                    class="bg-[#F0F7FB] text-[#3385AF] text-xs font-bold py-2 px-3 rounded-lg border border-[#DCEEF8]">09:00
                                    - 10:00 <span class="text-gray-400 font-normal">(online)</span></span>
                            </div>
                        </div>
                    </div>

                    <!-- Card Psikolog 4 -->
                    <div
                        class="min-w-[300px] md:min-w-[400px] snap-center bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-4 mb-6">
                            <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=200&auto=format&fit=crop"
                                alt="Psikolog" class="w-16 h-16 rounded-full object-cover border-2 border-[#3385AF]">
                            <div class="flex-1">
                                <span class="text-[#3385AF] text-xs font-semibold block uppercase">Psikolog Anak &
                                    Remaja</span>
                                <h4 class="text-[#1E4D6B] font-bold text-lg leading-tight">Sarah Amelia, M.Psi.,
                                    Psikolog</h4>
                            </div>
                        </div>
                        <div class="flex gap-6 mb-6 text-sm text-gray-500">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-[#3385AF]" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                                </svg>
                                250+ Sesi
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-[#E68A2E]" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 011 1v1H4V7zM4 9h12v7a1 1 0 01-1 1H5a1 1 0 01-1-1V9z">
                                    </path>
                                </svg>
                                5 Tahun
                            </div>
                        </div>
                        <div class="pt-4 border-t border-gray-100">
                            <p class="text-xs text-gray-400 font-medium mb-3">Jadwal Terdekat Besok</p>
                            <div class="flex flex-wrap gap-2">
                                <span
                                    class="bg-[#F0F7FB] text-[#3385AF] text-xs font-bold py-2 px-3 rounded-lg border border-[#DCEEF8]">13:00
                                    - 14:00 <span class="text-gray-400 font-normal">(online)</span></span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Navigation Bars (Indicator Garis sesuai referensi) -->
                <div class="flex justify-center gap-2 mt-10">
                    <button onclick="scrollToIndex(0)"
                        class="nav-bar w-8 h-1.5 rounded-full bg-[#0A3D5A] transition-all duration-300"></button>
                    <button onclick="scrollToIndex(1)"
                        class="nav-bar w-8 h-1.5 rounded-full bg-gray-300 transition-all duration-300"></button>
                    <button onclick="scrollToIndex(2)"
                        class="nav-bar w-8 h-1.5 rounded-full bg-gray-300 transition-all duration-300"></button>
                    <button onclick="scrollToIndex(3)"
                        class="nav-bar w-8 h-1.5 rounded-full bg-gray-300 transition-all duration-300"></button>
                </div>
            </div>
        </div>
    </section>

    <!-- Konten Atas (Placeholders) -->
    <div class="h-40 bg-white"></div>

    <!-- Footer Area -->
    @include('landing_page.footer')
    @include('landing_page.script')
</x-app-layout>
