@extends('layouts.app')

@section('content')
    <div class="p-6 max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-4">
                <a href="{{ route('psychologist.consultations.index') }}" class="text-gray-500 hover:text-gray-700 transition">
                    <i class="fa-solid fa-arrow-left text-xl"></i>
                </a>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Ruang Konsultasi: {{ $janji->pasien->name }}</h2>
                    <p class="text-sm text-gray-500">ID Janji: #{{ $janji->order_id }}</p>
                </div>
            </div>
            <div class="flex items-center gap-2 px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-medium animate-pulse">
                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                Sesi Sedang Berlangsung
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Kolom Kiri & Tengah: Video Call (Area Utama) -->
            <div class="lg:col-span-3 space-y-6">
                <!-- Container Video Jitsi -->
                <div id="video-container" class="bg-black rounded-3xl shadow-xl overflow-hidden border-4 border-white relative" style="height: 75vh; min-height: 500px;">
                    <!-- Jitsi will be injected here automatically -->
                </div>

                <!-- Informasi Tambahan (Di bawah video) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <h3 class="text-sm font-bold mb-3 text-indigo-900 uppercase tracking-wider">Informasi Pasien</h3>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-bold">
                                {{ strtoupper(substr($janji->pasien->name, 0, 2)) }}
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">{{ $janji->pasien->name }}</p>
                                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($janji->tanggal_janji)->format('d F Y') }} ({{ $janji->jam_janji }})</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-indigo-50 p-6 rounded-2xl border border-indigo-100">
                        <h3 class="text-sm font-bold mb-2 text-indigo-900 uppercase tracking-wider">Keluhan Awal</h3>
                        <p class="text-gray-700 italic text-sm leading-relaxed">
                            "{{ $janji->catatan_keluhan ?? 'Tidak ada keluhan tertulis.' }}"
                        </p>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Catatan Konsultasi -->
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 h-full flex flex-col">
                    <div class="mb-4">
                        <h3 class="text-lg font-bold text-gray-800">Rekam Medis</h3>
                        <p class="text-xs text-gray-400">Catatan ini akan disimpan secara permanen.</p>
                    </div>
                    
                    <form action="{{ route('psychologist.consultations.selesai', $janji->id) }}" method="POST" class="flex-grow flex flex-col">
                        @csrf
                        <textarea name="catatan_konsultasi" 
                            class="flex-grow w-full border-gray-200 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 p-4 text-gray-700 text-sm mb-4 resize-none"
                            placeholder="Tuliskan hasil observasi, diagnosa sementara, atau anjuran untuk pasien di sini..." required></textarea>

                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin mengakhiri sesi ini? Sesi video akan segera ditutup.')"
                            class="w-full py-3 rounded-xl bg-indigo-600 text-white hover:bg-indigo-700 transition font-bold shadow-md flex items-center justify-center gap-2">
                            <i class="fa-solid fa-check-circle"></i>
                            Selesaikan Sesi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Jitsi External API -->
    <script src="https://meet.jit.si/external_api.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const domain = 'meet.jit.si';
            const options = {
                roomName: 'TenangIn-{{ $janji->order_id }}', // Menggunakan Order ID agar unik & privat
                width: '100%',
                height: '100%',
                parentNode: document.querySelector('#video-container'),
                userInfo: {
                    displayName: '{{ auth()->user()->name }} (Psycholog)'
                },
                configOverwrite: {
                    startWithAudioMuted: false,
                    startWithVideoMuted: false,
                    disablePrejoinPage: false
                },
                interfaceConfigOverwrite: {
                    TOOLBAR_BUTTONS: [
                        'microphone', 'camera', 'desktop', 'fullscreen',
                        'fodeviceselection', 'hangup', 'chat', 'settings', 'tileview'
                    ],
                    SHOW_JITSI_WATERMARK: false,
                    SHOW_BRAND_WATERMARK: false,
                    SHOW_POWERED_BY: false,
                }
            };
            
            const api = new JitsiMeetExternalAPI(domain, options);

            // Logika ketika psikolog menutup video secara manual
            api.addEventListener('videoConferenceLeft', () => {
                alert('Anda telah meninggalkan ruangan video. Jangan lupa simpan catatan Anda.');
            });
        });
    </script>
@endpush