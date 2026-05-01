<x-guest-layout>
    @include('landing_page.style')
    @include('landing_page.navbar')

    <div class="bg-gray-50 min-h-screen pb-20 pt-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ 
            activeTab: 'semua', 
            searchQuery: '',
            selectedTypes: [],
            selectedSpecs: []
        }">
            
            <div class="flex flex-col lg:flex-row gap-8">
                
                <!-- Sidebar Filter -->
                <div class="w-full lg:w-1/4">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 lg:sticky lg:top-28">
                        
                        <!-- Accordion: Jenis Layanan -->
                        <div x-data="{ open: true }" class="border-b border-gray-100 py-3">
                            <button @click="open = !open" class="flex justify-between items-center w-full text-left font-bold text-gray-900 mb-2 focus:outline-none">
                                Jenis Layanan
                                <i class="fas text-sm text-gray-500 transition-transform" :class="open ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                            </button>
                            <div x-show="open" x-collapse class="mt-3">
                                <div>
                                    <p class="text-xs text-gray-500 font-semibold mb-2 ml-1">e-Counseling</p>
                                    <div class="space-y-2 ml-2">
                                        <label class="flex items-center gap-3 cursor-pointer group">
                                            <input type="checkbox" checked class="rounded border-gray-300 text-[#0A4D68] focus:ring-[#0A4D68] w-4 h-4 transition-colors">
                                            <span class="text-sm text-gray-600 group-hover:text-[#0A4D68] transition-colors">Essential</span>
                                        </label>
                                        <label class="flex items-center gap-3 cursor-pointer group">
                                            <input type="checkbox" checked class="rounded border-gray-300 text-[#0A4D68] focus:ring-[#0A4D68] w-4 h-4 transition-colors">
                                            <span class="text-sm text-gray-600 group-hover:text-[#0A4D68] transition-colors">Premium</span>
                                        </label>
                                        <label class="flex items-center gap-3 cursor-pointer group">
                                            <input type="checkbox" checked class="rounded border-gray-300 text-[#0A4D68] focus:ring-[#0A4D68] w-4 h-4 transition-colors">
                                            <span class="text-sm text-gray-600 group-hover:text-[#0A4D68] transition-colors">Basic</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Accordion: Jenis Psikolog -->
                        <div x-data="{ open: true }" class="border-b border-gray-100 py-4">
                            <button @click="open = !open" class="flex justify-between items-center w-full text-left font-bold text-gray-900 mb-2 focus:outline-none">
                                Jenis Psikolog
                                <i class="fas text-sm text-gray-500 transition-transform" :class="open ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                            </button>
                            <div x-show="open" x-collapse class="mt-3">
                                <div class="space-y-2 ml-1 max-h-48 overflow-y-auto custom-scrollbar pr-2">
                                    @foreach($clinicalTypes as $type)
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input type="checkbox" value="{{ $type->id }}" x-model="selectedTypes" class="rounded border-gray-300 text-[#0A4D68] focus:ring-[#0A4D68] w-4 h-4 transition-colors">
                                        <span class="text-sm text-gray-600 group-hover:text-[#0A4D68] transition-colors">{{ $type->name }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Accordion: Topik Keahlian -->
                        <div x-data="{ open: true }" class="py-4">
                            <button @click="open = !open" class="flex justify-between items-center w-full text-left font-bold text-gray-900 mb-2 focus:outline-none">
                                Topik Keahlian
                                <i class="fas text-sm text-gray-500 transition-transform" :class="open ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                            </button>
                            <div x-show="open" x-collapse class="mt-3">
                                <div class="space-y-2 ml-1 max-h-60 overflow-y-auto custom-scrollbar pr-2">
                                    @foreach($specializations as $spec)
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input type="checkbox" value="{{ $spec->id }}" x-model="selectedSpecs" class="rounded border-gray-300 text-[#0A4D68] focus:ring-[#0A4D68] w-4 h-4 transition-colors">
                                        <span class="text-sm text-gray-600 group-hover:text-[#0A4D68] transition-colors">{{ $spec->name }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Main Content -->
                <div class="w-full lg:w-3/4">
                    
                    <!-- Top Tabs -->
                    <div class="flex bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 mb-6 p-1.5">
                        <button @click="activeTab = 'jadwal'" 
                            class="flex-1 py-3.5 text-center font-bold text-sm rounded-lg transition-all duration-300 relative"
                            :class="activeTab === 'jadwal' ? 'bg-[#0A4D68] text-white shadow-md' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-50'">
                            Jadwal Psikolog
                        </button>
                        <button @click="activeTab = 'semua'" 
                            class="flex-1 py-3.5 text-center font-bold text-sm rounded-lg transition-all duration-300 relative"
                            :class="activeTab === 'semua' ? 'bg-[#0A4D68] text-white shadow-md' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-50'">
                            Semua Psikolog
                        </button>
                    </div>

                    <!-- Search and Filters for Jadwal Tab -->
                    <div x-show="activeTab === 'jadwal'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="mb-6 space-y-4" style="display: none;">
                        <div class="flex flex-col md:flex-row gap-3">
                            <select class="w-full md:w-1/4 border-gray-200 focus:border-[#0A4D68] focus:ring focus:ring-[#0A4D68] focus:ring-opacity-20 rounded-xl text-sm text-gray-600 shadow-sm py-3 px-4">
                                <option>Semua Hari</option>
                                <option>Senin</option>
                                <option>Selasa</option>
                                <option>Rabu</option>
                                <option>Kamis</option>
                                <option>Jumat</option>
                                <option>Sabtu</option>
                                <option>Minggu</option>
                            </select>
                            <select class="w-full md:w-1/4 border-gray-200 focus:border-[#0A4D68] focus:ring focus:ring-[#0A4D68] focus:ring-opacity-20 rounded-xl text-sm text-gray-600 shadow-sm py-3 px-4">
                                <option>Semua Waktu</option>
                                <option>Pagi (08:00 - 12:00)</option>
                                <option>Siang (12:00 - 15:00)</option>
                                <option>Sore (15:00 - 18:00)</option>
                                <option>Malam (18:00 - 21:00)</option>
                            </select>
                            <div class="w-full md:w-2/4 flex shadow-sm rounded-xl">
                                <input type="text" placeholder="Masukkan nama psikolog" class="flex-1 border-gray-200 focus:border-[#0A4D68] focus:ring focus:ring-[#0A4D68] focus:ring-opacity-20 rounded-l-xl text-sm py-3 px-4" x-model="searchQuery">
                                <button class="bg-[#0A4D68] text-white px-6 rounded-r-xl hover:bg-[#083344] transition-colors flex items-center justify-center">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Date Slider -->
                        <div class="flex items-center gap-3 overflow-x-auto pb-3 custom-scrollbar snap-x">
                            <div class="snap-start flex-shrink-0 bg-[#0A4D68] text-white rounded-xl p-3 text-center w-[130px] flex flex-col justify-center items-center h-20 shadow-md">
                                <i class="far fa-calendar-alt text-xl mb-1.5 opacity-90"></i>
                                <span class="text-[10px] leading-tight font-medium opacity-90">Pilih Tanggal</span>
                                <span class="text-xs font-bold mt-0.5">2 Mei - 16 Mei</span>
                            </div>
                            <div class="snap-start flex-shrink-0 bg-[#0A4D68] text-white rounded-xl p-3 text-center w-[90px] flex flex-col justify-center items-center h-20 shadow-md">
                                <span class="text-sm font-bold leading-tight">Semua<br>Jadwal</span>
                            </div>
                            @php
                                $dates = [
                                    ['date' => '2 Mei', 'day' => 'Sabtu'],
                                    ['date' => '3 Mei', 'day' => 'Minggu'],
                                    ['date' => '4 Mei', 'day' => 'Senin'],
                                    ['date' => '5 Mei', 'day' => 'Selasa'],
                                    ['date' => '6 Mei', 'day' => 'Rabu'],
                                    ['date' => '7 Mei', 'day' => 'Kamis'],
                                    ['date' => '8 Mei', 'day' => 'Jumat'],
                                    ['date' => '9 Mei', 'day' => 'Sabtu'],
                                ];
                            @endphp
                            @foreach($dates as $d)
                            <div class="snap-start flex-shrink-0 bg-white border border-gray-200 hover:border-[#0A4D68] hover:shadow-sm text-gray-500 rounded-xl p-3 text-center w-[90px] flex flex-col justify-center items-center h-20 cursor-pointer transition-all">
                                <span class="text-xs">{{ $d['date'] }}</span>
                                <span class="text-sm font-bold text-gray-800">{{ $d['day'] }}</span>
                            </div>
                            @endforeach
                        </div>
                        
                        <!-- Progress line visual -->
                        <div class="h-1.5 w-full bg-gray-200 rounded-full mt-2 overflow-hidden">
                            <div class="h-full bg-[#0A4D68] w-2/3 rounded-full"></div>
                        </div>
                    </div>

                    <!-- Search and Filters for Semua Psikolog Tab -->
                    <div x-show="activeTab === 'semua'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="mb-6 space-y-4">
                        <div class="flex flex-col md:flex-row gap-3">
                            <select class="w-full md:w-1/3 border-gray-200 focus:border-[#0A4D68] focus:ring focus:ring-[#0A4D68] focus:ring-opacity-20 rounded-xl text-sm text-gray-600 shadow-sm py-3 px-4">
                                <option>Nama Psikolog A-Z</option>
                                <option>Nama Psikolog Z-A</option>
                                <option>Pengalaman Terlama</option>
                                <option>Harga Terendah</option>
                                <option>Harga Tertinggi</option>
                            </select>
                            <div class="w-full md:w-2/3 flex shadow-sm rounded-xl">
                                <input type="text" placeholder="Masukkan nama psikolog" class="flex-1 border-gray-200 focus:border-[#0A4D68] focus:ring focus:ring-[#0A4D68] focus:ring-opacity-20 rounded-l-xl text-sm py-3 px-4" x-model="searchQuery">
                                <button class="bg-[#0A4D68] text-white px-6 rounded-r-xl hover:bg-[#083344] transition-colors flex items-center justify-center">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- List of Psychologists -->
                    <div class="space-y-5">
                        @forelse($psychologists as $psikolog)
                        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-lg transition-all duration-300"
                             x-data="{
                                name: '{{ strtolower(addslashes($psikolog->name)) }}',
                                typeId: '{{ $psikolog->clinical_type_id }}',
                                specs: [{{ $psikolog->specializations->pluck('id')->implode(',') }}]
                             }"
                             x-show="
                                (searchQuery === '' || name.includes(searchQuery.toLowerCase())) &&
                                (selectedTypes.length === 0 || selectedTypes.includes(typeId)) &&
                                (selectedSpecs.length === 0 || specs.some(s => selectedSpecs.includes(s.toString())))
                             ">
                            
                            <div class="flex flex-col md:flex-row items-center md:items-start gap-6 w-full">
                                <!-- Foto Profil -->
                                <div class="flex-shrink-0 relative">
                                    <div class="w-28 h-28 md:w-32 md:h-32 rounded-full p-1 bg-gradient-to-tr from-gray-100 to-gray-200">
                                        <img src="{{ asset($psikolog->photo ? 'storage/' . $psikolog->photo : 'images/default-avatar.png') }}" 
                                            alt="{{ $psikolog->name }}" 
                                            class="w-full h-full rounded-full object-cover border-2 border-white">
                                    </div>
                                </div>

                                <!-- Detail Informasi -->
                                <div class="flex-1 text-center md:text-left w-full pt-1">
                                    <!-- Labels -->
                                    <div class="flex flex-wrap justify-center md:justify-start items-center gap-2 mb-3">
                                        <span class="bg-orange-50 text-[#D98324] text-[11px] font-extrabold px-3 py-1.5 rounded-full uppercase tracking-wider">
                                            {{ $psikolog->clinicalType->name ?? 'Psikolog Klinis Umum' }}
                                        </span>
                                        <span class="bg-green-50 text-green-600 text-[11px] font-bold px-3 py-1.5 rounded-full flex items-center gap-1.5">
                                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span> Tersedia
                                        </span>
                                    </div>

                                    <!-- Nama & Gelar -->
                                    <h3 class="text-xl font-extrabold text-[#0A4D68] mb-3 leading-snug">
                                        {{ $psikolog->name }}
                                    </h3>

                                    <!-- Statistik -->
                                    <div class="flex flex-wrap justify-center md:justify-start items-center gap-x-6 gap-y-2 text-sm text-gray-600 font-medium mb-4">
                                        <span class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full bg-blue-50 flex items-center justify-center text-[#0A4D68]">
                                                <i class="fas fa-user-friends text-xs"></i>
                                            </div>
                                            {{ number_format($psikolog->total_sessions ?? rand(50, 5000)) }}+ Sesi
                                        </span>
                                        <span class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full bg-teal-50 flex items-center justify-center text-teal-600">
                                                <i class="fas fa-thumbs-up text-xs"></i>
                                            </div>
                                            {{ $psikolog->satisfaction_rate ?? rand(95, 100) }}% Terbantu ({{ rand(50, 500) }} Ulasan)
                                        </span>
                                        <span class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full bg-orange-50 flex items-center justify-center text-[#D98324]">
                                                <i class="fas fa-briefcase text-xs"></i>
                                            </div>
                                            @if($psikolog->experience_years > 10) > 10 Tahun @else {{ $psikolog->experience_years }} Tahun @endif
                                        </span>
                                    </div>
                                    
                                    <!-- Dynamic content based on active tab -->
                                    <div class="mt-4 flex flex-col md:flex-row justify-between items-center w-full border-t border-gray-50 pt-4">
                                        
                                        <!-- For Jadwal Tab -->
                                        <div x-show="activeTab === 'jadwal'" class="w-full text-center md:text-left mb-4 md:mb-0" style="display: none;">
                                            @if($psikolog->schedules && $psikolog->schedules->count() > 0)
                                                <p class="text-sm text-gray-700">
                                                    Jadwal Tersedia: <span class="font-bold text-[#0A4D68]">{{ $psikolog->schedules->first()->day }}, {{ \Carbon\Carbon::parse($psikolog->schedules->first()->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($psikolog->schedules->first()->end_time)->format('H:i') }} WIB</span>
                                                </p>
                                            @else
                                                <p class="text-sm text-gray-700">
                                                    Jadwal Tersedia: <span class="italic text-gray-400">Belum ada jadwal</span>
                                                </p>
                                            @endif
                                        </div>

                                        <!-- For Semua Tab -->
                                        <div x-show="activeTab === 'semua'" class="w-full text-center md:text-left mb-4 md:mb-0">
                                            <div class="flex flex-wrap justify-center md:justify-start gap-1.5">
                                                @foreach($psikolog->specializations->take(3) as $spec)
                                                <span class="bg-gray-100 text-gray-600 text-xs font-semibold px-3 py-1 rounded-lg border border-gray-200">
                                                    {{ $spec->name }}
                                                </span>
                                                @endforeach
                                                @if($psikolog->specializations->count() > 3)
                                                <span class="bg-gray-100 text-gray-600 text-xs font-semibold px-2 py-1 rounded-lg border border-gray-200">
                                                    +{{ $psikolog->specializations->count() - 3 }}
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="flex-shrink-0 w-full md:w-auto">
                                            <a href="{{ route('user.psychologist.detail', $psikolog->id) }}" x-show="activeTab === 'jadwal'" style="display: none;" class="w-full md:w-auto bg-[#D98324] hover:bg-[#c47520] text-white font-bold py-2.5 px-8 rounded-full shadow-lg shadow-orange-200/50 transition-all transform active:scale-95 text-sm inline-flex items-center justify-center gap-2">
                                                Booking Sesi
                                            </a>
                                            <a href="{{ route('user.psychologist.detail', $psikolog->id) }}" x-show="activeTab === 'semua'" class="w-full md:w-auto bg-[#D98324] hover:bg-[#c47520] text-white font-bold py-2.5 px-8 rounded-full shadow-lg shadow-orange-200/50 transition-all transform active:scale-95 text-sm inline-flex items-center justify-center gap-2">
                                                Lihat Selengkapnya
                                            </a>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-16 bg-white rounded-3xl border border-gray-100 shadow-sm">
                            <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-search text-3xl text-gray-300"></i>
                            </div>
                            <h3 class="text-xl font-bold text-[#0A4D68] mb-2">Psikolog tidak ditemukan</h3>
                            <p class="text-sm text-gray-500 max-w-sm mx-auto">Kami tidak dapat menemukan psikolog dengan filter yang Anda pilih. Silakan sesuaikan kembali.</p>
                        </div>
                        @endforelse

                        <!-- Empty state when Alpine JS filters hide all cards -->
                        @if(count($psychologists) > 0)
                        <div x-show="
                            Array.from(document.querySelectorAll('[x-data^=\'{ name\']')).filter(el => el.style.display !== 'none').length === 0
                        " style="display: none;" class="text-center py-16 bg-white rounded-3xl border border-gray-100 shadow-sm">
                            <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-search text-3xl text-gray-300"></i>
                            </div>
                            <h3 class="text-xl font-bold text-[#0A4D68] mb-2">Tidak ada kecocokan</h3>
                            <p class="text-sm text-gray-500 max-w-sm mx-auto">Tidak ada psikolog yang sesuai dengan filter atau kata kunci Anda.</p>
                        </div>
                        @endif
                    </div>

                </div>
            </div>
            
        </div>
    </div>

    @push('styles')
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            height: 6px;
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
    @endpush
    
    @push('scripts')
    <!-- Alpine JS Plugin for Collapse (if not loaded) -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    @endpush
</x-guest-layout>