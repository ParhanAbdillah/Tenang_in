@extends('layouts.app')

@section('content')
    <div class="p-8 space-y-8  min-h-screen">
        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div class="space-y-1">
                <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight flex items-center gap-3">
                    <i class="fa-solid fa-calendar-check text-indigo-500"></i>
                    Atur Jadwal Praktik
                </h2>
                <p class="text-sm text-slate-500 font-medium italic">
                    Konfigurasi ketersediaan waktu untuk: <span
                        class="text-indigo-600 font-bold">{{ $psychologist->name }}</span>
                </p>
            </div>
            <a href="{{ route('admin.psychologist.index') }}"
                class="group flex items-center gap-2 bg-white px-5 py-2.5 rounded-2xl border border-slate-200 text-slate-500 hover:text-slate-800 hover:border-slate-300 transition-all font-bold text-sm shadow-sm">
                <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                Kembali ke Daftar
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Form Section --}}
            <div class="space-y-6">
                <div class="bg-white p-8 rounded-[32px] shadow-sm border border-slate-100 h-fit relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 to-purple-500"></div>

                    <h3 class="text-lg font-black text-slate-800 mb-6 flex items-center gap-2">
                        Tambah Slot Waktu
                    </h3>

                    <form id="scheduleForm" action="{{ route('admin.schedule.store') }}" method="POST" class="space-y-5">
                        @csrf
                        {{-- Pastikan variabel $psychologist ada di Controller --}}
                        <input type="hidden" name="psychologist_id" value="{{ $psychologist->id }}">

                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase mb-2 block tracking-widest">Pilih
                                Hari Kerja</label>
                            <div class="relative">
                                <select name="day" required
                                    class="w-full px-5 py-3.5 bg-slate-50 border-none rounded-2xl text-sm font-semibold text-slate-700 focus:ring-2 focus:ring-indigo-500/20 shadow-inner appearance-none cursor-pointer">
                                    <option value="" disabled selected>Pilih Hari...</option>
                                    @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                                        <option value="{{ $day }}">{{ $day }}</option>
                                    @endforeach
                                </select>
                                <i
                                    class="fa-solid fa-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-xs"></i>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="text-[10px] font-black text-slate-400 uppercase mb-2 block tracking-widest">Jam
                                    Mulai</label>
                                <input type="time" name="start_time" required
                                    class="w-full px-5 py-3.5 bg-slate-50 border-none rounded-2xl text-sm font-semibold text-slate-700 focus:ring-2 focus:ring-indigo-500/20 shadow-inner">
                            </div>
                            <div>
                                <label
                                    class="text-[10px] font-black text-slate-400 uppercase mb-2 block tracking-widest">Jam
                                    Selesai</label>
                                <input type="time" name="end_time" required
                                    class="w-full px-5 py-3.5 bg-slate-50 border-none rounded-2xl text-sm font-semibold text-slate-700 focus:ring-2 focus:ring-indigo-500/20 shadow-inner">
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full py-4 font-bold text-xs text-white bg-indigo-600 rounded-2xl shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition-all transform active:scale-95 flex items-center justify-center gap-2 group">
                            <span>Generate Slot Waktu</span>
                            <i class="fa-solid fa-bolt-lightning group-hover:rotate-12 transition-transform"></i>
                        </button>
                    </form>
                </div>

                {{-- Info Card --}}
                <div class="bg-indigo-50 p-6 rounded-[24px] border border-indigo-100">
                    <div class="flex gap-4">
                        <i class="fa-solid fa-circle-info text-indigo-500 mt-1"></i>
                        <p class="text-xs text-indigo-700 leading-relaxed font-medium">
                            <b>Tips:</b> Pastikan jam selesai lebih besar dari jam mulai. Sistem akan otomatis menandai slot
                            ini sebagai "Tersedia" untuk calon pasien.
                        </p>
                    </div>
                </div>
            </div>

            {{-- List Section --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-[32px] shadow-sm border border-slate-100 overflow-hidden min-h-[400px]">
                    <div class="p-6 border-b border-slate-50 bg-slate-50/30 flex justify-between items-center">
                        <h3 class="text-sm font-bold text-slate-700 uppercase tracking-widest flex items-center gap-2">
                            <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                            Jadwal Aktif Pekan Ini
                        </h3>
                        <span class="text-[10px] bg-slate-200 text-slate-600 px-3 py-1 rounded-full font-bold">
                            {{ $schedules->count() }} Slot Ditemukan
                        </span>
                    </div>

                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @forelse($schedules as $sch)
                                <div
                                    class="p-5 rounded-3xl border border-slate-100 bg-white hover:border-indigo-300 hover:shadow-md transition-all flex items-center justify-between group border-l-4 border-l-indigo-500">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex flex-col items-center justify-center shadow-sm">
                                            <span
                                                class="text-[10px] font-black uppercase leading-none">{{ substr($sch->day, 0, 3) }}</span>
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <p class="text-sm font-black text-slate-800 tracking-tight">
                                                    {{ \Carbon\Carbon::parse($sch->start_time)->format('H:i') }} -
                                                    {{ \Carbon\Carbon::parse($sch->end_time)->format('H:i') }}
                                                </p>
                                            </div>
                                            <p class="text-[11px] text-slate-400 font-bold uppercase tracking-widest">
                                                {{ $sch->day }}</p>
                                        </div>
                                    </div>

                                    <form action="{{ route('admin.schedule.destroy', $sch->id) }}" method="POST"
                                        id="delete-form-{{ $sch->id }}">
                                        @csrf @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $sch->id }})"
                                            class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 text-slate-400 hover:bg-rose-50 hover:text-rose-500 transition-all">
                                            <i class="fa-solid fa-trash-can text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <div class="col-span-2 py-20 flex flex-col items-center justify-center opacity-40">
                                    <i class="fa-solid fa-calendar-xmark text-6xl mb-4 text-slate-200"></i>
                                    <p class="text-slate-400 text-sm font-bold uppercase tracking-widest">Belum ada jadwal
                                        yang diatur</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('admin.schedule.script')
@endsection
