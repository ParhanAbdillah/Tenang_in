<x-guest-layout>
    @include('landing_page.navbar')
    
<div class="pt-32 pb-10 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Welcome Section -->
        <div class="bg-gradient-to-r from-[#0A4D68] to-[#1a6585] rounded-3xl p-8 md:p-12 shadow-2xl text-white relative overflow-hidden">
            <!-- Decorative circle -->
            <div class="absolute -right-10 -top-10 w-64 h-64 bg-white opacity-10 rounded-full blur-2xl"></div>
            <div class="absolute right-20 -bottom-20 w-48 h-48 bg-[#D98324] opacity-20 rounded-full blur-xl"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-6">
                <div>
                    <h2 class="text-3xl md:text-4xl font-extrabold mb-2 tracking-tight">Halo, {{ auth()->user()->name }}! 👋</h2>
                    <p class="text-blue-100 text-lg md:text-xl font-medium max-w-xl leading-relaxed">
                        Bagaimana perasaanmu hari ini? Ingat, tidak apa-apa untuk merasa tidak baik-baik saja. Kami di sini untukmu.
                    </p>
                </div>
                <!-- Mini Mood Quick Select -->
                <div class="bg-white/10 backdrop-blur-md border border-white/20 p-4 rounded-2xl flex gap-3">
                    <button class="w-12 h-12 bg-white/20 hover:bg-[#D98324] hover:scale-110 transition-all duration-300 rounded-xl flex items-center justify-center text-2xl shadow-sm" title="Senang">😊</button>
                    <button class="w-12 h-12 bg-white/20 hover:bg-[#D98324] hover:scale-110 transition-all duration-300 rounded-xl flex items-center justify-center text-2xl shadow-sm" title="Biasa Saja">😐</button>
                    <button class="w-12 h-12 bg-white/20 hover:bg-[#D98324] hover:scale-110 transition-all duration-300 rounded-xl flex items-center justify-center text-2xl shadow-sm" title="Sedih">😢</button>
                    <button class="w-12 h-12 bg-white/20 hover:bg-[#D98324] hover:scale-110 transition-all duration-300 rounded-xl flex items-center justify-center text-2xl shadow-sm" title="Cemas">😰</button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Kolom Kiri: Sesi Mendatang & Rekomendasi (Lebar 2/3) -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Sesi Mendatang -->
                <div>
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-800">Sesi Mendatang</h3>
                        <a href="{{ route('user.schedule.index') }}" class="text-sm font-semibold text-[#D98324] hover:text-[#b36a1b] transition-colors flex items-center gap-1">
                            Lihat Semua <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                    
                    <!-- Card Sesi Mendatang -->
                    @if($upcomingSession)
                    <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-[0_8px_30_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30_rgb(0,0,0,0.08)] transition-all duration-300 flex flex-col sm:flex-row gap-6 items-center">
                        <!-- Date Badge -->
                        <div class="bg-[#EBF5F8] text-[#0A4D68] rounded-2xl p-4 flex flex-col items-center justify-center min-w-[90px] h-[100px] border border-blue-50">
                            <span class="text-sm font-bold uppercase tracking-wider text-blue-600/80">{{ \Carbon\Carbon::parse($upcomingSession->tanggal_janji)->translatedFormat('M') }}</span>
                            <span class="text-4xl font-black">{{ \Carbon\Carbon::parse($upcomingSession->tanggal_janji)->format('d') }}</span>
                        </div>
                        
                        <!-- Info -->
                        <div class="flex-1 text-center sm:text-left">
                            <div class="flex items-center justify-center sm:justify-start gap-2 mb-1">
                                <span class="bg-green-100 text-green-700 text-xs font-bold px-2.5 py-1 rounded-full uppercase tracking-wide">{{ $upcomingSession->status }}</span>
                                <span class="text-sm text-gray-500 font-medium"><i class="fa-regular fa-clock mr-1"></i> {{ \Carbon\Carbon::parse($upcomingSession->jam_janji)->format('H:i') }} WIB</span>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mt-2 mb-1">Konseling Individual</h4>
                            <p class="text-gray-500 text-sm font-medium">bersama <span class="text-[#0A4D68] font-bold">{{ $upcomingSession->psikolog->name }}</span></p>
                        </div>
                        
                        <!-- Action -->
                        <div class="w-full sm:w-auto">
                            @if($upcomingSession->status == 'dijadwalkan' || $upcomingSession->status == 'dikonfirmasi')
                            <a href="{{ route('user.schedule.room', $upcomingSession->id) }}" class="w-full sm:w-auto bg-[#0A4D68] hover:bg-[#07364a] text-white px-6 py-3 rounded-xl font-bold shadow-lg shadow-blue-900/20 transition-all hover:scale-105 flex items-center justify-center gap-2">
                                <i class="fa-solid fa-video"></i> Masuk Ruangan
                            </a>
                            @else
                            <button disabled class="w-full sm:w-auto bg-gray-300 text-white px-6 py-3 rounded-xl font-bold cursor-not-allowed flex items-center justify-center gap-2">
                                <i class="fa-solid fa-clock"></i> Belum Siap
                            </button>
                            @endif
                        </div>
                    </div>
                    @else
                    <div class="bg-white rounded-3xl p-10 border border-dashed border-gray-200 text-center">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300 text-2xl">
                            <i class="fa-solid fa-calendar-xmark"></i>
                        </div>
                        <p class="text-gray-500 font-medium italic">Tidak ada sesi mendatang. Yuk booking sekarang!</p>
                        <a href="{{ route('user.psychologist.index') }}" class="inline-block mt-4 text-[#0A4D68] font-bold hover:underline underline-offset-4">Cari Psikolog <i class="fa-solid fa-chevron-right text-[10px]"></i></a>
                    </div>
                    @endif
                </div>

                <!-- Rekomendasi Psikolog -->
                <div>
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-800">Rekomendasi Psikolog</h3>
                        <p class="text-sm font-medium text-gray-500 hidden sm:block">Berdasarkan hasil tes & preferensimu</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Card Psikolog 1 -->
                        <div class="bg-white rounded-3xl p-5 border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] group hover:-translate-y-1 transition-all duration-300">
                            <div class="flex items-start gap-4">
                                <div class="w-16 h-16 rounded-2xl overflow-hidden bg-gray-100">
                                    <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&q=80&w=200" alt="Psikolog" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900">Tiara Andini, M.Psi</h4>
                                    <p class="text-xs font-semibold text-[#D98324] mb-2">Psikolog Klinis</p>
                                    <div class="flex gap-1 text-xs text-gray-500">
                                        <span class="bg-gray-50 px-2 py-1 rounded-md">Kecemasan</span>
                                        <span class="bg-gray-50 px-2 py-1 rounded-md">Karir</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 pt-4 border-t border-gray-50 flex justify-between items-center">
                                <div class="text-xs text-gray-500 font-medium">
                                    <i class="fa-solid fa-star text-yellow-400"></i> 4.9 (120+ sesi)
                                </div>
                                <a href="{{ route('user.psychologist.index') }}" class="text-[#0A4D68] text-sm font-bold hover:text-[#D98324] transition-colors">Lihat Profil</a>
                            </div>
                        </div>

                        <!-- Card Psikolog 2 -->
                        <div class="bg-white rounded-3xl p-5 border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] group hover:-translate-y-1 transition-all duration-300">
                            <div class="flex items-start gap-4">
                                <div class="w-16 h-16 rounded-2xl overflow-hidden bg-gray-100">
                                    <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&q=80&w=200" alt="Psikolog" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900">Dr. Andi Pratama</h4>
                                    <p class="text-xs font-semibold text-[#D98324] mb-2">Psikolog Klinis</p>
                                    <div class="flex gap-1 text-xs text-gray-500">
                                        <span class="bg-gray-50 px-2 py-1 rounded-md">Trauma</span>
                                        <span class="bg-gray-50 px-2 py-1 rounded-md">Depresi</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 pt-4 border-t border-gray-50 flex justify-between items-center">
                                <div class="text-xs text-gray-500 font-medium">
                                    <i class="fa-solid fa-star text-yellow-400"></i> 5.0 (200+ sesi)
                                </div>
                                <a href="{{ route('user.psychologist.index') }}" class="text-[#0A4D68] text-sm font-bold hover:text-[#D98324] transition-colors">Lihat Profil</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Kolom Kanan: Mood Tracker & Quick Actions -->
            <div class="space-y-8">
                
                <!-- Mood Tracker Card -->
                <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-orange-50 text-[#D98324] flex items-center justify-center text-xl">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Mood Tracker</h3>
                    </div>
                    
                    <p class="text-sm text-gray-500 mb-6 font-medium leading-relaxed">
                        Belum mencatat perasaanmu secara detail hari ini. Yuk catat untuk memonitor perkembanganmu!
                    </p>
                    
                    <button class="w-full bg-[#EBF5F8] hover:bg-[#d6ecf3] text-[#0A4D68] border border-blue-100 py-3 rounded-xl font-bold transition-all flex items-center justify-center gap-2 mb-6">
                        <i class="fa-solid fa-pen-to-square"></i> Jurnal Hari Ini
                    </button>

                    <!-- Mini chart placeholder -->
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Statistik 7 Hari Terakhir</p>
                        <div class="flex items-end justify-between h-24 gap-2 pt-2 border-b border-gray-100 pb-2">
                            <!-- Bars -->
                            <div class="w-full bg-blue-50 rounded-t-md h-[40%] hover:bg-[#D98324] transition-colors relative group"><span class="absolute -top-6 left-1/2 -translate-x-1/2 bg-gray-800 text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100">Sn</span></div>
                            <div class="w-full bg-blue-50 rounded-t-md h-[60%] hover:bg-[#D98324] transition-colors relative group"><span class="absolute -top-6 left-1/2 -translate-x-1/2 bg-gray-800 text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100">Sl</span></div>
                            <div class="w-full bg-blue-50 rounded-t-md h-[30%] hover:bg-[#D98324] transition-colors relative group"><span class="absolute -top-6 left-1/2 -translate-x-1/2 bg-gray-800 text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100">Rb</span></div>
                            <div class="w-full bg-[#0A4D68] rounded-t-md h-[80%] hover:bg-[#D98324] transition-colors shadow-sm relative group"><span class="absolute -top-6 left-1/2 -translate-x-1/2 bg-gray-800 text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100">Km</span></div>
                            <div class="w-full bg-blue-50 rounded-t-md h-[50%] hover:bg-[#D98324] transition-colors relative group"><span class="absolute -top-6 left-1/2 -translate-x-1/2 bg-gray-800 text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100">Jm</span></div>
                            <div class="w-full bg-blue-50 rounded-t-md h-[70%] hover:bg-[#D98324] transition-colors relative group"><span class="absolute -top-6 left-1/2 -translate-x-1/2 bg-gray-800 text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100">Sb</span></div>
                            <div class="w-full bg-gray-100 rounded-t-md h-[20%] border border-dashed border-gray-300"></div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Akses Cepat</h3>
                    <div class="space-y-3">
                        <a href="{{ route('test_psikologi') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition-colors group">
                            <div class="w-10 h-10 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-clipboard-question"></i>
                            </div>
                            <span class="font-medium text-gray-700 group-hover:text-indigo-600 transition-colors">Tes Kesehatan Mental</span>
                        </a>
                        <a href="{{ route('user.chat') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition-colors group">
                            <div class="w-10 h-10 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-robot"></i>
                            </div>
                            <span class="font-medium text-gray-700 group-hover:text-teal-600 transition-colors">Chat AI Teman Cerita</span>
                        </a>
                        <a href="{{ route('user.psychologist.index') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition-colors group">
                            <div class="w-10 h-10 rounded-lg bg-[#EBF5F8] text-[#0A4D68] flex items-center justify-center group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-calendar-plus"></i>
                            </div>
                            <span class="font-medium text-gray-700 group-hover:text-[#0A4D68] transition-colors">Booking Konseling Baru</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Sertakan CDN FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</x-guest-layout>
