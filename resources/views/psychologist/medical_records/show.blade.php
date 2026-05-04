@extends('layouts.app')

@section('content')
<div class="p-6 max-w-4xl mx-auto">
    <!-- Navigasi Kembali -->
    <div class="mb-6">
        <a href="{{ route('psychologist.medical_records.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-indigo-600 transition">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Daftar Riwayat
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- Header Detail -->
        <div class="bg-indigo-600 p-8 text-white">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <p class="text-indigo-100 text-xs font-bold uppercase tracking-widest mb-1">Detail Catatan Medis</p>
                    <h1 class="text-3xl font-extrabold">{{ $record->pasien->name }}</h1>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20">
                    <p class="text-xs text-indigo-100 mb-1">Tanggal Konsultasi</p>
                    <p class="font-bold">{{ $record->created_at->format('d F Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Konten Utama -->
        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Sidebar Info Pasien -->
                <div class="md:col-span-1">
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Informasi Pasien</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-xs text-gray-400 uppercase">ID Rekam Medis</p>
                            <p class="font-semibold text-gray-700">#RM-{{ str_pad($record->id, 5, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase">Email Pasien</p>
                            <p class="font-semibold text-gray-700">{{ $record->pasien->email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Isi Catatan -->
                <div class="md:col-span-2">
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Hasil Konsultasi & Diagnosa</h3>
                    <div class="prose prose-indigo max-w-none">
                        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 min-h-[200px]">
                            <p class="text-gray-700 leading-relaxed whitespace-pre-line">
                                {{ $record->catatan_konsultasi }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end">
                        <button onclick="window.print()" class="flex items-center gap-2 px-6 py-2.5 bg-gray-800 text-white rounded-xl hover:bg-gray-900 transition text-sm font-bold shadow-lg shadow-gray-200">
                            <i class="fa-solid fa-print"></i> CETAK DOKUMEN
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection