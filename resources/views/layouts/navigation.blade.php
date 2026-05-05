<aside class="w-64 bg-white border-r border-gray-200 flex flex-col sticky top-0 h-screen">
    <!-- Logo -->
    <div class="p-6 flex items-center gap-2">
        <div class="w-8 h-8 bg-[#0A4D68] rounded-lg flex items-center justify-center">
            <span class="text-white font-bold italic text-lg">T</span>
        </div>
        <span class="text-2xl font-extrabold tracking-tight text-[#0A4D68]">Tenang.in</span>
    </div>

    <!-- User Profile Card -->
    <div class="px-4 mb-6">
        <div class="bg-[#EBF5F8] p-3 rounded-xl flex items-center gap-3 border border-[#2B82A5]/20">
            <div class="w-10 h-10 rounded-full bg-[#2B82A5]/20 overflow-hidden shrink-0">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0A4D68&color=fff"
                    alt="{{ auth()->user()->name }}">
            </div>
            <div class="overflow-hidden">
                <p class="text-sm font-bold truncate">{{ auth()->user()->name }}</p>
                <p class="text-xs text-[#0A4D68] font-medium capitalize">{{ auth()->user()->role }}</p>
            </div>
            <i class="fa-solid fa-chevron-down ml-auto text-xs text-[#0A4D68]/60"></i>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 px-4 space-y-1 overflow-y-auto custom-scrollbar">
        <p class="px-2 text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Main Menu</p>

        {{-- Dashboard (Bisa diakses keduanya) --}}
        <a href="{{ route(auth()->user()->role . '.dashboard.index') }}"
            class="{{ request()->routeIs('*.dashboard.index') ? 'sidebar-active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg font-semibold text-sm transition-all hover:bg-gray-50 text-gray-600">
            <i class="fa-solid fa-house"></i> Dashboard
        </a>

        {{-- MENU KHUSUS ADMIN --}}
        @if (auth()->user()->role == 'admin')
            <a href="{{ route('admin.psychologist.index') }}"
                class="{{ request()->routeIs('admin.psychologist.index') ? 'sidebar-active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg font-semibold text-sm transition-all hover:bg-gray-50 text-gray-600">
                <i class="fa-solid fa-user-doctor"></i> Data Psikolog
            </a>

            <a href="{{ route('admin.specialization.index') }}"
                class="{{ request()->routeIs('admin.specialization.index') ? 'sidebar-active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg font-semibold text-sm transition-all hover:bg-gray-50 text-gray-600">
                <i class="fa-solid fa-tags"></i> Data Spesialisasi
            </a>

            <a href="{{ route('admin.clinical_type.index') }}"
                class="{{ request()->routeIs('admin.clinical_type.index') ? 'sidebar-active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg font-semibold text-sm transition-all hover:bg-gray-50 text-gray-600">
                <i class="fa-solid fa-layer-group"></i> Data Tipe Klinis
            </a>

            <a href="#"
                class="flex items-center gap-3 px-3 py-2.5 text-gray-500 hover:bg-gray-50 rounded-lg font-semibold text-sm transition-all">
                <i class="fa-solid fa-money-bill-transfer"></i> Transaksi Konsultasi
            </a>

            <a href="#"
                class="flex items-center gap-3 px-3 py-2.5 text-gray-500 hover:bg-gray-50 rounded-lg font-semibold text-sm transition-all">
                <i class="fa-solid fa-chart-line"></i> Laporan Aktivitas
            </a>

            <a href="{{ route('admin.mental-health.index') }}"
                class="{{ request()->routeIs('admin.mental-health.index') ? 'sidebar-active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg font-semibold text-sm transition-all hover:bg-gray-50 text-gray-600">
                <i class="fa-solid fa-newspaper"></i> Manajemen Edukasi
            </a>
        @endif

        {{-- MENU KHUSUS PSYCHOLOGIST --}}
        @if (auth()->user()->role == 'psychologist')
            <a href="{{ route('psychologist.consultations.index') }}"
                class="{{ request()->routeIs('psychologist.consultations.index') ? 'sidebar-active' : '' }} flex items-center gap-3 px-3 py-2.5 ...">
                <i class="fa-solid fa-calendar-check"></i> Sesi Konsultasi Saya
            </a>

            @if (auth()->user()->psychologist)
                <a href="{{ route('psychologist.schedules.index') }}"
                    class="{{ request()->routeIs('psychologist.schedules.*') ? 'sidebar-active' : '' }} flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg font-semibold text-sm transition-all">
                    <i class="fa-solid fa-calendar-check"></i> Jadwal Anda
                </a>
            @endif


            <a href="#"
                class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg font-semibold text-sm transition-all">
                <i class="fa-solid fa-wallet"></i> Penghasilan Saya
            </a>
        @endif

        {{-- Tambahan Menu Bawah --}}
        <div class="pt-6">
            <p class="px-2 text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Added Menu</p>

            @if (auth()->user()->role == 'admin')
                <a href="{{ route('admin.ai.index') }}"
                    class="{{ request()->routeIs('admin.ai.index') ? 'sidebar-active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg font-semibold text-sm transition-all hover:bg-gray-50 text-gray-600">
                    <i class="fa-solid fa-robot"></i> AI Engine Settings
                </a>
                <a href="{{ route('admin.web_config.index') }}"
                    class="{{ request()->routeIs('admin.web_config.index') ? 'sidebar-active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg font-semibold text-sm transition-all hover:bg-gray-50 text-gray-600">
                    <i class="fa-solid fa-gear"></i> Konfigurasi Web
                </a>
                <a href="#"
                    class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg font-semibold text-sm transition-all">
                    <i class="fa-solid fa-users-gear"></i> Manajemen User
                </a>
            @endif

            {{-- Profil bisa diakses keduanya --}}
            <a href="#"
                class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg font-semibold text-sm transition-all">
                <i class="fa-solid fa-circle-user"></i> Profil Saya
            </a>
        </div>
    </nav>

    <!-- Logout -->
    <div class="p-4 border-t border-gray-100">
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="flex items-center gap-3 px-3 py-2.5 text-red-600 hover:bg-red-50 rounded-lg font-semibold text-sm transition-all">
            <i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</aside>
