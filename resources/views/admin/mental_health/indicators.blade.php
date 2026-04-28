@extends('layouts.app')

@section('content')
<div class="p-6 max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 italic">Atur Indikator: {{ $category->name }}</h1>
            <p class="text-slate-500 text-sm">Tentukan rentang skor dan status hasil untuk user.</p>
        </div>
        <a href="{{ route('admin.mental-health.index') }}" class="px-4 py-2 bg-slate-100 text-slate-600 rounded-xl text-sm font-semibold">Kembali</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 h-fit">
            <h2 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-plus-circle text-indigo-500"></i> Tambah Indikator
            </h2>
            <form action="{{ route('admin.mental-health.indicators.store', $category->id) }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-slate-400 uppercase">Skor Min</label>
                            <input type="number" name="min_score" class="w-full bg-slate-50 border-none rounded-xl mt-1" required placeholder="0">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-400 uppercase">Skor Max</label>
                            <input type="number" name="max_score" class="w-full bg-slate-50 border-none rounded-xl mt-1" required placeholder="4">
                        </div>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase">Status Hasil</label>
                        <input type="text" name="status" class="w-full bg-slate-50 border-none rounded-xl mt-1" required placeholder="Contoh: Kecemasan Berat">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase">Warna Visual</label>
                        <input type="color" name="color" class="w-full h-10 p-1 bg-slate-50 border-none rounded-xl mt-1" value="#4f46e5">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase">Rekomendasi Spesialis</label>
                        <select name="recommended_specialization_id" class="w-full bg-slate-50 border-none rounded-xl mt-1 text-sm">
                            <option value="">Pilih Spesialisasi</option>
                            @foreach($specializations as $sp)
                                <option value="{{ $sp->id }}">{{ $sp->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="w-full py-3 bg-indigo-600 text-white rounded-xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all">Simpan Indikator</button>
                </div>
            </form>
        </div>

        <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="p-4 text-xs font-bold text-slate-400 uppercase">Rentang Skor</th>
                        <th class="p-4 text-xs font-bold text-slate-400 uppercase">Status & Warna</th>
                        <th class="p-4 text-xs font-bold text-slate-400 uppercase">Rekomendasi</th>
                        <th class="p-4 text-xs font-bold text-slate-400 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($indicators as $item)
                    <tr class="border-t border-slate-50 hover:bg-slate-50/50 transition-colors">
                        <td class="p-4">
                            <span class="px-3 py-1 bg-slate-100 rounded-full text-sm font-bold text-slate-600">
                                {{ $item->min_score }} - {{ $item->max_score }}
                            </span>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center gap-2">
                                <div class="w-4 h-4 rounded-full" style="background-color: {{ $item->color }}"></div>
                                <span class="font-bold text-slate-700">{{ $item->status }}</span>
                            </div>
                        </td>
                        <td class="p-4 text-sm text-slate-500">
                            {{ $item->specialization->name ?? 'Psikolog Umum' }}
                        </td>
                        <td class="p-4">
                            <form action="{{ route('admin.mental-health.indicators.destroy', $item->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="text-rose-500 hover:text-rose-700"><i class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="p-10 text-center text-slate-400 italic text-sm">Belum ada indikator skor.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection