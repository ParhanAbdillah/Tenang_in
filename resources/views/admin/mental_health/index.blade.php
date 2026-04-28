@extends('layouts.app')

@section('content')
    <div class="p-6">
        {{-- HEADER SECTION --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Manajemen Kuesioner</h1>
                <p class="text-slate-500 text-sm">Kelola kategori tes kesehatan mental untuk user.</p>
            </div>
            <button onclick="openModal('modal-category')"
                class="bg-rose-500 hover:bg-rose-600 text-white px-5 py-2.5 rounded-2xl flex items-center gap-2 transition-all shadow-lg shadow-rose-100 font-semibold text-sm">
                <i class="fa-solid fa-plus text-xs"></i> Tambah Kategori
            </button>
        </div>

        {{-- GRID KATEGORI --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($categories as $category)
                <div class="bg-white rounded-[2.5rem] p-6 shadow-sm border border-slate-100 flex flex-col gap-5 relative group hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-300">
                    
                    {{-- TOMBOL AKSI (MUNCUL SAAT HOVER) --}}
                    <div class="absolute top-5 right-5 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                        <button onclick="openEditModal({{ json_encode($category) }})"
                            class="w-10 h-10 flex items-center justify-center bg-white/90 backdrop-blur-sm text-amber-600 rounded-xl hover:bg-amber-500 hover:text-white transition-all shadow-sm border border-amber-100">
                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                        </button>

                        <form action="{{ route('admin.mental-health.categories.destroy', $category->id) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-10 h-10 flex items-center justify-center bg-white/90 backdrop-blur-sm text-rose-600 rounded-xl hover:bg-rose-500 hover:text-white transition-all shadow-sm border border-rose-100">
                                <i class="fa-solid fa-trash text-xs"></i>
                            </button>
                        </form>
                    </div>

                    {{-- INFO HEADER CARD --}}
                    <div class="flex justify-between items-start">
                        <div class="w-14 h-14 bg-gradient-to-br from-indigo-50 to-blue-50 rounded-2xl flex items-center justify-center shadow-inner">
                            <i class="fa-solid fa-clipboard-list text-xl text-indigo-600"></i>
                        </div>
                        <span class="px-3 py-1.5 bg-emerald-50 text-emerald-600 text-[10px] font-bold rounded-full tracking-wider uppercase">
                            {{ $category->questions_count }} SOAL
                        </span>
                    </div>

                    {{-- KONTEN TEKS --}}
                    <div class="space-y-2">
                        <h3 class="text-lg font-bold text-slate-800 leading-tight">{{ $category->name }}</h3>
                        <p class="text-slate-500 text-sm line-clamp-2 leading-relaxed h-10">{{ $category->description ?? 'Tidak ada deskripsi.' }}</p>
                    </div>

                    {{-- PREVIEW GAMBAR --}}
                    <div class="h-36 w-full rounded-[1.5rem] overflow-hidden bg-slate-100 border border-slate-50 shadow-inner">
                        @if ($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 bg-slate-50">
                                <i class="fa-regular fa-image text-2xl mb-1"></i>
                                <span class="text-[10px] font-medium uppercase tracking-widest">No Image</span>
                            </div>
                        @endif
                    </div>

                    {{-- TOMBOL NAVIGASI --}}
                    <div class="grid grid-cols-2 gap-3 mt-auto">
                        <a href="{{ route('admin.mental-health.questions', $category->id) }}"
                            class="text-center bg-slate-50 hover:bg-slate-100 text-slate-700 text-xs font-bold py-3.5 rounded-2xl border border-slate-200 transition-all hover:border-slate-300">
                            Kelola Soal
                        </a>
                        <a href="{{ route('admin.mental-health.indicators.index', $category->id) }}"
                            class="text-center bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold py-3.5 rounded-2xl shadow-lg shadow-indigo-100 transition-all hover:-translate-y-0.5">
                            Atur Skor
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- MODAL TAMBAH KATEGORI --}}
    <div id="modal-category" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-md z-[60] flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-md rounded-[2.5rem] p-8 shadow-2xl animate-in zoom-in duration-300">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-slate-800">Tambah Kategori</h2>
                <button onclick="closeModal('modal-category')" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form action="{{ route('admin.mental-health.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">Nama Tes</label>
                        <input type="text" name="name" required placeholder="Contoh: Tes Kecemasan"
                            class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-500 focus:bg-white rounded-2xl px-5 py-3.5 text-sm transition-all outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">Foto Sampul</label>
                        <div class="flex items-center justify-center w-full">
                            <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-slate-200 border-dashed rounded-2xl cursor-pointer bg-slate-50 hover:bg-slate-100 transition-all">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fa-solid fa-cloud-arrow-up text-slate-400 mb-2"></i>
                                    <p class="text-xs text-slate-500 font-medium">Klik untuk upload foto</p>
                                </div>
                                <input type="file" name="image" accept="image/*" class="hidden" />
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">Deskripsi</label>
                        <textarea name="description" rows="3" placeholder="Jelaskan tujuan tes ini..."
                            class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-500 focus:bg-white rounded-2xl px-5 py-3.5 text-sm transition-all outline-none resize-none"></textarea>
                    </div>
                </div>

                <div class="flex gap-3 mt-8">
                    <button type="button" onclick="closeModal('modal-category')"
                        class="flex-1 py-4 text-sm font-bold text-slate-500 bg-slate-100 hover:bg-slate-200 rounded-2xl transition-all">Batal</button>
                    <button type="submit"
                        class="flex-1 py-4 text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 rounded-2xl shadow-lg shadow-indigo-200 transition-all">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL EDIT KATEGORI (FIXED) --}}
    <div id="modal-edit-category" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-md z-[60] flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-md rounded-[2.5rem] p-8 shadow-2xl">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-slate-800">Edit Kategori</h2>
                <button onclick="closeModal('modal-edit-category')" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form id="edit-form" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="space-y-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">Nama Tes</label>
                        <input type="text" id="edit-name" name="name" required
                            class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-500 focus:bg-white rounded-2xl px-5 py-3.5 text-sm transition-all outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">Ganti Foto (Opsional)</label>
                        <input type="file" name="image" accept="image/*"
                            class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 cursor-pointer">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">Deskripsi</label>
                        <textarea id="edit-description" name="description" rows="3"
                            class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-500 focus:bg-white rounded-2xl px-5 py-3.5 text-sm transition-all outline-none resize-none"></textarea>
                    </div>
                </div>

                <div class="flex gap-3 mt-8">
                    <button type="button" onclick="closeModal('modal-edit-category')"
                        class="flex-1 py-4 text-sm font-bold text-slate-500 bg-slate-100 hover:bg-slate-200 rounded-2xl transition-all">Batal</button>
                    <button type="submit"
                        class="flex-1 py-4 text-sm font-bold text-white bg-amber-500 hover:bg-amber-600 rounded-2xl shadow-lg shadow-amber-100 transition-all">Update</button>
                </div>
            </form>
        </div>
    </div>

    {{-- SCRIPTS --}}
    <script>
        function openModal(id) {
            const modal = document.getElementById(id);
            modal.classList.remove('hidden');
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            modal.classList.add('hidden');
        }

        function openEditModal(category) {
            const modal = document.getElementById('modal-edit-category');
            const form = document.getElementById('edit-form');
            
            // Set Dynamic Action URL
            form.action = `/admin/mental-health/categories/${category.id}`;
            
            // Set Input Values
            document.getElementById('edit-name').value = category.name;
            document.getElementById('edit-description').value = category.description ?? '';
            
            modal.classList.remove('hidden');
        }

        // Tutup modal jika klik di luar area modal
        window.onclick = function(event) {
            const modals = ['modal-category', 'modal-edit-category'];
            modals.forEach(id => {
                const modal = document.getElementById(id);
                if (event.target == modal) {
                    closeModal(id);
                }
            });
        }
    </script>
@endsection