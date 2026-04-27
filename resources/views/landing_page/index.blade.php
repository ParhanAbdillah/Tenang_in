<x-guest-layout>
    @include('landing_page.style')
    @include('landing_page.navbar')

    <div class="swiper heroSwiper w-full pt-24">
        <div class="swiper-wrapper">
            <div class="swiper-slide bg-[#0A4D68] text-white min-h-[500px] flex items-center overflow-hidden">
                <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center py-16">
                    <div class="z-10 text-left">
                        <h2 class="text-xl md:text-2xl font-light italic mb-4">Mengenal Lebih Dekat</h2>
                        <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-6">
                            Membangun Ekosistem <br>
                            <span class="text-[#A0AEC0] italic font-normal serif">Kesehatan Mental</span> yang Inklusif
                        </h1>
                        <p class="text-lg opacity-90 mb-8 max-w-lg">
                            Tenang-in hadir sebagai teman perjalananmu dalam memahami diri, mengatasi luka, dan
                            menemukan kembali kebahagiaan.
                        </p>
                        <a href="#"
                            class="bg-[#D98324] hover:bg-[#b56d1d] text-white px-8 py-4 rounded-full font-bold transition-all inline-block">
                            Konseling di Tenang-in
                        </a>
                    </div>
                    <div class="relative hidden md:block">
                        <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&q=80"
                            alt="Psikolog Tenang-in"
                            class="rounded-2xl shadow-2xl relative z-10 w-full h-[400px] object-cover">
                        <div
                            class="absolute -bottom-6 -right-6 w-64 h-64 bg-[#A0AEC0] opacity-20 rounded-full blur-3xl">
                        </div>
                    </div>
                </div>
            </div>

            <div class="swiper-slide bg-[#083344] text-white min-h-[500px] flex items-center">
                <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center py-16">
                    <div class="z-10 text-left">
                        <h2 class="text-xl md:text-2xl font-light italic mb-4">Mengenal Lebih Dekat</h2>
                        <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-6">
                            Membangun Ekosistem <br>
                            <span class="text-[#A0AEC0] italic font-normal serif">Kesehatan Mental</span> yang Inklusif
                        </h1>
                        <p class="text-lg opacity-90 mb-8 max-w-lg">
                            Tenang-in hadir sebagai teman perjalananmu dalam memahami diri, mengatasi luka, dan
                            menemukan kembali kebahagiaan.
                        </p>
                        <a href="#"
                            class="bg-[#D98324] hover:bg-[#b56d1d] text-white px-8 py-4 rounded-full font-bold transition-all inline-block">
                            Konseling di Tenang-in
                        </a>
                    </div>
                    <div class="relative hidden md:block">
                        <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&q=80"
                            alt="Psikolog Tenang-in"
                            class="rounded-2xl shadow-2xl relative z-10 w-full h-[400px] object-cover">
                        <div
                            class="absolute -bottom-6 -right-6 w-64 h-64 bg-[#A0AEC0] opacity-20 rounded-full blur-3xl">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next !text-white/50 after:!text-2xl"></div>
        <div class="swiper-button-prev !text-white/50 after:!text-2xl"></div>
    </div>

    <section
        class="bg-white py-12 -mt-10 relative z-20 mx-6 rounded-[32px] shadow-xl border border-gray-100 max-w-7xl xl:mx-auto">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 divide-x divide-gray-100">
            <div class="text-center px-4">
                <h3 class="text-3xl md:text-4xl font-bold text-[#D98324] mb-1">2.5 Juta+</h3>
                <p class="text-xs text-gray-500 leading-tight">Cerita telah dipercayakan kepada Tenang-in</p>
            </div>
            <div class="text-center px-4">
                <h3 class="text-3xl md:text-4xl font-bold text-[#D98324] mb-1">100+</h3>
                <p class="text-xs text-gray-500 leading-tight">Praktisi profesional berlisensi dan beragam keahlian</p>
            </div>
            <div class="text-center px-4">
                <h3 class="text-3xl md:text-4xl font-bold text-[#D98324] mb-1">98%</h3>
                <p class="text-xs text-gray-500 leading-tight">User merasa puas setelah konseling bersama kami</p>
            </div>
            <div class="text-center px-4">
                <h3 class="text-3xl md:text-4xl font-bold text-[#D98324] mb-1">60%</h3>
                <p class="text-xs text-gray-500 leading-tight">User rutin konseling kembali setiap bulannya</p>
            </div>
        </div>
    </section>

    {{-- Section ke 3 --}}

    <section class="py-20 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-[#0A4D68] mb-4">Layanan Konseling Tenang-in</h2>
            <p class="text-gray-500 max-w-2xl mx-auto mb-16">
                Temukan dukungan dan pemahaman di setiap langkah perjalanan kesehatan mentalmu bersama Tenang-in.
            </p>

            <div class="grid md:grid-cols-3 gap-8">

                <div
                    class="group bg-white rounded-[32px] overflow-hidden shadow-sm hover:shadow-2xl hover:bg-[#0A4D68] transition-all duration-500 border border-gray-100 flex flex-col h-full">
                    <div class="p-4">
                        <img src="https://images.unsplash.com/photo-1544027993-37dbfe43562a?auto=format&fit=crop&q=80"
                            alt="Individual" class="w-full h-56 object-cover rounded-[24px]">
                    </div>
                    <div class="p-8 flex-grow flex flex-col items-center">
                        <h3
                            class="text-2xl font-bold text-[#0A4D68] group-hover:text-white transition-colors duration-300 mb-4">
                            Individual</h3>
                        <p
                            class="text-gray-500 group-hover:text-gray-200 transition-colors duration-300 text-sm leading-relaxed mb-8">
                            Konseling yang dilakukan antara individu bersama Psikolog baik secara tatap muka ataupun
                            online dengan durasi 60 menit/sesi.
                        </p>
                        <div class="mt-auto">
                            <a href="#"
                                class="inline-flex items-center gap-2 bg-[#4392B3] group-hover:bg-[#D98324] text-white px-8 py-3 rounded-full font-bold text-sm transition-all duration-300">
                                Mulai Konseling <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div
                    class="group bg-white rounded-[32px] overflow-hidden shadow-sm hover:shadow-2xl hover:bg-[#0A4D68] transition-all duration-500 border border-gray-100 flex flex-col h-full">
                    <div class="p-4">
                        <img src="https://images.unsplash.com/photo-1516589174184-c68526614480?auto=format&fit=crop&q=80"
                            alt="Couple" class="w-full h-56 object-cover rounded-[24px]">
                    </div>
                    <div class="p-8 flex-grow flex flex-col items-center">
                        <h3
                            class="text-2xl font-bold text-[#0A4D68] group-hover:text-white transition-colors duration-300 mb-4">
                            Couple</h3>
                        <p
                            class="text-gray-500 group-hover:text-gray-200 transition-colors duration-300 text-sm leading-relaxed mb-8">
                            Konseling dengan Psikolog yang dilakukan antara pasangan, baik yang sudah menikah maupun
                            belum menikah secara tatap muka ataupun online.
                        </p>
                        <div class="mt-auto">
                            <a href="#"
                                class="inline-flex items-center gap-2 bg-[#4392B3] group-hover:bg-[#D98324] text-white px-8 py-3 rounded-full font-bold text-sm transition-all duration-300">
                                Mulai Konseling <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div
                    class="group bg-white rounded-[32px] overflow-hidden shadow-sm hover:shadow-2xl hover:bg-[#0A4D68] transition-all duration-500 border border-gray-100 flex flex-col h-full">
                    <div class="p-4">
                        <img src="https://images.unsplash.com/photo-1511895426328-dc8714191300?auto=format&fit=crop&q=80"
                            alt="Family" class="w-full h-56 object-cover rounded-[24px]">
                    </div>
                    <div class="p-8 flex-grow flex flex-col items-center">
                        <h3
                            class="text-2xl font-bold text-[#0A4D68] group-hover:text-white transition-colors duration-300 mb-4">
                            Family</h3>
                        <p
                            class="text-gray-500 group-hover:text-gray-200 transition-colors duration-300 text-sm leading-relaxed mb-8">
                            Konseling bersama Psikolog yang melibatkan dua atau lebih anggota keluarga dan dilakukan
                            secara tatap muka dengan durasi 60 menit/sesi.
                        </p>
                        <div class="mt-auto">
                            <a href="#"
                                class="inline-flex items-center gap-2 bg-[#4392B3] group-hover:bg-[#D98324] text-white px-8 py-3 rounded-full font-bold text-sm transition-all duration-300">
                                Hubungi Admin <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    {{-- section ke 4 --}}
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-[#D98324] font-bold text-3xl md:text-4xl mb-4">
                    Apapun masalahmu, <br>
                    <span class="text-[#0A4D68]">psikolog Tenang-in siap mendengarkan!</span>
                </h2>
                <p class="text-gray-500 max-w-2xl mx-auto text-sm">
                    Kamu bisa bebas memilih psikolog berlisensi sesuai preferensi, pengalaman, serta topik keahlian yang
                    sesuai dengan kebutuhanmu.
                </p>
            </div>

            <div class="swiper psikologSwiper pb-16">
                <div class="swiper-wrapper">
                    <div class="swiper-slide h-auto">
                        <div class="bg-white border border-gray-100 rounded-[32px] p-8 shadow-sm h-full">
                            <div class="flex items-center gap-5 mb-6">
                                <img src="https://images.unsplash.com/photo-1559839734-2b71f1536783?auto=format&fit=crop&q=80"
                                    class="w-20 h-20 rounded-full object-cover border-2 border-gray-50 shadow-sm"
                                    alt="Psikolog">
                                <div>
                                    <p class="text-[#4392B3] text-xs font-bold uppercase tracking-wide">Psikolog Klinis
                                        Dewasa</p>
                                    <h3 class="text-[#0A4D68] font-bold text-lg leading-tight">Rachmi Windicha Fitri.,
                                        M.Psi., Psikolog., CHt</h3>
                                </div>
                            </div>
                            <div class="flex gap-8 mb-8 text-sm text-gray-500">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-user-friends text-[#D98324]"></i> 0+ Sesi
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-briefcase text-[#D98324]"></i> 0 - 2 Tahun
                                </div>
                            </div>
                            <div class="pt-6 border-t border-gray-50">
                                <p class="text-[10px] font-extrabold text-gray-400 mb-4 uppercase tracking-[0.1em]">
                                    Jadwal Terdekat Besok</p>
                                <div class="flex flex-wrap gap-2">
                                    <span
                                        class="bg-red-50 text-red-500 text-[11px] px-4 py-2 rounded-full font-bold">09:00
                                        - 10:00 (offline)</span>
                                    <span
                                        class="bg-green-50 text-green-500 text-[11px] px-4 py-2 rounded-full font-bold">19:45
                                        - 20:45 (online)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide h-auto">
                        <div class="bg-white border border-gray-100 rounded-[32px] p-8 shadow-sm h-full">
                            <div class="flex items-center gap-5 mb-6">
                                <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&q=80"
                                    class="w-20 h-20 rounded-full object-cover border-2 border-gray-50 shadow-sm"
                                    alt="Psikolog">
                                <div>
                                    <p class="text-[#4392B3] text-xs font-bold uppercase tracking-wide">Psikolog
                                        Pendidikan</p>
                                    <h3 class="text-[#0A4D68] font-bold text-lg leading-tight">Maria Rayna Kartika
                                        Winata, M.Psi., Psikolog</h3>
                                </div>
                            </div>
                            <div class="flex gap-8 mb-8 text-sm text-gray-500">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-user-friends text-[#D98324]"></i> 600+ Sesi
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-briefcase text-[#D98324]"></i> 4 - 10 Tahun
                                </div>
                            </div>
                            <div class="pt-6 border-t border-gray-50">
                                <p class="text-[10px] font-extrabold text-gray-400 mb-4 uppercase tracking-[0.1em]">
                                    Jadwal Terdekat Besok</p>
                                <div class="flex flex-wrap gap-2">
                                    <span
                                        class="bg-green-50 text-green-500 text-[11px] px-4 py-2 rounded-full font-bold">09:00
                                        - 10:00 (online)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide h-auto">
                        <div class="bg-white border border-gray-100 rounded-[32px] p-8 shadow-sm h-full">
                            <div class="flex items-center gap-5 mb-6">
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&q=80"
                                    class="w-20 h-20 rounded-full object-cover border-2 border-gray-50 shadow-sm"
                                    alt="Psikolog">
                                <div>
                                    <p class="text-[#4392B3] text-xs font-bold uppercase tracking-wide">Psikolog Klinis
                                        Dewasa</p>
                                    <h3 class="text-[#0A4D68] font-bold text-lg leading-tight">Farhan Fadilah, M.Psi.,
                                        Psikolog</h3>
                                </div>
                            </div>
                            <div class="flex gap-8 mb-8 text-sm text-gray-500">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-user-friends text-[#D98324]"></i> 0+ Sesi
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-briefcase text-[#D98324]"></i> 2 - 4 Tahun
                                </div>
                            </div>
                            <div class="pt-6 border-t border-gray-50">
                                <p class="text-[10px] font-extrabold text-gray-400 mb-4 uppercase tracking-[0.1em]">
                                    Jadwal Terdekat Besok</p>
                                <div class="flex flex-wrap gap-2">
                                    <span
                                        class="bg-green-50 text-green-500 text-[11px] px-4 py-2 rounded-full font-bold">20:30
                                        - 21:30 (online)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-pagination !bottom-0 custom-line-pagination"></div>
            </div>
        </div>
    </section>

    {{-- Section ke 5 --}}

    <section class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-[#D98324] font-bold text-3xl md:text-4xl mb-4">
                    Kata mereka yang telah berproses <br>
                    <span class="text-[#0A4D68]">bersama Tenang-in</span>
                </h2>
                <p class="text-gray-500 max-w-2xl mx-auto text-sm">
                    Kisah #PejuangKesehatanMental yang sudah menggunakan layanan Tenang-in. Kamu juga bisa seperti
                    mereka, karena ceritamu layak didengar.
                </p>
            </div>

            <div class="swiper ulasanSwiper pb-16">
                <div class="swiper-wrapper">
                    <div class="swiper-slide h-auto">
                        <div
                            class="card-ulasan bg-white border border-gray-100 rounded-[32px] p-8 shadow-sm h-full transition-all duration-500 group">
                            <div class="mb-4">
                                <h4 class="font-bold text-lg text-[#0A4D68] group-hover:text-white">DA</h4>
                                <p class="text-[#4392B3] text-sm font-semibold group-hover:text-blue-100">e-Counseling
                                </p>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed mb-12 group-hover:text-white">
                                "Sangat bermanfaat memberi insight positif, permasalahan digali dari segala sisi. Bisa
                                dicoba banget buat yang lagi bingung."
                            </p>
                            <div class="mt-auto pt-4 flex justify-end">
                                <span class="text-[12px] text-gray-400 group-hover:text-blue-200">30 Desember
                                    2024</span>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide h-auto">
                        <div
                            class="card-ulasan bg-white border border-gray-100 rounded-[32px] p-8 shadow-sm h-full transition-all duration-500 group">
                            <div class="mb-4">
                                <h4 class="font-bold text-lg text-[#0A4D68] group-hover:text-white">GAH</h4>
                                <p class="text-[#4392B3] text-sm font-semibold group-hover:text-blue-100">e-Counseling
                                </p>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed mb-12 group-hover:text-white">
                                "Layanannya sangat baik dan bisa dipercaya. Psikolognya sangat mendengarkan tanpa
                                menghakimi sama sekali."
                            </p>
                            <div class="mt-auto pt-4 flex justify-end">
                                <span class="text-[12px] text-gray-400 group-hover:text-blue-200">13 Oktober
                                    2021</span>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide h-auto">
                        <div
                            class="card-ulasan bg-white border border-gray-100 rounded-[32px] p-8 shadow-sm h-full transition-all duration-500 group">
                            <div class="mb-4">
                                <h4 class="font-bold text-lg text-[#0A4D68] group-hover:text-white">HA</h4>
                                <p class="text-[#4392B3] text-sm font-semibold group-hover:text-blue-100">e-Counseling
                                </p>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed mb-12 group-hover:text-white">
                                "Mendapatkan konseling hari ini membuat saya dapat berpikir dengan kepala dingin.
                                Memberikan opsi dalam menyelesaikan masalah..."
                            </p>
                            <div class="mt-auto pt-4 flex justify-between items-center">
                                <a href="#"
                                    class="text-[#4392B3] font-bold text-xs group-hover:text-white underline">Selengkapnya</a>
                                <span class="text-[12px] text-gray-400 group-hover:text-blue-200">21 Juni 2020</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-pagination !bottom-0 custom-line-pagination"></div>
            </div>
        </div>
    </section>

    @include('landing_page.footer')

    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
        <style>
            .swiper-pagination-bullet-active {
                background: #D98324 !important;
            }

            .serif {
                font-family: 'Georgia', serif;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            new Swiper(".heroSwiper", {
                loop: true,
                autoplay: {
                    delay: 5000
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev"
                },
            });
            // Swiper untuk Card Psikolog
            var psikologSwiper = new Swiper(".psikologSwiper", {
                slidesPerView: 1,
                spaceBetween: 24,
                centeredSlides: false,
                pagination: {
                    el: ".custom-line-pagination",
                    clickable: true,
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                    },
                    1200: {
                        slidesPerView: 3,
                    }
                }
            });

            var ulasanSwiper = new Swiper(".ulasanSwiper", {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                pagination: {
                    el: ".custom-line-pagination",
                    clickable: true,
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                    },
                    1200: {
                        slidesPerView: 3,
                    }
                }
            });
        </script>
    @endpush
</x-guest-layout>
