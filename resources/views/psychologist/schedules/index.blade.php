@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fa-solid fa-calendar-check text-indigo-600"></i> Atur Jadwal Praktik
        </h2>
        <p class="text-sm text-gray-500">Kelola slot waktu praktik Anda agar pasien dapat melakukan reservasi.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Form Tambah Slot (Kiri) -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-bold text-gray-800 mb-6">Tambah Slot Waktu</h3>
                
                <form action="{{ route('psychologist.schedules.generate') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Pilih Tanggal</label>
                        <input type="date" name="tanggal" required
                            class="w-full rounded-xl border-gray-100 focus:ring-indigo-500 focus:border-indigo-500 text-sm shadow-sm">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Jam Mulai</label>
                            <input type="time" name="jam_mulai" required
                                class="w-full rounded-xl border-gray-100 focus:ring-indigo-500 focus:border-indigo-500 text-sm shadow-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Jam Selesai</label>
                            <input type="time" name="jam_selesai" required
                                class="w-full rounded-xl border-gray-100 focus:ring-indigo-500 focus:border-indigo-500 text-sm shadow-sm">
                        </div>
                    </div>

                    <button type="submit" 
                        class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold text-sm transition transform hover:scale-[1.02] active:scale-95 shadow-lg shadow-indigo-100 flex items-center justify-center gap-2">
                        Generate Slot Waktu <i class="fa-solid fa-bolt-lightning"></i>
                    </button>
                </form>

                <div class="mt-6 p-4 bg-blue-50 rounded-2xl border border-blue-100">
                    <p class="text-[11px] text-blue-700 leading-relaxed">
                        <strong>Tips:</strong> Sistem akan otomatis membagi rentang waktu Anda menjadi slot per 60 menit.
                    </p>
                </div>
            </div>
        </div>

        <!-- Daftar Jadwal Aktif (Kanan) -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 min-h-[500px]">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> JADWAL AKTIF PEKAN INI
                    </h3>
                    <span class="text-xs font-bold text-gray-400 bg-gray-50 px-3 py-1 rounded-full border border-gray-100">
                        {{ $schedules->count() }} Slot Ditemukan
                    </span>
                </div>

                <div class="space-y-4">
                    @forelse($schedules as $item)
                        <div class="group flex items-center justify-between p-4 bg-white border border-gray-100 rounded-2xl hover:border-indigo-200 hover:shadow-md transition-all">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-indigo-50 rounded-xl flex flex-col items-center justify-center text-indigo-600 border border-indigo-100">
                                    <span class="text-[10px] font-bold uppercase">{{ \Carbon\Carbon::parse($item->schedule_date)->format('D') }}</span>
                                    <span class="text-lg font-black">{{ \Carbon\Carbon::parse($item->schedule_date)->format('d') }}</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-800">{{ $item->start_time }} – {{ $item->end_time }}</p>
                                    <p class="text-[10px] text-gray-400 font-medium uppercase tracking-tighter">
                                        {{ \Carbon\Carbon::parse($item->schedule_date)->format('F Y') }} • <span class="text-green-500">{{ $item->status }}</span>
                                    </p>
                                </div>
                            </div>
                            
                            <form action="{{ route('psychologist.schedules.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus slot waktu ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-10 h-10 rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition flex items-center justify-center shadow-sm">
                                    <i class="fa-solid fa-trash-can text-sm"></i>
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center py-20 text-gray-300">
                            <i class="fa-solid fa-calendar-minus text-6xl mb-4"></i>
                            <p class="italic text-sm font-medium">Belum ada slot waktu yang dibuat.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert Notifikasi -->
@if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2500,
            background: '#ffffff',
            customClass: {
                title: 'font-bold text-gray-800',
                popup: 'rounded-3xl'
            }
        });
    </script>
@endif
@endsection