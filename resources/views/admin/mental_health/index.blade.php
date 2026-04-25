@extends('layouts.app') {{-- Sesuaikan dengan layout admin Anda --}}

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Manajemen Kuesioner</h1>
            <p class="text-slate-500">Kelola kategori tes kesehatan mental untuk user.</p>
        </div>
        <button onclick="openModal('modal-category')" class="bg-rose-500 hover:bg-rose-600 text-white px-4 py-2 rounded-xl flex items-center gap-2 transition-all shadow-lg shadow-rose-100">
            <i class="fa-solid fa-plus"></i> Tambah Kategori
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($categories as $category)
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600">
                    <i class="fa-solid fa-clipboard-list text-xl"></i>
                </div>
                <span class="bg-emerald-100 text-emerald-600 text-[10px] font-bold px-2 py-1 rounded-lg uppercase">
                    {{ $category->questions_count }} Soal
                </span>
            </div>
            <h3 class="font-bold text-slate-800 mb-2">{{ $category->name }}</h3>
            <p class="text-slate-500 text-sm mb-6 line-clamp-2">{{ $category->description }}</p>
            
            <div class="flex gap-2">
                <a href="{{ route('admin.mental-health.questions', $category->id) }}" class="flex-1 text-center bg-slate-50 hover:bg-slate-100 text-slate-600 text-sm font-semibold py-2 rounded-xl transition-colors">
                    Kelola Soal
                </a>
                <button class="w-10 h-10 flex items-center justify-center bg-rose-50 text-rose-500 rounded-xl hover:bg-rose-100">
                    <i class="fa-solid fa-trash-can"></i>
                </button>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div id="modal-category" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-md rounded-3xl p-8 shadow-2xl">
        <h2 class="text-xl font-bold text-slate-800 mb-6">Tambah Kategori Tes</h2>
        <form action="{{ route('admin.mental-health.category.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Tes</label>
                    <input type="text" name="name" class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500" placeholder="Contoh: Tes Tingkat Stres" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Deskripsi Singkat</label>
                    <textarea name="description" rows="3" class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500" placeholder="Jelaskan tujuan tes ini..."></textarea>
                </div>
            </div>
            <div class="flex gap-3 mt-8">
                <button type="button" onclick="closeModal('modal-category')" class="flex-1 py-3 text-sm font-semibold text-slate-500 hover:bg-slate-50 rounded-xl transition-colors">Batal</button>
                <button type="submit" class="flex-1 py-3 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-lg shadow-indigo-100 transition-all">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
    function closeModal(id) { document.getElementById(id).classList.add('hidden'); }
</script>
@endsection