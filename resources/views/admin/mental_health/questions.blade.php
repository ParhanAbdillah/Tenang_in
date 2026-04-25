@extends('layouts.app') {{-- Sesuaikan dengan layout admin Anda --}}

@section('content')
<div class="p-6">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.mental-health.index') }}" class="w-10 h-10 bg-white border border-slate-100 rounded-xl flex items-center justify-center text-slate-600 hover:bg-slate-50 transition-all">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-800">{{ $category->name }}</h1>
            <p class="text-slate-500">Daftar pertanyaan untuk kuesioner ini.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-1">
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                <h3 class="font-bold text-slate-800 mb-4">Tambah Pertanyaan Baru</h3>
                <form action="{{ route('admin.mental-health.questions.store', $category->id) }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Teks Pertanyaan</label>
                            <textarea name="question_text" rows="4" class="w-full bg-slate-50 border-none rounded-2xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500" placeholder="Contoh: Apakah Anda merasa sulit untuk bersantai?" required></textarea>
                        </div>
                        <button type="submit" class="w-full py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all">
                            Simpan Pertanyaan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">No</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Pertanyaan</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($questions as $index => $q)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 text-sm text-slate-600 font-medium">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 text-sm text-slate-600 leading-relaxed">{{ $q->question_text }}</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <button class="w-8 h-8 flex items-center justify-center bg-rose-50 text-rose-500 rounded-lg hover:bg-rose-100 transition-colors">
                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-10 text-center text-slate-400 italic text-sm">Belum ada pertanyaan. Silakan tambah lewat form di samping.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection