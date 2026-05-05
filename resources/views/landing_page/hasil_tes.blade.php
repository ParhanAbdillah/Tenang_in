<x-guest-layout>
    {{-- Menambahkan FontAwesome untuk icon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    @include('landing_page.style')
    @include('landing_page.navbar')

    <section class="min-h-screen bg-gray-50 pt-32 pb-20 nav-font">
        <div class="max-w-4xl mx-auto px-6">
            {{-- Card Utama --}}
            <div class="bg-white rounded-[32px] shadow-2xl overflow-hidden border border-gray-100">

                {{-- Header dengan Warna Dinamis --}}
                <div class="p-8 text-center text-white transition-colors duration-500"
                    style="background-color: {{ $warna ?? '#0A4D68' }};">
                    <h1 class="text-2xl font-bold uppercase tracking-widest mb-2">Hasil Analisis Psikologi</h1>
                    <p class="opacity-90 font-medium">Kategori: {{ $kategori->name }}</p>
                </div>

                <div class="p-10">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

                        {{-- Visual Skor (Circular Progress) --}}
                        <div class="relative flex justify-center">
                            {{-- Lingkaran Luar dengan warna dinamis --}}
                            <div class="w-56 h-56 rounded-full border-[14px] flex flex-col items-center justify-center shadow-inner bg-white transition-all duration-700"
                                style="border-color: {{ $warna ?? '#e5e7eb' }};">

                                <span class="text-6xl font-black mb-1" style="color: {{ $warna ?? '#0A4D68' }};">
                                    {{ $totalSkor }}
                                </span>
                                <span class="text-gray-400 text-xs font-bold tracking-widest uppercase">Total
                                    Skor</span>

                                {{-- Badge Status Kecil di bawah skor --}}
                                <div class="absolute -bottom-4 px-4 py-1 rounded-full text-white text-xs font-bold shadow-md"
                                    style="background-color: {{ $warna ?? '#0A4D68' }};">
                                    {{ strtoupper($indikator->status ?? ($result->diagnosis ?? 'Terdefinisi')) }}
                                </div>
                            </div>
                        </div>

                        {{-- Status & Keterangan --}}
                        <div>
                            <div class="status-badge">
                                {{-- Status akan otomatis jadi "Kecemasan Ringan" jika skor 5-9 --}}
                                STATUS: {{ $indikator->status ?? ($result->diagnosis ?? 'Tidak Teridentifikasi') }}
                            </div>

                            <h3 class="text-2xl font-bold text-gray-800 mb-4">Apa artinya bagi Anda?</h3>
                            <p class="text-gray-600 leading-relaxed mb-6 italic">
                                {{-- Jika ada deskripsi di database, tampilkan. Jika tidak, pakai teks default --}}
                                {{ $indikator->description ?? "Berdasarkan jawaban Anda, tingkat $kategori->name Anda berada pada kategori $indikator->status." }}
                            </p>

                            <div class="flex items-center gap-3 text-sm text-gray-500">
                                <i class="fas fa-info-circle"></i>
                                <span>Hasil ini bersifat screening awal, bukan diagnosa klinis final.</span>
                            </div>
                        </div>
                    </div>

                    {{-- Section Rekomendasi Spesialis --}}
                    <div class="mt-12 p-8 rounded-[24px] border transition-all duration-500"
                        style="background-color: {{ $warna ?? '#0A4D68' }}10; border-color: {{ $warna ?? '#0A4D68' }}30;">
                        <div
                            class="flex flex-col md:flex-row gap-6 items-center md:items-start text-center md:text-left">
                            <div class="p-4 rounded-2xl text-white shadow-lg"
                                style="background-color: {{ $warna ?? '#0A4D68' }};">
                                <i class="fas fa-user-md text-3xl"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold mb-2" style="color: {{ $warna ?? '#0A4D68' }};">
                                    Rekomendasi Spesialisasi
                                </h4>
                                <p class="text-gray-700 leading-relaxed">
                                    Kami merekomendasikan Anda untuk berkonsultasi dengan:
                                    <span class="font-bold text-gray-900 block md:inline mt-1 md:mt-0">
                                        {{ $indikator->specialization->name ?? 'Psikolog Umum / Tenaga Profesional' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex flex-col md:flex-row gap-4 mt-12">
                        <a href="{{ route('test_psikologi') }}"
                            class="flex-1 py-4 text-center border-2 rounded-full font-bold transition-all flex items-center justify-center gap-2"
                            style="border-color: {{ $warna ?? '#0A4D68' }}; color: {{ $warna ?? '#0A4D68' }};">
                            <i class="fas fa-undo-alt"></i>
                            Tes Ulang
                        </a>

                        <a href="{{ route('user.psychologist.index') }}"
                            class="flex-1 py-4 text-center bg-[#D98324] text-white rounded-full font-bold shadow-xl hover:scale-105 hover:bg-[#c4721d] transition-all flex items-center justify-center gap-2">
                            <i class="fas fa-comments"></i>
                            Konsultasi Sekarang
                        </a>
                    </div>
                </div>

                {{-- Footer Tip --}}
                <div class="bg-gray-50 p-6 text-center border-t border-gray-100">
                    <p class="text-sm text-gray-400 uppercase tracking-widest font-bold">Tenang.in © 2026 - Solusi
                        Kesehatan Mental Anda</p>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
