<x-guest-layout>
    @include('landing_page.navbar')
    
    <div class="pt-32 pb-10 bg-slate-50 min-h-screen font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8 gap-4">
                <div class="flex items-center gap-4">
                    <a href="{{ route('user.schedule.index') }}" class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-500 hover:text-[#0A4D68] hover:border-[#0A4D68] transition-all shadow-sm">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <div>
                        <h2 class="text-2xl font-extrabold text-[#0A4D68]">Sesi Konseling</h2>
                        <p class="text-sm font-medium text-gray-500">Bersama {{ $janji->psikolog->name }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-2 px-5 py-2.5 bg-green-50 text-green-700 rounded-full text-sm font-bold border border-green-100 shadow-sm animate-pulse">
                    <span class="w-2.5 h-2.5 bg-green-500 rounded-full"></span>
                    Live Session
                </div>
            </div>

            <!-- Video Container -->
            <div class="bg-white rounded-[2.5rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 overflow-hidden relative" style="height: 75vh; min-height: 500px;">
                <div id="meet" class="w-full h-full bg-slate-900 flex items-center justify-center relative z-10">
                    <div class="text-center text-white p-8">
                        <div class="inline-block animate-spin rounded-full h-12 w-12 border-4 border-[#D98324] border-t-transparent mb-6"></div>
                        <h3 class="text-xl font-bold mb-2">Menyiapkan Ruangan...</h3>
                        <p class="text-gray-400 font-medium max-w-md mx-auto">Harap berikan izin akses mikrofon dan kamera Anda saat diminta oleh browser.</p>
                    </div>
                </div>
            </div>

            <!-- Warning/Info -->
            <div class="mt-6 bg-orange-50 border border-orange-100 rounded-2xl p-5 flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-orange-100 flex items-center justify-center text-orange-600 shrink-0">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div>
                    <h4 class="font-bold text-orange-800 mb-1">Privasi & Keamanan</h4>
                    <p class="text-sm text-orange-700/80 font-medium">Panggilan ini dienkripsi end-to-end. Pastikan Anda berada di ruangan yang tenang dan nyaman agar sesi konseling berjalan dengan optimal.</p>
                </div>
            </div>

        </div>
    </div>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Jitsi Iframe API -->
    <script src="https://meet.jit.si/external_api.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const domain = 'meet.jit.si';
            const options = {
                roomName: 'TenangIn-{{ $janji->order_id }}', // Harus persis sama dengan room psikolog
                width: '100%',
                height: '100%',
                parentNode: document.querySelector('#meet'),
                userInfo: {
                    displayName: '{{ explode(" ", auth()->user()->name)[0] }} (Pasien)'
                },
                configOverwrite: {
                    startWithAudioMuted: false,
                    startWithVideoMuted: false,
                    disablePrejoinPage: false // Biarkan prejoin page agar pasien bisa cek kamera dulu
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
            
            // Inisialisasi Jitsi
            const api = new JitsiMeetExternalAPI(domain, options);
            
            // Hapus loader saat video siap
            api.addEventListener('videoConferenceJoined', () => {
                // Video berhasil dimuat
            });

            // Redirect kembali saat sesi ditutup oleh pasien
            api.addEventListener('readyToClose', () => {
                window.location.href = "{{ route('user.schedule.index') }}";
            });
        });
    </script>
</x-guest-layout>
