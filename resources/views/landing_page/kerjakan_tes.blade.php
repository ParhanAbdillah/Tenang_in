<x-guest-layout>
    @include('landing_page.style')
    @include('landing_page.navbar')

    {{-- Inisialisasi Alpine.js dengan fungsi navigasi --}}
    <section class="min-h-screen bg-white pt-32 pb-20 nav-font" x-data="{
        activeStep: 1,
        totalSoal: {{ $soals->count() }},
        nextStep() {
            if (this.activeStep < this.totalSoal) {
                this.activeStep++;
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        },
        prevStep() {
            if (this.activeStep > 1) {
                this.activeStep--;
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }
    }">

        <div class="max-w-4xl mx-auto px-6">
            {{-- Header & Progress Bar --}}
            <div class="mb-12">
                <div class="flex justify-between items-center mb-4">
                    {{-- Ganti rute ke tes.index sesuai rute yang sudah kita buat --}}
                    <a href="{{ route('test_psikologi') }}"
                        class="flex items-center gap-2 text-gray-500 hover:text-[#0A4D68] transition-colors">
                        <i class="fas fa-arrow-left"></i>
                        <span>Kembali</span>
                    </a>
                    <span class="text-sm font-bold text-[#0A4D68] uppercase tracking-wider">
                        Pertanyaan <span x-text="activeStep"></span> dari <span x-text="totalSoal"></span>
                    </span>
                </div>
                <div class="h-2 w-full bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-[#0A4D68] transition-all duration-500"
                        :style="`width: ${(activeStep / totalSoal) * 100}%`"></div>
                </div>
            </div>

            {{-- Form Submission --}}
            <form action="{{ route('user.test.submit', $kategori->id) }}" method="POST">
                @csrf

                @foreach ($soals as $index => $soal)
                    {{-- Container per pertanyaan --}}
                    <div x-show="activeStep === {{ $index + 1 }}"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform translate-x-8"
                        x-transition:enter-end="opacity-100 transform translate-x-0">

                        <div class="text-center mb-12">
                            <h2 class="text-3xl md:text-4xl font-bold text-[#0A4D68] leading-tight">
                                {{ $soal->question_text }}
                            </h2>
                            <div class="w-20 h-1 bg-[#D98324] mx-auto mt-6 rounded-full"></div>
                        </div>

                        {{-- Daftar Pilihan Jawaban --}}
                        <div class="grid grid-cols-1 gap-4 max-w-2xl mx-auto">
                            @foreach ($soal->testOptions as $option)
                                <label class="relative">
                                    {{-- Input radio disembunyikan, diganti dengan desain button --}}
                                    <input type="radio" name="jawaban[{{ $soal->id }}]"
                                        value="{{ $option->id }}" class="peer absolute opacity-0" required
                                        @click="setTimeout(() => nextStep(), 300)"> {{-- Auto-next dengan delay sedikit --}}

                                    <div
                                        class="w-full py-4 px-8 text-center border-2 border-gray-200 rounded-full cursor-pointer 
                                                transition-all duration-300 hover:border-[#0A4D68] hover:bg-gray-50
                                                peer-checked:bg-[#0A4D68] peer-checked:border-[#0A4D68] peer-checked:text-white">
                                        <span class="text-lg font-medium">{{ $option->option_text }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                {{-- Navigasi Manual Arrow & Submit --}}
                {{-- Navigasi Manual Arrow --}}
                <div class="flex justify-center items-center gap-8 mt-16">
                    {{-- Tombol Kembali (Kiri) --}}
                    <button type="button" @click="prevStep()" x-show="activeStep > 1"
                        class="flex items-center justify-center w-14 h-14 bg-gray-200 text-[#0A4D68] rounded-2xl hover:bg-[#0A4D68] hover:text-white transition-all shadow-sm">
                        <i class="fas fa-chevron-left text-xl"></i>
                    </button>

                    {{-- Tombol Lanjut (Kanan) --}}
                    <button type="button" @click="nextStep()" x-show="activeStep < totalSoal"
                        class="flex items-center justify-center w-14 h-14 bg-gray-200 text-[#0A4D68] rounded-2xl hover:bg-[#0A4D68] hover:text-white transition-all shadow-sm">
                        <i class="fas fa-chevron-right text-xl"></i>
                    </button>

                    {{-- Tombol Simpan & Lihat Hasil (Hanya muncul di soal terakhir) --}}
                    <button type="submit" x-show="activeStep === totalSoal"
                        class="ml-4 px-10 py-4 bg-[#D98324] text-white rounded-full font-bold shadow-lg hover:scale-105 transition-all">
                        SIMPAN & LIHAT HASIL
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-guest-layout>
