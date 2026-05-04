@extends('layouts.app')

@section('content')
    <div class="p-6">
        <!-- Header & Filter Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Daftar Sesi Konsultasi</h2>
                <p class="text-sm text-gray-500">Kelola jadwal dan sesi aktif Anda di sini.</p>
            </div>

            <div class="flex items-center gap-4">
                <!-- Dropdown Filter Status -->
                <form action="{{ route('psychologist.consultations.index') }}" method="GET" class="flex items-center gap-2">
                    <select name="status" onchange="this.form.submit()"
                        class="rounded-xl border-gray-200 text-sm focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
                        <option value="">Semua Status</option>
                        <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                        <option value="dikonfirmasi" {{ request('status') == 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                    @if (request('status'))
                        <a href="{{ route('psychologist.consultations.index') }}"
                            class="text-xs text-red-500 hover:underline font-medium">Reset</a>
                    @endif
                </form>

                <span class="bg-indigo-100 text-indigo-800 text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">
                    Total: {{ $daftarKonsultasi->count() }} Sesi
                </span>
            </div>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-bold tracking-wider">
                    <tr>
                        <th class="px-6 py-4">Nama Pasien</th>
                        <th class="px-6 py-4">Jadwal Sesi</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Keluhan Awal</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($daftarKonsultasi as $item)
                        <tr class="hover:bg-indigo-50/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-900">{{ $item->pasien->name }}</div>
                                <div class="text-[10px] text-gray-400">ID Pasien: #{{ $item->id_pasien }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <div class="flex flex-col">
                                    <span class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($item->tanggal_janji)->format('d M Y') }}</span>
                                    <span class="text-xs text-indigo-500 font-medium italic">{{ $item->jam_janji }} WIB</span>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-sm">
                                @php
                                    $color = [
                                        'menunggu' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                        'dikonfirmasi' => 'bg-blue-100 text-blue-700 border-blue-200',
                                        'selesai' => 'bg-green-100 text-green-700 border-green-200',
                                        'dibatalkan' => 'bg-red-100 text-red-700 border-red-200',
                                    ][$item->status] ?? 'bg-gray-100 text-gray-700 border-gray-200';
                                @endphp
                                <span class="{{ $color }} px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-tight border shadow-sm">
                                    {{ $item->status }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-500 italic max-w-xs">
                                "{{ Str::limit($item->catatan_keluhan, 50) }}"
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if ($item->status === 'menunggu')
                                    <form action="{{ route('psychologist.consultations.konfirmasi', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-xl text-sm transition transform hover:scale-105 active:scale-95 shadow-md font-bold">
                                            <i class="fa-solid fa-check mr-1"></i> Konfirmasi
                                        </button>
                                    </form>
                                @elseif($item->status === 'dikonfirmasi')
                                    @php
                                        $hariIni = \Carbon\Carbon::today()->format('Y-m-d');
                                        $isHariIni = $item->tanggal_janji == $hariIni;
                                    @endphp

                                    <a href="{{ $isHariIni ? route('psychologist.consultations.show', $item->id) : '#' }}"
                                        class="{{ $isHariIni ? 'bg-indigo-600 hover:bg-indigo-700' : 'bg-gray-300 cursor-not-allowed' }} text-white px-5 py-2 rounded-xl text-sm transition transform {{ $isHariIni ? 'hover:scale-105 shadow-md font-bold' : '' }} inline-block">
                                        <i class="fa-solid fa-comments mr-1"></i> {{ $isHariIni ? 'Buka Sesi' : 'Belum Waktunya' }}
                                    </a>
                                    @if(!$isHariIni)
                                        <p class="text-[9px] text-gray-400 mt-1 italic uppercase font-bold tracking-tighter">Hanya tersedia sesuai tanggal</p>
                                    @endif
                                @elseif($item->status === 'selesai')
                                    <div class="flex flex-col items-center">
                                        <span class="text-green-600 font-bold text-xs"><i class="fa-solid fa-circle-check"></i> Selesai</span>
                                        <a href="{{ route('psychologist.medical_records.index') }}" class="text-[10px] text-indigo-500 hover:underline">Lihat Catatan</a>
                                    </div>
                                @else
                                    <span class="text-gray-400 text-xs italic">Tidak Aktif</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="bg-gray-100 p-4 rounded-full mb-3 text-gray-300">
                                        <i class="fa-solid fa-calendar-xmark text-4xl"></i>
                                    </div>
                                    <p class="text-gray-400 italic font-medium">Tidak ada janji temu ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Script SweetAlert untuk Notifikasi -->
    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Mantap!',
                text: "{{ session('success') }}",
                background: '#f8fafc',
                timer: 3000,
                showConfirmButton: false,
                customClass: {
                    title: 'font-bold text-gray-800',
                    content: 'text-sm text-gray-600'
                }
            });
        </script>
    @endif
@endsection