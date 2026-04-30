@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="mb-8 flex justify-between items-end">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Konfigurasi Website</h1>
            <p class="text-slate-500 text-sm">Kelola konten Tenang.in berdasarkan halaman.</p>
        </div>
        
        {{-- Notifikasi Sukses --}}
        @if(session('success'))
        <div class="bg-emerald-50 text-emerald-600 px-6 py-3 rounded-2xl border border-emerald-100 animate-fade-in flex items-center gap-3 shadow-sm">
            <i class="fa-solid fa-circle-check"></i>
            <span class="text-sm font-bold">{{ session('success') }}</span>
        </div>
        @endif
    </div>

    {{-- JANGAN LUPA: enctype="multipart/form-data" --}}
    <form action="{{ route('admin.web_config.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="space-y-10">

            {{-- --- BAGIAN 1: LANDING HOME --- --}}
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
                <h3 class="font-bold text-rose-500 flex items-center gap-2 mb-6 text-sm uppercase tracking-wider">
                    <i class="fa-solid fa-house"></i> 1. Konten Landing Home
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Judul Hero Homepage</label>
                        <textarea name="home_hero_title" rows="2" class="w-full p-4 bg-slate-50 rounded-2xl border-none text-sm">{{ \App\Models\WebConfig::get('home_hero_title', 'Membangun Ekosistem Kesehatan Mental yang Inklusif') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Deskripsi Hero Homepage</label>
                        <textarea name="home_hero_description" rows="2" class="w-full p-4 bg-slate-50 rounded-2xl border-none text-sm">{{ \App\Models\WebConfig::get('home_hero_description', 'Tenang-in hadir sebagai teman perjalananmu dalam memahami diri, mengatasi luka, dan menemukan kembali kebahagiaan.') }}</textarea>
                    </div>
                    <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Teks Tombol CTA Homepage</label>
                            <input type="text" name="home_cta_text" value="{{ \App\Models\WebConfig::get('home_cta_text', 'Konseling di Tenang-in') }}" class="w-full p-4 bg-slate-50 rounded-2xl border-none text-sm">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Link Tombol CTA Homepage</label>
                            <input type="text" name="home_cta_link" value="{{ \App\Models\WebConfig::get('home_cta_link', '#') }}" class="w-full p-4 bg-slate-50 rounded-2xl border-none text-sm">
                        </div>
                    </div>
                </div>
            </div>

            {{-- --- BAGIAN 2: LANDING INDIVIDUAL --- --}}
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
                <h3 class="font-bold text-slate-900 flex items-center gap-2 mb-6 text-sm uppercase tracking-wider">
                    <i class="fa-solid fa-user"></i> 2. Konten Landing Individu
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Judul Hero Halaman Individu</label>
                        <textarea name="hero_title" rows="2" class="w-full p-4 bg-slate-50 rounded-2xl border-none text-sm">{{ \App\Models\WebConfig::get('hero_title', 'Ruang Aman untuk Pulihkan Dirimu') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Deskripsi Hero Halaman Individu</label>
                        <textarea name="hero_description" rows="2" class="w-full p-4 bg-slate-50 rounded-2xl border-none text-sm">{{ \App\Models\WebConfig::get('hero_description') }}</textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Gambar Hero Halaman Individu</label>
                        <div class="flex flex-col lg:flex-row items-start lg:items-center gap-6 p-4 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200">
                            <img id="individual_hero_preview" src="{{ \App\Models\WebConfig::get('individual_hero_image') ? asset('storage/' . \App\Models\WebConfig::get('individual_hero_image')) : 'https://placehold.co/600x400?text=No+Image' }}" class="h-36 rounded-lg w-full lg:w-auto object-cover" onerror="this.src='https://placehold.co/600x400?text=No+Image'">
                            <div class="flex-1 w-full">
                                <input type="file" name="individual_hero_image" accept="image/*" onchange="previewImage(event, 'individual_hero_preview')" class="w-full text-xs text-slate-500 mb-3">
                                <p class="text-xs text-slate-400">Pilih file gambar untuk hero landing individu.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- --- BAGIAN 3: MANAJEMEN HARGA (DENGAN RENTANG) --- --}}
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
                <h3 class="font-bold text-blue-600 flex items-center gap-2 mb-6 text-sm uppercase tracking-wider">
                    <i class="fa-solid fa-tags"></i> 3. Manajemen Rentang Harga Paket
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    
                    {{-- Harga Sesi Tunggal Individual --}}
                    <div class="space-y-6">
                        <p class="text-[11px] font-bold text-slate-800 flex items-center gap-2 uppercase"><i class="fa-solid fa-user"></i> Paket Konseling Individual (Rentang Harga)</p>
                        
                        <div class="space-y-4">
                            {{-- Basic Range --}}
                            <div class="p-4 bg-slate-50 rounded-2xl">
                                <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Kategori Basic (Min - Max)</label>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-[10px] font-bold text-slate-400">Min</span>
                                        <input type="number" name="price_basic_min" value="{{ \App\Models\WebConfig::get('price_basic_min', 20000) }}" class="w-full pl-10 p-3 bg-white rounded-xl border-none text-xs font-bold text-blue-600">
                                    </div>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-[10px] font-bold text-slate-400">Max</span>
                                        <input type="number" name="price_basic_max" value="{{ \App\Models\WebConfig::get('price_basic_max', 50000) }}" class="w-full pl-10 p-3 bg-white rounded-xl border-none text-xs font-bold text-blue-600">
                                    </div>
                                </div>
                            </div>

                            {{-- Essential Range --}}
                            <div class="p-4 bg-slate-50 rounded-2xl">
                                <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Kategori Essential (Min - Max)</label>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-[10px] font-bold text-slate-400">Min</span>
                                        <input type="number" name="price_essential_min" value="{{ \App\Models\WebConfig::get('price_essential_min', 60000) }}" class="w-full pl-10 p-3 bg-white rounded-xl border-none text-xs font-bold text-blue-600">
                                    </div>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-[10px] font-bold text-slate-400">Max</span>
                                        <input type="number" name="price_essential_max" value="{{ \App\Models\WebConfig::get('price_essential_max', 150000) }}" class="w-full pl-10 p-3 bg-white rounded-xl border-none text-xs font-bold text-blue-600">
                                    </div>
                                </div>
                            </div>

                            {{-- Premium Range --}}
                            <div class="p-4 bg-slate-50 rounded-2xl">
                                <label class="block text-[10px] font-bold text-slate-400 mb-2 uppercase">Kategori Premium (Min - Max)</label>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-[10px] font-bold text-slate-400">Min</span>
                                        <input type="number" name="price_premium_min" value="{{ \App\Models\WebConfig::get('price_premium_min', 200000) }}" class="w-full pl-10 p-3 bg-white rounded-xl border-none text-xs font-bold text-blue-600">
                                    </div>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-[10px] font-bold text-slate-400">Max</span>
                                        <input type="number" name="price_premium_max" value="{{ \App\Models\WebConfig::get('price_premium_max', 500000) }}" class="w-full pl-10 p-3 bg-white rounded-xl border-none text-xs font-bold text-blue-600">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Harga Sesi Pasangan --}}
                    <div class="space-y-4 border-l border-slate-50 pl-10">
                        <p class="text-[11px] font-bold text-slate-800 flex items-center gap-2 uppercase"><i class="fa-solid fa-heart"></i> Paket Pasangan (Couple)</p>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-[9px] font-bold text-slate-400 mb-1 uppercase">Pre-Marriage (Rp)</label>
                                <input type="number" name="price_pre_marriage" value="{{ \App\Models\WebConfig::get('price_pre_marriage', 659000) }}" class="w-full p-4 bg-slate-50 rounded-2xl border-none text-sm font-bold text-blue-600">
                            </div>
                            <div>
                                <label class="block text-[9px] font-bold text-slate-400 mb-1 uppercase">Marriage (Rp)</label>
                                <input type="number" name="price_marriage" value="{{ \App\Models\WebConfig::get('price_marriage', 1459000) }}" class="w-full p-4 bg-slate-50 rounded-2xl border-none text-sm font-bold text-blue-600">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- --- BAGIAN 4: TENTANG KAMI (ABOUT) --- --}}
            <div class="bg-white p-8 rounded-[32px] shadow-sm border border-slate-100">
                <h3 class="font-bold text-orange-600 flex items-center gap-2 mb-6 text-sm uppercase tracking-wider">
                    <i class="fa-solid fa-circle-info"></i> 4. Halaman Tentang Kami (About)
                </h3>
                <div class="space-y-12">
                    {{-- Statistik & Visi --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 border-b border-slate-100 pb-8">
                        <div class="space-y-4">
                             <label class="block text-[10px] font-bold text-slate-400 uppercase">Statistik</label>
                             <input type="text" name="stats_psychologists" placeholder="50+ Psikolog" value="{{ \App\Models\WebConfig::get('stats_psychologists') }}" class="w-full p-4 bg-slate-50 rounded-2xl border-none text-sm mb-2">
                             <input type="text" name="stats_sessions" placeholder="10k+ Sesi" value="{{ \App\Models\WebConfig::get('stats_sessions') }}" class="w-full p-4 bg-slate-50 rounded-2xl border-none text-sm">
                        </div>
                        <div class="md:col-span-2 grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2">Visi Kami</label>
                                <textarea name="about_vision" rows="4" class="w-full p-4 bg-slate-50 rounded-2xl border-none text-sm">{{ \App\Models\WebConfig::get('about_vision') }}</textarea>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2">Misi Kami</label>
                                <textarea name="about_mission" rows="4" class="w-full p-4 bg-slate-50 rounded-2xl border-none text-sm">{{ \App\Models\WebConfig::get('about_mission') }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- --- MANAJEMEN TIM (4 ANGGOTA) --- --}}
                    <div class="space-y-10">
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-2"><i class="fa-solid fa-users-gear text-orange-400"></i> Manajemen Tim Inti</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-12">
                            
                            {{-- MEMBER 1 --}}
                            <div class="p-6 bg-slate-50 rounded-4xl flex gap-6 items-center shadow-inner border border-slate-100">
                                <div class="w-28 h-36 shrink-0">
                                    <img id="team_1_preview" src="{{ \App\Models\WebConfig::get('team_1_image') ? asset('storage/' . \App\Models\WebConfig::get('team_1_image')) : 'https://ui-avatars.com/api/?name=Member+1&background=E2E8F0&color=475569' }}" class="w-full h-full object-cover rounded-2xl shadow border-4 border-white" onerror="this.src='https://ui-avatars.com/api/?name=M1'">
                                </div>
                                <div class="flex-1 space-y-3">
                                    <div>
                                        <label class="block text-[9px] font-bold text-slate-400 mb-1 uppercase">Foto CEO</label>
                                        <input type="file" name="team_1_image" id="team_1_img" accept="image/*" onchange="previewImage(event, 'team_1_preview')" class="w-full text-xs text-slate-500">
                                    </div>
                                    <input type="text" name="team_1_name" placeholder="Nama CEO" value="{{ \App\Models\WebConfig::get('team_1_name', 'Dr. Muhamad Parhan Abdillah') }}" class="w-full p-3 bg-white rounded-xl border-none text-sm font-bold text-rose-600">
                                    <input type="text" name="team_1_title" placeholder="Jabatan (CEO)" value="{{ \App\Models\WebConfig::get('team_1_title', 'CEO') }}" class="w-full p-3 bg-white rounded-xl border-none text-xs text-slate-600 uppercase tracking-wider font-semibold">
                                    <input type="text" name="team_1_description" placeholder="Deskripsi Singkat" value="{{ \App\Models\WebConfig::get('team_1_description') }}" class="w-full p-3 bg-white rounded-xl border-none text-xs text-slate-500">
                                </div>
                            </div>

                            {{-- MEMBER 2 --}}
                            <div class="p-6 bg-slate-50 rounded-4xl flex gap-6 items-center shadow-inner border border-slate-100">
                                <div class="w-28 h-36 shrink-0">
                                    <img id="team_2_preview" src="{{ \App\Models\WebConfig::get('team_2_image') ? asset('storage/' . \App\Models\WebConfig::get('team_2_image')) : 'https://ui-avatars.com/api/?name=Member+2&background=E2E8F0&color=475569' }}" class="w-full h-full object-cover rounded-2xl shadow border-4 border-white" onerror="this.src='https://ui-avatars.com/api/?name=M2'">
                                </div>
                                <div class="flex-1 space-y-3">
                                    <div>
                                        <label class="block text-[9px] font-bold text-slate-400 mb-1 uppercase">Foto Clinical Director</label>
                                        <input type="file" name="team_2_image" id="team_2_img" accept="image/*" onchange="previewImage(event, 'team_2_preview')" class="w-full text-xs text-slate-500">
                                    </div>
                                    <input type="text" name="team_2_name" placeholder="Nama Clinical Director" value="{{ \App\Models\WebConfig::get('team_2_name', 'Siska Amelia, M.Psi') }}" class="w-full p-3 bg-white rounded-xl border-none text-sm font-bold text-blue-600">
                                    <input type="text" name="team_2_title" placeholder="Jabatan" value="{{ \App\Models\WebConfig::get('team_2_title', 'Clinical Director') }}" class="w-full p-3 bg-white rounded-xl border-none text-xs text-slate-600 uppercase tracking-wider font-semibold">
                                    <input type="text" name="team_2_description" placeholder="Deskripsi Singkat" value="{{ \App\Models\WebConfig::get('team_2_description') }}" class="w-full p-3 bg-white rounded-xl border-none text-xs text-slate-500">
                                </div>
                            </div>

                            {{-- MEMBER 3 --}}
                            <div class="p-6 bg-slate-50 rounded-4xl flex gap-6 items-center shadow-inner border border-slate-100">
                                <div class="w-28 h-36 shrink-0">
                                    <img id="team_3_preview" src="{{ \App\Models\WebConfig::get('team_3_image') ? asset('storage/' . \App\Models\WebConfig::get('team_3_image')) : 'https://ui-avatars.com/api/?name=Member+3&background=E2E8F0&color=475569' }}" class="w-full h-full object-cover rounded-2xl shadow border-4 border-white" onerror="this.src='https://ui-avatars.com/api/?name=M3'">
                                </div>
                                <div class="flex-1 space-y-3">
                                    <div>
                                        <label class="block text-[9px] font-bold text-slate-400 mb-1 uppercase">Foto CTO</label>
                                        <input type="file" name="team_3_image" id="team_3_img" accept="image/*" onchange="previewImage(event, 'team_3_preview')" class="w-full text-xs text-slate-500">
                                    </div>
                                    <input type="text" name="team_3_name" placeholder="Nama CTO" value="{{ \App\Models\WebConfig::get('team_3_name', 'Budi Setiawan') }}" class="w-full p-3 bg-white rounded-xl border-none text-sm font-bold text-rose-600">
                                    <input type="text" name="team_3_title" placeholder="Jabatan" value="{{ \App\Models\WebConfig::get('team_3_title', 'CTO') }}" class="w-full p-3 bg-white rounded-xl border-none text-xs text-slate-600 uppercase tracking-wider font-semibold">
                                    <input type="text" name="team_3_description" placeholder="Deskripsi Singkat" value="{{ \App\Models\WebConfig::get('team_3_description') }}" class="w-full p-3 bg-white rounded-xl border-none text-xs text-slate-500">
                                </div>
                            </div>

                            {{-- MEMBER 4 --}}
                            <div class="p-6 bg-slate-50 rounded-4xl flex gap-6 items-center shadow-inner border border-slate-100">
                                <div class="w-28 h-36 shrink-0">
                                    <img id="team_4_preview" src="{{ \App\Models\WebConfig::get('team_4_image') ? asset('storage/' . \App\Models\WebConfig::get('team_4_image')) : 'https://ui-avatars.com/api/?name=Member+4&background=E2E8F0&color=475569' }}" class="w-full h-full object-cover rounded-2xl shadow border-4 border-white" onerror="this.src='https://ui-avatars.com/api/?name=M4'">
                                </div>
                                <div class="flex-1 space-y-3">
                                    <div>
                                        <label class="block text-[9px] font-bold text-slate-400 mb-1 uppercase">Foto Head of Community</label>
                                        <input type="file" name="team_4_image" id="team_4_img" accept="image/*" onchange="previewImage(event, 'team_4_preview')" class="w-full text-xs text-slate-500">
                                    </div>
                                    <input type="text" name="team_4_name" placeholder="Nama" value="{{ \App\Models\WebConfig::get('team_4_name', 'Maya Putri') }}" class="w-full p-3 bg-white rounded-xl border-none text-sm font-bold text-blue-600">
                                    <input type="text" name="team_4_title" placeholder="Jabatan" value="{{ \App\Models\WebConfig::get('team_4_title', 'Head of Community') }}" class="w-full p-3 bg-white rounded-xl border-none text-xs text-slate-600 uppercase tracking-wider font-semibold">
                                    <input type="text" name="team_4_description" placeholder="Deskripsi" value="{{ \App\Models\WebConfig::get('team_4_description') }}" class="w-full p-3 bg-white rounded-xl border-none text-xs text-slate-500">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sticky Save Button --}}
        <div class="mt-12 flex justify-end sticky bottom-8">
            <button type="submit" class="bg-slate-900 text-white px-16 py-5 rounded-4xl font-bold hover:bg-slate-800 transition-all shadow-2xl flex items-center gap-3">
                <i class="fa-solid fa-cloud-arrow-up"></i>
                Simpan & Perbarui Semua Data
            </button>
        </div>
    </form>
</div>

<script>
    function previewImage(event, previewId) {
        const input = event.target;
        const preview = document.getElementById(previewId);
        if (!preview || !input.files || !input.files[0]) return;
        preview.src = URL.createObjectURL(input.files[0]);
    }
</script>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.4s ease-out forwards;
    }
</style>
@endsection