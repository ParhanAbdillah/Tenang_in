<x-guest-layout>
    <div class="max-w-5xl mx-auto p-6 bg-gray-50">
    <div class="space-y-6">
        @foreach($psychologists as $psikolog)
        <div class="bg-white border border-gray-100 rounded-[2rem] p-6 flex flex-col md:flex-row items-center md:items-start gap-6 shadow-sm hover:shadow-md transition-all">
            
            <!-- Foto Profil -->
            <div class="flex-shrink-0">
                <img src="{{ asset('storage/' . $psikolog->photo) }}" 
                     alt="{{ $psikolog->name }}" 
                     class="w-32 h-32 md:w-40 md:h-40 rounded-full object-cover border-4 border-white shadow-sm">
            </div>

            <!-- Detail Informasi -->
            <div class="flex-1 text-center md:text-left">
                <!-- Clinical Type Label -->
                <p class="text-[#e68a2e] text-sm font-bold uppercase tracking-wide mb-1">
                    {{ $psikolog->clinicalType->name ?? 'Psikolog Klinis Umum' }}
                </p>

                <!-- Nama & Gelar -->
                <h3 class="text-2xl font-extrabold text-gray-900 mb-2">
                    {{ $psikolog->name }}
                </h3>

                <!-- Statistik Bar -->
                <div class="flex flex-wrap justify-center md:justify-start items-center gap-x-6 gap-y-2 text-sm text-gray-500 font-medium mb-4">
                    <span class="flex items-center gap-2">
                        <i class="fas fa-user-friends text-blue-500"></i> 
                        {{ number_format($psikolog->total_sessions) }}+ Sesi
                    </span>
                    <span class="flex items-center gap-2">
                        <i class="fas fa-thumbs-up text-emerald-500"></i> 
                        {{ $psikolog->satisfaction_rate }}% Terbantu ({{ $psikolog->total_reviews ?? 0 }} Ulasan)
                    </span>
                    <span class="flex items-center gap-2">
                        <i class="fas fa-briefcase text-orange-400"></i> 
                        @if($psikolog->experience_years > 10) > 10 Tahun @else {{ $psikolog->experience_years }} Tahun @endif
                    </span>
                </div>

                <!-- Info Jadwal -->
                <p class="text-gray-700 text-sm mb-4">
                    <span class="font-bold text-gray-900">Jadwal Tersedia:</span> 13:30 - 14:30 WIB
                </p>

                <!-- List Spesialisasi (Badges) -->
                <div class="flex flex-wrap justify-center md:justify-start gap-2">
                    @foreach($psikolog->specializations as $spec)
                    <span class="bg-gray-100 text-gray-700 text-[11px] font-bold px-3 py-1.5 rounded-lg border border-gray-200">
                        {{ $spec->name }}
                    </span>
                    @endforeach
                </div>
            </div>

            <!-- Bagian Aksi (Harga & Tombol) -->
            <div class="flex flex-col items-center md:items-end justify-between self-stretch pt-2">
                <div class="hidden md:block">
                    <!-- Placeholder untuk harga jika ingin ditampilkan -->
                    <p class="text-xs text-gray-400 text-right mb-1">Mulai dari</p>
                    <p class="text-lg font-bold text-gray-900">Rp {{ number_format($psikolog->price_per_session) }}</p>
                </div>
                
                <button class="w-full md:w-auto bg-[#e68a2e] text-white font-bold py-3 px-10 rounded-2xl shadow-lg shadow-orange-200 hover:bg-orange-600 active:scale-95 transition-all mt-4 md:mt-0">
                    Booking Sesi
                </button>
            </div>
        </div>
        @endforeach
    </div>
</div>
</x-guest-layout>