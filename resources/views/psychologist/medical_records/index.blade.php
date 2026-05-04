@extends('layouts.app')

@section('content')
    <div class="p-6">
        <!-- Header dengan Tombol Kembali -->
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('psychologist.consultations.index') }}" 
               class="flex items-center justify-center w-10 h-10 rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-gray-50 hover:text-indigo-600 transition shadow-sm">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Riwayat Catatan Medis</h2>
                <p class="text-sm text-gray-500">Daftar seluruh hasil konsultasi yang telah Anda selesaikan.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($riwayat as $record)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition group">
                    <div class="flex justify-between items-start mb-4">
                        <div class="bg-indigo-600 text-white p-3 rounded-xl shadow-indigo-200 shadow-lg">
                            <i class="fa-solid fa-file-medical text-xl"></i>
                        </div>
                        <span class="text-xs text-gray-400 font-medium">
                            <i class="fa-regular fa-calendar mr-1"></i> {{ $record->created_at->format('d M Y') }}
                        </span>
                    </div>
                    
                    <h3 class="font-bold text-gray-800 text-lg mb-1">{{ $record->pasien->name }}</h3>
                    <p class="text-[10px] text-indigo-600 font-bold uppercase tracking-widest mb-4">Sesi Konsultasi Selesai</p>
                    
                    <div class="bg-gray-50 rounded-xl p-4 mb-4 border border-gray-100">
                        <p class="text-sm text-gray-600 line-clamp-3 italic leading-relaxed">
                            "{{ $record->catatan_konsultasi }}"
                        </p>
                    </div>

                    <!-- Tombol Lihat Detail Lengkap -->
                    <a href="{{ route('psychologist.medical_records.show', $record->id) }}" 
                       class="w-full inline-block text-center py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold transition shadow-md uppercase tracking-wider">
                        Lihat Detail Lengkap
                    </a>
                </div>
            @empty
                <div class="col-span-full bg-white p-16 rounded-2xl border-2 border-dashed border-gray-200 text-center">
                    <div class="text-gray-300 mb-3">
                        <i class="fa-solid fa-folder-open text-5xl"></i>
                    </div>
                    <p class="text-gray-500 font-medium italic">Belum ada catatan medis yang tersimpan.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection