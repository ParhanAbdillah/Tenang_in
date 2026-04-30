<aside class="w-64 bg-white border-r border-gray-200 flex flex-col sticky top-0 h-screen overflow-y-auto">
    <!-- Logo -->
    <div class="p-6 flex items-center gap-3">
        <div class="w-10 h-10 bg-rose-600 rounded-lg flex items-center justify-center text-white font-bold text-xl">T
        </div>
        <span class="text-xl font-bold tracking-tight">Tenang.in</span>
    </div>

    <!-- User Profile Card in Sidebar -->
    <div class="px-4 mb-6">
        <div class="bg-rose-50 p-3 rounded-xl flex items-center gap-3 border border-rose-100">
            <div class="w-10 h-10 rounded-full bg-rose-200 overflow-hidden">
                <img src="https://ui-avatars.com/api/?name=Admin+Tenang&background=FDA4AF&color=fff" alt="Admin">
            </div>
            <div>
                <p class="text-sm font-bold">Admin Tenang</p>
                <p class="text-xs text-rose-600 font-medium">Head Office</p>
            </div>
            <i class="fa-solid fa-chevron-down ml-auto text-xs text-rose-400"></i>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 px-4 space-y-1">
        <p class="px-2 text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Main Menu</p>

        <a href="{{ route('admin.dashboard.index') }}"
            class="{{ request()->routeIs('admin.dashboard.index') ? 'sidebar-active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg font-semibold text-sm transition-all">
            <i class="fa-solid fa-house"></i> Dashboard
        </a>

        <a href="{{ route('admin.psychologist.index') }}"
            class="{{ request()->routeIs('admin.psychologist.index') ? 'sidebar-active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg font-semibold text-sm transition-all hover:bg-gray-50">
            <i class="fa-solid fa-user-doctor"></i> Data Psikolog
        </a>

        <a href="{{ route('admin.specialization.index') }}"
            class="{{ request()->routeIs('admin.specialization.index') ? 'sidebar-active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg font-semibold text-sm transition-all hover:bg-gray-50">
            <i class="fa-solid fa-tags"></i> Data Spesialisasi
        </a>

        <a href="{{ route('admin.clinical_type.index') }}"
            class="{{ request()->routeIs('admin.clinical_type.index') ? 'sidebar-active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg font-semibold text-sm transition-all hover:bg-gray-50">
            <i class="fa-solid fa-layer-group"></i> Data Tipe Klinis
        </a>

        {{-- <a href="{{ route('admin.psychologist.index') }}"
            class="{{ request()->routeIs('admin.psychologist.*') ? 'sidebar-active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all">
            <i class="fa-solid fa-calendar-check"></i> Jadwal Praktik
        </a> --}}

        <a href="#"
            class="flex items-center gap-3 px-3 py-2.5 text-gray-500 hover:bg-gray-50 rounded-lg font-semibold text-sm transition-all group">
            <i class="fa-solid fa-calendar-check"></i> Transaksi Konsultasi
            <i class="fa-solid fa-chevron-down ml-auto text-[10px] opacity-0 group-hover:opacity-100"></i>
        </a>
        <a href="#"
            class="flex items-center gap-3 px-3 py-2.5 text-gray-500 hover:bg-gray-50 rounded-lg font-semibold text-sm transition-all">
            <i class="fa-solid fa-chart-line"></i> Laporan Aktivitas
        </a>
        <a href="{{ route('admin.mental-health.index') }}"
            class="{{ request()->routeIs('admin.mental-health.index') ? 'sidebar-active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg font-semibold text-sm transition-all hover:bg-gray-50">
            <i class="fa-solid fa-newspaper"></i> Manajemen Edukasi
        </a>

        <div class="pt-6">
            <p class="px-2 text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Added Menu</p>

            <a href="{{ route('admin.ai.index') }}"
                class="{{ request()->routeIs('admin.ai.index') ? 'sidebar-active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg font-semibold text-sm transition-all">
                <i class="fa-solid fa-robot"></i> AI Engine Settings
            </a>
            <a href="{{ route('admin.web_config.index') }}"
                class="{{ request()->routeIs('admin.web_config.index') ? 'sidebar-active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg font-semibold text-sm transition-all">
                <i class="fa-solid fa-gear"></i> Konfigurasi Web
            </a>
            <a href="#"
                class="flex items-center gap-3 px-3 py-2.5 text-gray-500 hover:bg-gray-50 rounded-lg font-semibold text-sm transition-all">
                <i class="fa-solid fa-users-gear"></i> Manajemen User
            </a>
        </div>
    </nav>

    <!-- Logout -->
    <div class="p-4 border-t border-gray-100">
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="flex items-center gap-3 px-3 py-2.5 text-rose-600 hover:bg-rose-50 rounded-lg font-semibold text-sm transition-all">
            <i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        </div>
</aside>
