<x-guest-layout>
    @include('landing_page.navbar')
    
    <div class="pt-32 pb-10 bg-slate-50 min-h-screen font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Jadwal Saya</h2>
                    <p class="text-gray-500 font-medium mt-1">Kelola dan lihat riwayat sesi konseling Anda.</p>
                </div>
                <a href="{{ route('user.psychologist.index') }}" class="bg-[#D98324] hover:bg-[#b36a1b] text-white px-6 py-3 rounded-2xl font-bold shadow-lg shadow-orange-900/10 transition-all hover:scale-105 flex items-center gap-2">
                    <i class="fa-solid fa-plus"></i> Booking Baru
                </a>
            </div>

            <!-- List Jadwal -->
            <div class="grid grid-cols-1 gap-6">
                @forelse($appointments as $item)
                <div class="bg-white rounded-[2.5rem] p-6 md:p-8 border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] flex flex-col md:flex-row items-center gap-8 group hover:shadow-[0_8px_40px_rgb(0,0,0,0.08)] transition-all duration-500">
                    
                    <!-- Date Section -->
                    <div class="flex flex-col items-center justify-center bg-[#EBF5F8] text-[#0A4D68] w-24 h-24 rounded-3xl shrink-0 border border-blue-50 group-hover:scale-110 transition-transform duration-500">
                        <span class="text-xs font-black uppercase tracking-[0.2em] opacity-60">{{ \Carbon\Carbon::parse($item->tanggal_janji)->translatedFormat('M') }}</span>
                        <span class="text-4xl font-black leading-none mt-1">{{ \Carbon\Carbon::parse($item->tanggal_janji)->format('d') }}</span>
                    </div>

                    <!-- Details -->
                    <div class="flex-1 text-center md:text-left">
                        <div class="flex flex-wrap items-center justify-center md:justify-start gap-3 mb-3">
                            @php
                                $statusColors = [
                                    'menunggu' => 'bg-yellow-50 text-yellow-700 border-yellow-100',
                                    'dijadwalkan' => 'bg-green-50 text-green-700 border-green-100',
                                    'selesai' => 'bg-blue-50 text-blue-700 border-blue-100',
                                    'dibatalkan' => 'bg-red-50 text-red-700 border-red-100',
                                ];
                                $colorClass = $statusColors[$item->status] ?? 'bg-gray-50 text-gray-700 border-gray-100';
                            @endphp
                            <span class="{{ $colorClass }} border px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-widest">{{ $item->status }}</span>
                            <span class="text-sm text-gray-400 font-bold flex items-center gap-1.5"><i class="fa-regular fa-clock text-gray-300"></i> {{ \Carbon\Carbon::parse($item->jam_janji)->format('H:i') }} WIB</span>
                        </div>
                        
                        <h3 class="text-2xl font-extrabold text-[#0A4D68] mb-2">Konseling Individual</h3>
                        <div class="flex items-center justify-center md:justify-start gap-3">
                            <div class="w-10 h-10 rounded-xl bg-gray-100 overflow-hidden shrink-0 border-2 border-white shadow-sm">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($item->psikolog->name) }}&background=0A4D68&color=fff" class="w-full h-full object-cover">
                            </div>
                            <div class="text-left">
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-0.5">Psikolog</p>
                                <p class="text-sm font-bold text-gray-700">{{ $item->psikolog->name }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="shrink-0 w-full md:w-auto">
                        @if($item->status == 'dijadwalkan' || $item->status == 'dikonfirmasi')
                            <a href="{{ route('user.schedule.room', $item->id) }}" class="w-full md:w-auto inline-flex items-center justify-center gap-3 bg-[#0A4D68] hover:bg-[#083a4f] text-white px-8 py-4 rounded-2xl font-bold transition-all hover:scale-105 shadow-xl shadow-blue-900/20">
                                <i class="fa-solid fa-video text-lg"></i>
                                Masuk Ruangan
                            </a>
                        @elseif($item->status == 'menunggu')
                            <div class="bg-gray-50 border border-gray-100 px-6 py-4 rounded-2xl text-center">
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Menunggu Konfirmasi</p>
                                <p class="text-[10px] text-gray-500 font-medium">Psikolog akan segera meninjau.</p>
                            </div>
                        @elseif($item->status == 'selesai')
                            <button class="w-full md:w-auto inline-flex items-center justify-center gap-2 bg-indigo-50 text-indigo-600 px-8 py-4 rounded-2xl font-bold border border-indigo-100">
                                <i class="fa-solid fa-star"></i>
                                Beri Rating
                            </button>
                        @endif
                    </div>
                </div>
                @empty
                <div class="bg-white rounded-[3rem] p-20 border border-dashed border-gray-200 text-center">
                    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-300 text-4xl">
                        <i class="fa-solid fa-calendar-xmark"></i>
                    </div>
                    <h3 class="text-2xl font-extrabold text-gray-800 mb-2">Belum ada jadwal</h3>
                    <p class="text-gray-500 font-medium mb-8">Anda belum memiliki riwayat atau jadwal konseling aktif.</p>
                    <a href="{{ route('user.psychologist.index') }}" class="bg-[#0A4D68] text-white px-10 py-4 rounded-2xl font-extrabold hover:scale-105 transition-all shadow-xl shadow-blue-900/10">
                        Cari Psikolog Sekarang
                    </a>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</x-guest-layout>
