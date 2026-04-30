<x-guest-layout>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }

        .serif-italic {
            font-family: Georgia, serif;
            font-style: italic;
        }

        /* Tema Tenang.in: Biru Indigo & Kuning Oranye */
        .hero-gradient {
            background: radial-gradient(circle at top right, #F0F4FF 0%, #FFFFFF 100%);
        }

        .text-primary {
            color: #0F394C;
        }

        .bg-primary {
            background-color: #0F394C;
        }

        .bg-accent {
            background-color: #D98324;
        }

        .card-shadow {
            box-shadow: 0 10px 40px -10px rgba(15, 57, 76, 0.1);
        }

        .price-card {
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .price-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 50px -12px rgba(15, 57, 76, 0.15);
        }

        .btn-booking {
            background-color: #D98324;
            transition: all 0.3s ease;
        }

        .btn-booking:hover {
            background-color: #b56d1e;
            transform: scale(1.02);
            letter-spacing: 0.5px;
        }

        /* Animasi Blob untuk Hero Section */
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
    </style>

    @include('landing_page.navbar')

    <section class="pt-32 pb-16 hero-gradient overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <div class="w-full md:w-1/2 text-center md:text-left">
                    <h1 class="text-5xl md:text-6xl font-extrabold leading-tight mb-6 text-slate-900">
                        {{ \App\Models\WebConfig::get('hero_title', 'Ruang Aman untuk Pulihkan Dirimu') }}
                    </h1>
                    <p class="text-lg text-slate-500 mb-8 leading-relaxed max-w-md mx-auto md:mx-0">
                        {{ \App\Models\WebConfig::get('hero_description', 'Pilih metode konseling daring yang paling sesuai dengan kebutuhan pemulihanmu.') }}
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                        <a href="#harga"
                            class="bg-primary text-white px-10 py-4 rounded-2xl text-center text-lg font-bold shadow-lg shadow-blue-900/20 hover:bg-slate-800 transition duration-300">
                            Lihat Paket Konseling
                        </a>
                    </div>
                </div>
                <div class="w-full md:w-1/2 relative">
                    <div
                        class="absolute -top-10 -left-10 w-32 h-32 bg-yellow-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob">
                    </div>
                    <img src="{{ \App\Models\WebConfig::get('individual_hero_image') ? asset('storage/' . \App\Models\WebConfig::get('individual_hero_image')) : 'https://images.unsplash.com/photo-1573497620053-ea5310f94a17?auto=format&fit=crop&q=80&w=800' }}"
                        class="relative rounded-[3rem] shadow-2xl border-8 border-white object-cover h-[500px] w-full"
                        alt="Konseling Tenang.in">
                </div>
            </div>
        </div>
    </section>

    <section id="harga" class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 text-slate-900">Paket Konseling Online Individual</h2>
                <p class="text-slate-500">Investasi terbaik untuk kesehatan mental dan pertumbuhan dirimu.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">

                <div class="price-card bg-white rounded-[2.5rem] overflow-hidden border border-slate-100 card-shadow">
                    <div class="h-44 bg-slate-200 relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1527137342181-19aab11a8ee8?auto=format&fit=crop&q=80&w=500"
                            class="w-full h-full object-cover grayscale opacity-70" alt="Basic Session">
                        <div class="absolute inset-0 bg-gradient-to-t from-white via-transparent to-transparent"></div>
                    </div>
                    <div class="p-8 pt-0 text-center">
                        <h3 class="text-xl font-bold text-slate-800 mb-1">Basic</h3>
                        <div class="mb-6">
                            <span class="text-xl font-bold text-[#0F394C]">
                                Rp{{ number_format($prices['basic']['min'] ?? 0, 0, ',', '.') }} - Rp{{ number_format($prices['basic']['max'] ?? 0, 0, ',', '.') }}
                            </span>
                            <br>
                            <span class="text-slate-400 text-xs">per Sesi</span>
                        </div>
                        <a href="#"
                            class="btn-booking inline-block w-full py-3 mb-8 rounded-full text-white font-bold shadow-md">
                            Cari Psikolog
                        </a>

                        <ul class="text-left space-y-4 text-xs text-slate-600 px-2">
                            <li class="flex items-start gap-3"><i class="fa-solid fa-check text-green-500 mt-1"></i>
                                <span>Psikolog rata-rata berusia 20 - 30 tahun</span></li>
                            <li class="flex items-start gap-3"><i class="fa-solid fa-check text-green-500 mt-1"></i>
                                <span>Pengalaman menangani klien 0 - 2 tahun</span></li>
                            <li class="flex items-start gap-3"><i class="fa-solid fa-check text-green-500 mt-1"></i>
                                <span>Jumlah klien ditangani < 300 orang</span></li>
                            <li class="flex items-start gap-3"><i class="fa-solid fa-check text-green-500 mt-1"></i>
                                <span>Kasus: depresi, kecemasan, karir, & kepribadian</span></li>
                        </ul>
                    </div>
                </div>

                <div class="price-card bg-white rounded-[2.5rem] overflow-hidden border-2 border-[#D98324] card-shadow relative transform md:scale-105 z-10">
                    <div class="absolute top-4 right-6">
                        <span class="bg-accent text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-tighter">Paling Populer</span>
                    </div>
                    <div class="h-44 bg-slate-200 relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1527137342181-19aab11a8ee8?auto=format&fit=crop&q=80&w=500"
                            class="w-full h-full object-cover grayscale opacity-70" alt="Essential Session">
                        <div class="absolute inset-0 bg-gradient-to-t from-white via-transparent to-transparent"></div>
                    </div>
                    <div class="p-8 pt-0 text-center">
                        <h3 class="text-xl font-bold text-slate-800 mb-1">Essential</h3>
                        <div class="mb-6">
                            <span class="text-xl font-bold text-[#0F394C]">
                                Rp{{ number_format($prices['essential']['min'] ?? 0, 0, ',', '.') }} - Rp{{ number_format($prices['essential']['max'] ?? 0, 0, ',', '.') }}
                            </span>
                            <br>
                            <span class="text-slate-400 text-xs">per Sesi</span>
                        </div>
                        <a href="#"
                            class="btn-booking inline-block w-full py-3 mb-8 rounded-full text-white font-bold shadow-md">
                            Cari Psikolog
                        </a>

                        <ul class="text-left space-y-4 text-xs text-slate-600 px-2">
                            <li class="flex items-start gap-3"><i class="fa-solid fa-check text-green-500 mt-1"></i>
                                <span>Psikolog rata-rata berusia 26 - 30 tahun</span></li>
                            <li class="flex items-start gap-3"><i class="fa-solid fa-check text-green-500 mt-1"></i>
                                <span>Pengalaman menangani klien 2 - 4 tahun</span></li>
                            <li class="flex items-start gap-3"><i class="fa-solid fa-check text-green-500 mt-1"></i>
                                <span>Jumlah klien ditangani 301 - 500 orang</span></li>
                            <li class="flex items-start gap-3"><i class="fa-solid fa-check text-green-500 mt-1"></i>
                                <span>Kasus: trauma, fobia, parenting, & relasi</span></li>
                        </ul>
                    </div>
                </div>

                <div class="price-card bg-white rounded-[2.5rem] overflow-hidden border border-slate-100 card-shadow">
                    <div class="h-44 bg-slate-200 relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1544027993-37dbfe43562a?auto=format&fit=crop&q=80&w=500"
                            class="w-full h-full object-cover grayscale opacity-70" alt="Premium Session">
                        <div class="absolute inset-0 bg-gradient-to-t from-white via-transparent to-transparent"></div>
                    </div>
                    <div class="p-8 pt-0 text-center">
                        <h3 class="text-xl font-bold text-slate-800 mb-1">Premium</h3>
                        <div class="mb-6">
                            <span class="text-xl font-bold text-[#0F394C]">
                                Rp{{ number_format($prices['premium']['min'] ?? 0, 0, ',', '.') }} - Rp{{ number_format($prices['premium']['max'] ?? 0, 0, ',', '.') }}
                            </span>
                            <br>
                            <span class="text-slate-400 text-xs">per Sesi</span>
                        </div>
                        <a href="#"
                            class="btn-booking inline-block w-full py-3 mb-8 rounded-full text-white font-bold shadow-md">
                            Cari Psikolog
                        </a>

                        <ul class="text-left space-y-4 text-xs text-slate-600 px-2">
                            <li class="flex items-start gap-3"><i class="fa-solid fa-check text-green-500 mt-1"></i>
                                <span>Psikolog senior berusia 30 - 55 tahun</span></li>
                            <li class="flex items-start gap-3"><i class="fa-solid fa-check text-green-500 mt-1"></i>
                                <span>Pengalaman menangani klien > 4 tahun</span></li>
                            <li class="flex items-start gap-3"><i class="fa-solid fa-check text-green-500 mt-1"></i>
                                <span>Jumlah klien ditangani > 500 orang</span></li>
                            <li class="flex items-start gap-3"><i class="fa-solid fa-check text-green-500 mt-1"></i>
                                <span>Kasus klinis berat, adiksi, & keluarga</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('landing_page.footer')
</x-guest-layout>