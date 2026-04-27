<x-guest-layout>
    @include('landing_page.style')
    @include('landing_page.navbar')

    {{-- Hero Section --}}
    <section class="relative min-h-[700px] flex items-center pt-32 pb-20 overflow-hidden bg-white nav-font">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="z-10 space-y-8">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-orange-50 border border-orange-100 text-[#D98324] font-bold text-sm tracking-wide">
                    <i class="fas fa-sparkles"></i> Kenali Dirimu Lebih Dalam
                </div>
                <h1 class="text-5xl md:text-7xl font-extrabold text-[#0A4D68] leading-[1.1]">
                    Apakah kamu <span class="text-[#D98324]">baik-baik saja</span> hari ini?
                </h1>
                <p class="text-gray-500 text-lg md:text-xl max-w-lg leading-relaxed">
                    Yuk, kenali kondisimu dengan mengikuti Tes Psikologis dari <span class="font-bold text-[#0A4D68]">Tenang-in.</span> Temukan jawaban untuk melangkah lebih yakin dan tenang.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="#daftar-tes" class="bg-[#D98324] text-white px-10 py-4 rounded-2xl font-bold text-lg hover:bg-[#b86d1d] transition-all transform hover:-translate-y-1 shadow-xl shadow-orange-200/50">
                        Coba Tes Sekarang
                    </a>
                </div>
            </div>

            {{-- Image Grid Decor --}}
            <div class="relative grid grid-cols-3 gap-4 h-[550px]">
                <div class="flex flex-col gap-4 mt-20">
                    <div class="h-56 rounded-[2.5rem] overflow-hidden shadow-2xl rotate-[-2deg] border-4 border-white">
                        <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&q=80" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="flex flex-col gap-4">
                    <div class="h-44 rounded-[2.5rem] overflow-hidden shadow-2xl border-4 border-white">
                        <img src="https://images.unsplash.com/photo-1516589174184-c68526614488?auto=format&fit=crop&q=80" class="w-full h-full object-cover">
                    </div>
                    <div class="h-64 rounded-[2.5rem] overflow-hidden shadow-2xl border-4 border-white">
                        <img src="https://images.unsplash.com/photo-1529333166437-7750a6dd5a70?auto=format&fit=crop&q=80" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="flex flex-col gap-4 mt-12">
                    <div class="h-60 rounded-[2.5rem] overflow-hidden shadow-2xl rotate-[2deg] border-4 border-white">
                        <img src="https://images.unsplash.com/photo-1499209974431-9dac3adaf471?auto=format&fit=crop&q=80" class="w-full h-full object-cover">
                    </div>
                    <div class="h-40 rounded-[2.5rem] overflow-hidden shadow-2xl border-4 border-white">
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&q=80" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section Daftar Tes Dinamis --}}
    <section id="daftar-tes" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl font-bold text-[#0A4D68]">Pilih Tes Psikologi</h2>
                    <p class="text-gray-500">Mulai perjalanan mengenal diri sendiri melalui instrumen yang tepat.</p>
                </div>
                {{-- Tombol Kembali ke Beranda --}}
                <a href="/" class="text-[#0A4D68] font-bold hover:underline flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach ($daftar_tes as $tes)
                {{-- Logika Hardcode Gambar berdasarkan nama --}}
                @php
                    $nama_tes = strtolower($tes->name);
                    $gambar_url = 'https://images.unsplash.com/photo-1513258496099-48168024adb0?auto=format&fit=crop&q=80'; // Default

                    if (str_contains($nama_tes, 'kepribadian')) {
                        $gambar_url = 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&q=80';
                    } elseif (str_contains($nama_tes, 'cemas') || str_contains($nama_tes, 'anxiety')) {
                        $gambar_url = 'https://images.unsplash.com/photo-1516589174184-c68526614488?auto=format&fit=crop&q=80';
                    } elseif (str_contains($nama_tes, 'depresi')) {
                        $gambar_url = 'https://images.unsplash.com/photo-1499209974431-9dac3adaf471?auto=format&fit=crop&q=80';
                    }
                @endphp

                <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 flex gap-6 hover:shadow-md transition-shadow">
                    <div class="w-32 h-32 flex-shrink-0 rounded-2xl overflow-hidden shadow-inner">
                        <img src="{{ $gambar_url }}" class="w-full h-full object-cover" alt="{{ $tes->name }}">
                    </div>
                    
                    <div class="flex flex-col justify-between flex-grow">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-xl font-bold text-gray-800">{{ $tes->name }}</h3>
                                <span class="px-3 py-1 bg-blue-50 text-blue-600 text-[10px] font-bold rounded-full uppercase">
                                    {{ $tes->soals_count ?? 0 }} Soal
                                </span>
                            </div>
                            <p class="text-gray-500 text-sm leading-relaxed line-clamp-2">
                                {{ $tes->description ?? 'Kenali dirimu lebih dalam melalui serangkaian pertanyaan terstruktur.' }}
                            </p>
                        </div>
                        
                        <div class="flex justify-end mt-4">
                            {{-- Route detail tes --}}
                            <a href="{{ route('tes.detail', $tes->id) }}" 
                               class="bg-[#D98324] text-white px-6 py-2 rounded-xl font-bold text-sm hover:bg-[#b86d1d] transition-colors shadow-lg shadow-orange-200">
                                Mulai Tes
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if($daftar_tes->isEmpty())
            <div class="text-center py-20">
                <p class="text-gray-400 italic">Belum ada tes yang tersedia saat ini.</p>
            </div>
            @endif
        </div>
    </section>
    @include('landing_page.footer')
</x-guest-layout>