<x-guest-layout>
    @include('landing_page.style')
    @include('landing_page.navbar')

    <style>
        /* Hide scrollbar for Chrome, Safari and Opera */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        /* Hide scrollbar for IE, Edge and Firefox */
        .scrollbar-hide {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>

    @php $psychologist = $psychologist ?? $psikolog ?? null; @endphp

    <div class="bg-gray-50 min-h-screen pb-32 pt-32" x-data="{ 
        selectedDate: null,
        selectedTime: null,
        tabType: 'Online',
        basePrice: {{ $psychologist->price_per_session ?? 299000 }},
        price: {{ $psychologist->price_per_session ?? 299000 }},
        step: 1
    }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-6 items-start">
                
                <!-- Left Panel: Profile Info (Sidebar) -->
                <div class="w-full md:w-[300px] flex-shrink-0 md:sticky md:top-32">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex flex-col items-center text-center">
                            <div class="w-32 h-32 md:w-40 md:h-40 rounded-full mb-4 overflow-hidden bg-gray-100 ring-4 ring-orange-400">
                                <img src="{{ asset($psychologist->photo ? 'storage/' . $psychologist->photo : 'images/default-avatar.png') }}" 
                                     alt="{{ $psychologist->name }}" 
                                     class="w-full h-full object-cover">
                            </div>
                            
                            <p class="text-[#4392B3] text-xs font-semibold mb-1">
                                {{ $psychologist->clinical_type ?? $psychologist->clinicalType->name ?? 'Psikolog Klinis Umum' }}
                            </p>
                            <h1 class="text-base font-bold text-gray-900 mb-4 leading-snug">
                                {{ $psychologist->name }}
                            </h1>

                            <div class="space-y-2 w-full text-left mb-6">
                                <div class="flex items-center gap-2 text-xs text-gray-600">
                                    <i class="fas fa-users text-[#0A4D68]"></i>
                                    <span>{{ number_format($psychologist->total_sessions ?? 0) }}+ Sesi</span>
                                </div>
                                <div class="flex items-center gap-2 text-xs text-gray-600">
                                    <i class="fas fa-star text-orange-400"></i>
                                    <span>{{ $psychologist->satisfaction_rate ?? 0 }}% Terbantu</span>
                                </div>
                                <div class="flex items-center gap-2 text-xs text-gray-600">
                                    <i class="fas fa-briefcase text-[#D98324]"></i>
                                    <span>@if($psychologist->experience_years > 10) > 10 @else {{ $psychologist->experience_years }} @endif Tahun</span>
                                </div>
                                <div class="flex items-center gap-2 text-xs text-gray-600">
                                    <i class="fas fa-map-pin text-rose-600"></i>
                                    <span>Tasikmalaya</span>
                                </div>
                            </div>

                            <button @click="document.getElementById('jadwal-section').scrollIntoView({behavior: 'smooth'})" class="w-full bg-[#D98324] hover:bg-[#c47520] text-white font-bold py-2.5 rounded-lg shadow-sm transition-colors text-sm">
                                Cari Jadwal
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right Panel: Details -->
                <div class="flex-1 space-y-6">
                    <!-- Bio & Credentials -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 relative">
                        <div class="absolute top-6 right-6 text-right">
                            <p class="text-[10px] font-bold text-gray-900 mb-1 flex items-center justify-end gap-1.5 uppercase tracking-widest">
                                <span>STR</span>
                                <i class="fas fa-info-circle text-orange-400 text-[10px]"></i>
                            </p>
                            <p class="text-gray-500 text-[11px] font-mono">{{ $psychologist->license_number ?? 'STR-2000' }}</p>
                        </div>

                        <h3 class="font-bold text-base text-gray-900 mb-4">Biografi</h3>
                        
                        <div class="text-gray-500 text-[13px] leading-relaxed text-justify max-w-[85%]">
                            @if($psychologist->bio)
                                {!! nl2br(e($psychologist->bio)) !!}
                            @else
                                <p>{{ $psychologist->name }} adalah psikolog klinis yang berfokus pada isu relasi seperti dinamika keluarga, hubungan romantis, pranikah, pernikahan, hingga berakhirnya hubungan. Ia percaya bahwa kualitas relasi sangat berpengaruh pada cara individu memahami diri, mengelola emosi, dan menjaga kesehatan mental.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Pendidikan & Topik Keahlian -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Pendidikan -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="font-bold text-base text-gray-900 mb-4">Pendidikan</h3>
                            @if($psychologist->educational_background)
                                <div class="text-sm text-gray-500 leading-relaxed space-y-3 whitespace-pre-line">
                                    {!! e($psychologist->educational_background) !!}
                                </div>
                            @else
                                <div class="space-y-4 text-[13px]">
                                    <div>
                                        <p class="font-medium text-gray-900">Universitas Indonesia</p>
                                        <p class="text-gray-500 text-xs mt-1">2017 - Sarjana Psikologi</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">Universitas Indonesia</p>
                                        <p class="text-gray-500 text-xs mt-1">2022 - Magister Profesi Psikologi</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Topik Keahlian -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="font-bold text-base text-gray-900 mb-4">Topik Keahlian</h3>
                            <div class="flex flex-wrap gap-2">
                                @forelse($psychologist->specializations as $spec)
                                    <span class="bg-[#E0F2FE] text-[#0369A1] text-xs px-3 py-1.5 rounded-full font-medium">
                                        {{ $spec->name }}
                                    </span>
                                @empty
                                    <span class="text-gray-400 text-sm italic">Belum ada topik keahlian.</span>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Jadwal Dan Layanan Tersedia -->
                    <div id="jadwal-section" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-6">
                            <h3 class="font-bold text-base text-gray-900 mb-6">Jadwal Dan Layanan Tersedia</h3>
                            
                            <!-- Pilih Layanan -->
                            <div class="flex items-center justify-between mb-6">
                                <p class="text-sm font-medium text-gray-700">Pilih Layanan</p>
                                <div class="bg-gray-50 p-1 rounded-lg border border-gray-100 flex">
                                    <button class="bg-gradient-to-r from-[#2B82A5] to-[#0A4D68] text-white px-6 py-1.5 rounded-md text-sm font-medium shadow-sm cursor-default">
                                        Online
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Harga Paket Basic -->
                            <div class="mb-6">
                                <p class="text-sm font-medium text-gray-700 mb-3">Paket Basic</p>
                                <div class="border-2 border-[#0A4D68] rounded-xl p-5 bg-[#F8FAFC] transition-all cursor-pointer relative overflow-hidden">
                                    <div class="absolute top-0 right-0 bg-[#0A4D68] text-white text-[10px] font-bold px-3 py-1 rounded-bl-lg">Terpilih</div>
                                    <p class="text-xs text-gray-500 mb-1 font-medium">Harga per sesi</p>
                                    <p class="text-2xl font-black text-[#0A4D68] mb-1">Rp {{ number_format($psychologist->price_per_session ?? 299000, 0, ',', '.') }}</p>
                                    <p class="text-[11px] text-gray-400">Konseling online via chat, voice call, atau video call</p>
                                </div>
                            </div>

                            <!-- Pilih Tanggal Dan Waktu -->
                            <div>
                                <p class="text-[13px] font-bold text-gray-800 mb-3">Pilih Tanggal Dan Waktu</p>
                                
                                @if($psychologist->schedules->count() > 0)
                                    <div class="mb-6">
                                        <!-- Date Pills -->
                                        <div class="grid grid-cols-4 md:grid-cols-7 gap-2 mb-4">
                                            @php
                                                $dates = [];
                                                for($i = 0; $i < 14; $i++) {
                                                    $date = \Carbon\Carbon::now()->addDays($i);
                                                    $dates[] = $date;
                                                }
                                                
                                                // Get Available Dates from Schedules
                                                $availableDates = $psychologist->schedules->pluck('schedule_date')->filter()->unique()->toArray();
                                                $availableDays = $psychologist->schedules->whereNull('schedule_date')->pluck('day')->unique()->toArray();
                                            @endphp

                                            @foreach($dates as $date)
                                                @php
                                                    $dayName = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'][$date->dayOfWeek];
                                                    $dateStr = $date->format('Y-m-d');
                                                    $dayNum = $date->format('j');
                                                    $monthName = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'][$date->month];
                                                    
                                                    // Check Availability
                                                    $isAvailable = in_array($dateStr, $availableDates) || (!in_array($dateStr, $availableDates) && in_array($dayName, $availableDays));
                                                @endphp
                                                <button @if($isAvailable) @click="selectedDate = '{{ $dateStr }}'; step = 2; selectedTime = null;" @endif
                                                        :class="selectedDate === '{{ $dateStr }}' ? 'bg-[#EBF5F8] text-[#0A4D68] border-[#0A4D68]' : '{{ $isAvailable ? 'bg-[#E5E7EB] text-gray-500 border-transparent hover:bg-gray-300' : 'bg-gray-50 text-gray-300 border-transparent cursor-not-allowed opacity-60' }}'"
                                                        class="w-full border rounded-xl py-2 px-1 text-center transition-all relative"
                                                        {{ !$isAvailable ? 'disabled' : '' }}>
                                                    
                                                    @if($isAvailable)
                                                        <div class="absolute top-1.5 right-1.5 w-2 h-2 bg-emerald-500 rounded-full shadow-sm"></div>
                                                    @endif

                                                    <div class="text-[11px] mb-0.5" :class="selectedDate === '{{ $dateStr }}' ? 'font-medium' : ''">{{ $dayNum }} {{ $monthName }}</div>
                                                    <div class="text-[13px] font-bold">{{ $dayName }}</div>
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Time Slots -->
                                    <div x-show="selectedDate" style="display: none;" class="animate-fade-up">
                                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                            @foreach($psychologist->schedules as $schedule)
                                                @php
                                                    $startTime = \Carbon\Carbon::parse($schedule->start_time)->format('H:i');
                                                    $endTime = \Carbon\Carbon::parse($schedule->end_time)->format('H:i');
                                                    $timeKey = $schedule->id . '-' . $startTime;
                                                @endphp
                                                <button @click="selectedTime = '{{ $timeKey }}'; step = 3"
                                                        x-show="'{{ $schedule->schedule_date }}' === selectedDate || (!'{{ $schedule->schedule_date }}' && '{{ $schedule->day }}' === ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'][new Date(selectedDate).getDay()])"
                                                        :class="selectedTime === '{{ $timeKey }}' ? 'bg-[#D98324] text-white border-[#D98324] shadow-md shadow-orange-200/50' : 'bg-white text-gray-700 border-gray-200 hover:border-[#0A4D68] hover:shadow-sm'"
                                                        class="border rounded-xl py-2.5 px-2 text-center transition-all cursor-pointer text-[12px] font-bold">
                                                    {{ $startTime }} - {{ $endTime }}
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="bg-orange-50 text-orange-700 rounded-xl p-6 text-center border border-orange-200">
                                        <i class="far fa-calendar-times text-2xl mb-2 block opacity-70"></i>
                                        <p class="text-sm font-medium">Belum ada jadwal yang tersedia untuk psikolog ini.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Ulasan -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="font-bold text-base text-gray-900 mb-6">Ulasan Klien</h3>
                        
                        <div class="space-y-6">
                            <!-- Mock Review 1 -->
                            <div class="border-b border-gray-100 pb-6 last:border-0">
                                <div class="flex justify-between items-start mb-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-[#0A4D68] text-white flex items-center justify-center font-bold text-sm">
                                            HD
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900 text-sm">Helmi D.</h4>
                                            <p class="text-xs text-gray-500">Sesi e-Counseling</p>
                                        </div>
                                    </div>
                                    <span class="text-xs text-gray-400">27 Mar 2026</span>
                                </div>
                                <div class="flex gap-0.5 mb-2">
                                    @for($i = 0; $i < 5; $i++)
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                    @endfor
                                </div>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    Konsultasinya sangat membantu. Psikolognya profesional, mendengarkan dengan baik, dan memberikan insight yang berguna.
                                </p>
                            </div>

                            <!-- Mock Review 2 -->
                            <div class="border-b border-gray-100 pb-6 last:border-0">
                                <div class="flex justify-between items-start mb-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-[#0A4D68] text-white flex items-center justify-center font-bold text-sm">
                                            YS
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900 text-sm">Yuli S.</h4>
                                            <p class="text-xs text-gray-500">Sesi e-Counseling</p>
                                        </div>
                                    </div>
                                    <span class="text-xs text-gray-400">26 Mar 2026</span>
                                </div>
                                <div class="flex gap-0.5 mb-2">
                                    @for($i = 0; $i < 5; $i++)
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                    @endfor
                                </div>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    Rekomendasi banget! Psikolog yang ramah dan mudah dipahami. Terima kasih sudah membantu.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Sticky Bottom Bar -->
        <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-lg z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
                <div class="flex items-center justify-between gap-4">
                    <!-- Progress Indicator -->
                    <div class="flex items-center gap-4">
                        <div class="relative w-12 h-12 flex items-center justify-center flex-shrink-0">
                            <svg class="w-12 h-12 transform -rotate-90">
                                <circle cx="24" cy="24" r="20" stroke="currentColor" stroke-width="3" fill="transparent" class="text-gray-200" />
                                <circle cx="24" cy="24" r="20" stroke="currentColor" stroke-width="3" fill="transparent" :stroke-dasharray="20 * 2 * Math.PI" :stroke-dashoffset="(20 * 2 * Math.PI) - ((20 * 2 * Math.PI) * (step / 3))" class="text-[#0A4D68] transition-all duration-500" />
                            </svg>
                            <span class="absolute text-xs font-bold text-gray-700" x-text="step + '/3'"></span>
                        </div>

                        <!-- Info -->
                        <div class="hidden sm:block flex-1">
                            <p class="text-xs text-gray-500">Pilihan Anda</p>
                            <p class="text-sm font-semibold text-gray-900">
                                <span x-show="step > 0">1x Sesi e-Counseling - Basic</span>
                                <span x-show="step === 0">-</span>
                            </p>
                        </div>

                        <div class="hidden md:block">
                            <p class="text-xs text-gray-500">Tanggal & Waktu</p>
                            <p class="text-sm font-semibold text-gray-900" x-text="selectedDate ? (selectedDate + (selectedTime ? ' | ' + selectedTime.split('-')[1] : '')) : '-'"></p>
                        </div>
                    </div>

                    <!-- Right Side: Total & Button -->
                    <div class="flex items-center gap-4">
                        <div class="text-right hidden sm:block">
                            <p class="text-xs text-gray-500">Total</p>
                            <p class="font-bold text-lg text-[#0A4D68]" x-text="step > 0 ? 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.floor(basePrice)) : '-'"></p>
                        </div>
                        <button @click="if(step === 3) window.location.href='/checkout?date=' + selectedDate + '&time=' + selectedTime" 
                                :disabled="step < 3" 
                                :class="step < 3 ? 'bg-gray-300 cursor-not-allowed' : 'bg-[#D98324] hover:bg-[#c47520] active:scale-95 shadow-md'"
                                class="text-white font-bold py-2.5 px-6 rounded-lg transition-all whitespace-nowrap text-sm">
                            Buat Janji
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>
