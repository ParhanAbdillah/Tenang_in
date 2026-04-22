<x-app-layout>
<style>
        body { font-family: 'Inter', sans-serif; scroll-behavior: smooth; }
        
        .serif-italic {
            font-family: Georgia, serif;
            font-style: italic;
        }

        .hero-gradient {
            background: radial-gradient(circle at top right, #F0F4F2 0%, #FFFFFF 100%);
        }

        .text-sage { color: #5F7A61; }
        .bg-sage { background-color: #5F7A61; }
        .border-sage { border-color: #5F7A61; }
        
        .card-shadow {
            box-shadow: 0 10px 40px -10px rgba(95, 122, 97, 0.1);
        }

        /* Pricing Card Base */
        .price-card {
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .price-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 50px -12px rgba(95, 122, 97, 0.15);
        }

        /* Button Professional Transitions */
        .btn-action {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-action:hover {
            letter-spacing: 0.5px;
            transform: scale(1.02);
        }

        /* Professional Toggle Styling */
        .toggle-container {
            position: relative;
            background: #F1F5F2;
            padding: 4px;
            border-radius: 9999px;
            display: inline-flex;
            border: 1px solid #E2E8E4;
        }

        .toggle-option {
            position: relative;
            z-index: 10;
            cursor: pointer;
            padding: 12px 40px;
            font-size: 0.875rem;
            font-weight: 700;
            transition: color 0.3s ease;
            width: 140px;
            text-align: center;
        }

        .toggle-slider {
            position: absolute;
            top: 4px;
            left: 4px;
            height: calc(100% - 8px);
            width: 140px;
            background: white;
            border-radius: 9999px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            z-index: 5;
        }

        /* Content Switcher Logic */
        .pricing-wrapper {
            position: relative;
            min-height: 550px;
        }

        .pricing-pane {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            transition: all 0.5s ease;
            pointer-events: none;
            opacity: 0;
            transform: translateY(20px);
        }

        .pricing-pane.active {
            position: relative;
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }

        @media (max-width: 768px) {
            .pricing-pane { position: absolute; }
            .pricing-pane.active { position: relative; }
        }
    </style>
</head>
@include('landing_page.navbar')
@include('landing_page.style')

    
    <!-- --- HERO SECTION --- -->
    <section class="pt-32 pb-16 hero-gradient overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center space-x-2 text-xs font-bold uppercase tracking-widest text-[#A0AEC0] mb-8">
                <a href="#" class="hover:text-sage transition">Beranda</a>
                <span>/</span>
                <span class="text-sage">Konseling Individual</span>
            </div>

            <div class="flex flex-col md:flex-row items-center gap-12">
                <div class="w-full md:w-1/2">
                    <h1 class="text-5xl md:text-6xl font-bold leading-tight mb-6">
                        Ruang Aman untuk<br>
                        <span class="serif-italic font-normal text-sage italic">Pulihkan Dirimu</span>
                    </h1>
                    <p class="text-lg text-[#718096] mb-8 leading-relaxed max-w-md">
                        Pilih metode konseling yang paling sesuai dengan kebutuhanmu. Tersedia sesi tatap muka langsung maupun daring.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#harga" class="bg-sage text-white px-10 py-4 rounded-full text-center text-lg font-bold shadow-lg shadow-sage/20 hover:bg-[#4E6650] transition inline-block">
                            Pilih Paket Harga
                        </a>
                    </div>
                </div>
                <div class="w-full md:w-1/2 relative">
                    <img src="https://images.unsplash.com/photo-1573497620053-ea5310f94a17?auto=format&fit=crop&q=80&w=800" 
                         alt="Sesi Konseling" 
                         class="relative rounded-[40px] shadow-2xl border-4 border-white">
                </div>
            </div>
        </div>
    </section>

    <!-- --- PRICING SECTION --- -->
    <section id="harga" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 italic serif-italic">Pilih Paket Konseling</h2>
                <p class="text-[#718096] mb-10">Transparan, tanpa biaya tersembunyi.</p>
                
                <!-- TOGGLE SWITCH -->
                <div class="toggle-container">
                    <div id="toggle-slider" class="toggle-slider"></div>
                    <div onclick="switchPricing('offline')" id="btn-offline" class="toggle-option text-sage">Offline</div>
                    <div onclick="switchPricing('online')" id="btn-online" class="toggle-option text-gray-400">Online</div>
                </div>
            </div>

            <div class="pricing-wrapper">
                
                <!-- OFFLINE PANE -->
                <div id="offline-pricing" class="pricing-pane active grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Paket 1 Offline -->
                    <div class="price-card bg-white p-10 rounded-[40px] border border-gray-100 card-shadow">
                        <div class="mb-8">
                            <h3 class="text-2xl font-bold mb-2">Sesi Tunggal</h3>
                            <p class="text-sm text-[#A0AEC0]">Tatap muka langsung di kantor.</p>
                        </div>
                        <div class="mb-8">
                            <span class="text-4xl font-bold text-sage">Rp350k</span>
                            <span class="text-[#A0AEC0]">/ sesi</span>
                        </div>
                        <ul class="space-y-4 mb-10 flex-grow text-sm text-[#718096]">
                            <li class="flex items-center"><span class="mr-3 text-sage font-bold">✓</span> Konseling 60 Menit</li>
                            <li class="flex items-center"><span class="mr-3 text-sage font-bold">✓</span> Ruangan Privat Nyaman</li>
                            <li class="flex items-center"><span class="mr-3 text-sage font-bold">✓</span> Welcome Drink</li>
                        </ul>
                        <button class="btn-action w-full py-4 rounded-full border-2 border-sage text-sage font-bold hover:bg-sage hover:text-white transition">Cari Psikolog</button>
                    </div>

                    <!-- Paket 2 Offline (Featured) -->
                    <div class="price-card bg-[#5F7A61] p-10 rounded-[40px] shadow-2xl shadow-sage/40 text-white transform md:scale-105 relative z-20">
                        <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-[#FFD700] text-[#4A5568] px-6 py-1 rounded-full text-xs font-bold uppercase tracking-widest">Terlaris</div>
                        <div class="mb-8">
                            <h3 class="text-2xl font-bold mb-2">Paket Intensif</h3>
                            <p class="text-sm text-sage-100 opacity-80">4x Pertemuan rutin mingguan.</p>
                        </div>
                        <div class="mb-8">
                            <span class="text-4xl font-bold">Rp1.2jt</span>
                            <span class="opacity-70">/ 4 sesi</span>
                        </div>
                        <ul class="space-y-4 mb-10 flex-grow text-sm">
                            <li class="flex items-center"><span class="mr-3 font-bold text-white">✓</span> Hemat Rp200.000</li>
                            <li class="flex items-center"><span class="mr-3 font-bold text-white">✓</span> Psikolog yang Sama</li>
                            <li class="flex items-center"><span class="mr-3 font-bold text-white">✓</span> Prioritas Penjadwalan</li>
                        </ul>
                        <button class="btn-action w-full py-4 rounded-full bg-white text-sage font-bold hover:bg-gray-100 transition">Cari Psikolog</button>
                    </div>

                    <!-- Paket 3 Offline -->
                    <div class="price-card bg-white p-10 rounded-[40px] border border-gray-100 card-shadow">
                        <div class="mb-8">
                            <h3 class="text-2xl font-bold mb-2">Transformasi</h3>
                            <p class="text-sm text-[#A0AEC0]">8x Sesi pendampingan total.</p>
                        </div>
                        <div class="mb-8">
                            <span class="text-4xl font-bold text-sage">Rp2.3jt</span>
                            <span class="text-[#A0AEC0]">/ 8 sesi</span>
                        </div>
                        <ul class="space-y-4 mb-10 flex-grow text-sm text-[#718096]">
                            <li class="flex items-center"><span class="mr-3 text-sage font-bold">✓</span> Pendampingan 2 Bulan</li>
                            <li class="flex items-center"><span class="mr-3 text-sage font-bold">✓</span> Laporan Perkembangan</li>
                            <li class="flex items-center"><span class="mr-3 text-sage font-bold">✓</span> Merchandise Eksklusif</li>
                        </ul>
                        <button class="btn-action w-full py-4 rounded-full border-2 border-sage text-sage font-bold hover:bg-sage hover:text-white transition">Cari Psikolog</button>
                    </div>
                </div>

                <!-- ONLINE PANE -->
                <div id="online-pricing" class="pricing-pane grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Paket 1 Online -->
                    <div class="price-card bg-white p-10 rounded-[40px] border border-gray-100 card-shadow">
                        <div class="mb-8">
                            <h3 class="text-2xl font-bold mb-2">Sesi Tunggal</h3>
                            <p class="text-sm text-[#A0AEC0]">Konseling via Video Call.</p>
                        </div>
                        <div class="mb-8">
                            <span class="text-4xl font-bold text-sage">Rp250k</span>
                            <span class="text-[#A0AEC0]">/ sesi</span>
                        </div>
                        <ul class="space-y-4 mb-10 flex-grow text-sm text-[#718096]">
                            <li class="flex items-center"><span class="mr-3 text-sage font-bold">✓</span> Durasi 60 Menit</li>
                            <li class="flex items-center"><span class="mr-3 text-sage font-bold">✓</span> Via Google Meet/WA</li>
                            <li class="flex items-center"><span class="mr-3 text-sage font-bold">✓</span> Fleksibel Dari Mana Saja</li>
                        </ul>
                        <button class="btn-action w-full py-4 rounded-full border-2 border-sage text-sage font-bold hover:bg-sage hover:text-white transition">Cari Psikolog</button>
                    </div>

                    <!-- Paket 2 Online (Featured) -->
                    <div class="price-card bg-[#5F7A61] p-10 rounded-[40px] shadow-2xl shadow-sage/40 text-white transform md:scale-105 relative z-20">
                        <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-[#FFD700] text-[#4A5568] px-6 py-1 rounded-full text-xs font-bold uppercase tracking-widest">Paling Populer</div>
                        <div class="mb-8">
                            <h3 class="text-2xl font-bold mb-2">Paket Berproses</h3>
                            <p class="text-sm text-sage-100 opacity-80">4x Sesi konseling daring.</p>
                        </div>
                        <div class="mb-8">
                            <span class="text-4xl font-bold">Rp890k</span>
                            <span class="opacity-70">/ 4 sesi</span>
                        </div>
                        <ul class="space-y-4 mb-10 flex-grow text-sm">
                            <li class="flex items-center"><span class="mr-3 font-bold text-white">✓</span> Hemat Rp110.000</li>
                            <li class="flex items-center"><span class="mr-3 font-bold text-white">✓</span> Rekaman Sesi (Opsional)</li>
                            <li class="flex items-center"><span class="mr-3 font-bold text-white">✓</span> Materi Pendukung PDF</li>
                        </ul>
                        <button class="btn-action w-full py-4 rounded-full bg-white text-sage font-bold hover:bg-gray-100 transition">Cari Psikolog</button>
                    </div>

                    <!-- Paket 3 Online -->
                    <div class="price-card bg-white p-10 rounded-[40px] border border-gray-100 card-shadow">
                        <div class="mb-8">
                            <h3 class="text-2xl font-bold mb-2">Paket Lengkap</h3>
                            <p class="text-sm text-[#A0AEC0]">8x Sesi untuk hasil optimal.</p>
                        </div>
                        <div class="mb-8">
                            <span class="text-4xl font-bold text-sage">Rp1.6jt</span>
                            <span class="text-[#A0AEC0]">/ 8 sesi</span>
                        </div>
                        <ul class="space-y-4 mb-10 flex-grow text-sm text-[#718096]">
                            <li class="flex items-center"><span class="mr-3 text-sage font-bold">✓</span> Pendampingan Intensif</li>
                            <li class="flex items-center"><span class="mr-3 text-sage font-bold">✓</span> Konsultasi via Chat</li>
                            <li class="flex items-center"><span class="mr-3 text-sage font-bold">✓</span> Sertifikat Selesai Sesi</li>
                        </ul>
                        <button class="btn-action w-full py-4 rounded-full border-2 border-sage text-sage font-bold hover:bg-sage hover:text-white transition">Cari Psikolog</button>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @include('landing_page.footer')
    @include('landing_page.script')

    <script>
        function switchPricing(type) {
            const offlinePane = document.getElementById('offline-pricing');
            const onlinePane = document.getElementById('online-pricing');
            const slider = document.getElementById('toggle-slider');
            const btnOffline = document.getElementById('btn-offline');
            const btnOnline = document.getElementById('btn-online');

            if (type === 'online') {
                slider.style.transform = 'translateX(140px)';
                
                offlinePane.classList.remove('active');
                onlinePane.classList.add('active');
                
                btnOnline.classList.replace('text-gray-400', 'text-sage');
                btnOffline.classList.replace('text-sage', 'text-gray-400');
            } else {
                slider.style.transform = 'translateX(0)';
                
                onlinePane.classList.remove('active');
                offlinePane.classList.add('active');
                
                btnOffline.classList.replace('text-gray-400', 'text-sage');
                btnOnline.classList.replace('text-sage', 'text-gray-400');
            }
        }
    </script>
    </x-app-layout>