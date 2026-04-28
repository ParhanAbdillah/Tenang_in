<x-guest-layout>
    <div class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-6 text-center">
            @if ($tes->image)
                <img src="{{ asset('storage/' . $tes->image) }}" class="w-64 h-64 mx-auto rounded-3xl object-cover mb-8 shadow-lg" alt="{{ $tes->name }}">
            @else
                <img src="https://images.unsplash.com/photo-1513258496099-48168024adb0?auto=format&fit=crop&q=80" class="w-64 h-64 mx-auto rounded-3xl object-cover mb-8 shadow-lg" alt="{{ $tes->name }}">
            @endif

            <h1 class="text-4xl font-bold text-[#0A4D68] mb-4">{{ $tes->name }}</h1>

            <div class="text-gray-600 leading-relaxed mb-10 max-w-2xl mx-auto">
                {{ $tes->description ?? 'Detail tes tidak tersedia.' }}
            </div>

            <a href="{{ route('tes.kerjakan', $tes->id) }}" class="bg-[#D98324] text-white px-10 py-3 rounded-full font-bold hover:bg-[#b86d1d] transition-all">
                Mulai Tes
            </a>

            <div class="mt-16 bg-orange-50 border border-orange-200 rounded-3xl p-8 text-left max-w-3xl mx-auto">
                <div class="flex items-start mb-4">
                    <span class="bg-[#0A4D68] text-white w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold mr-4 mt-1">1</span>
                    <p class="text-gray-700">Tes ini **BUKAN** untuk mendiagnosis gangguan psikologis, melainkan hanya untuk memberi gambaran kondisi dirimu saat ini.</p>
                </div>
                <div class="flex items-start mb-4">
                    <span class="bg-[#0A4D68] text-white w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold mr-4 mt-1">2</span>
                    <p class="text-gray-700">Tidak ada jawaban benar dan salah. Pilih saja satu yang paling menggambarkan kamu!</p>
                </div>
                <div class="flex items-start">
                    <span class="bg-[#0A4D68] text-white w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold mr-4 mt-1">3</span>
                    <p class="text-gray-700">Hindari memilih jawaban netral untuk hasil yang lebih maksimal.</p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>