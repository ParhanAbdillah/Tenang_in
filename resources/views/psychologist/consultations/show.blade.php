@extends('layouts.app')
@section('content')
    <div class="p-6 max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('psychologist.consultations.index') }}" class="text-gray-500 hover:text-gray-700">
                <i class="fa-solid fa-arrow-left text-xl"></i>
            </a>
            <h2 class="text-2xl font-bold text-gray-800">Ruang Konsultasi: {{ $janji->pasien->name }}</h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Kolom Kiri: Info Pasien & Keluhan -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold mb-4 text-indigo-900 border-b pb-2">Informasi Pasien</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider">Nama Lengkap</p>
                            <p class="font-medium text-gray-800">{{ $janji->pasien->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider">Jadwal Sesi</p>
                            <p class="font-medium text-gray-800">
                                {{ \Carbon\Carbon::parse($janji->tanggal_janji)->format('d M Y') }}
                                ({{ $janji->jam_janji }})</p>
                        </div>
                    </div>
                </div>

                <div class="bg-indigo-50 p-6 rounded-2xl border border-indigo-100">
                    <h3 class="text-lg font-bold mb-2 text-indigo-900">Keluhan Awal</h3>
                    <p class="text-gray-700 italic leading-relaxed">
                        "{{ $janji->catatan_keluhan }}"
                    </p>
                </div>
            </div>

            <!-- Kolom Kanan: Catatan Konsultasi -->
            <div class="lg:col-span-2">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 h-full">
                    <h3 class="text-lg font-bold mb-4 text-gray-800">Catatan Konsultasi</h3>
                    <form action="{{ route('psychologist.consultations.selesai', $janji->id) }}" method="POST">
                        @csrf
                        <textarea name="catatan_konsultasi" rows="10"
                            class="w-full border-gray-200 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 p-4 text-gray-700"
                            placeholder="Tuliskan hasil observasi atau diagnosa sementara di sini..." required></textarea>

                        <div class="mt-6 flex justify-end gap-3">
                            <button type="submit"
                                class="px-6 py-2 rounded-xl bg-indigo-600 text-white hover:bg-indigo-700 transition font-semibold shadow-md">
                                Selesaikan Sesi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
