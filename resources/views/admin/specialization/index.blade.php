@extends('layouts.app')

@section('content')
    <div class="p-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Master Spesialisasi</h1>
                <p class="text-sm text-gray-500">Kelola kategori keahlian psikolog untuk sistem Tenang.in</p>
            </div>
            <button onclick="toggleModal('modalTambahSpec')"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-indigo-200">
                <i class="fa-solid fa-tag"></i> Tambah Kategori
            </button>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Kode</th>
                        <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Nama Spesialisasi</th>
                        <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach ($specializations as $index => $spec)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">
                                <span class="bg-indigo-50 text-indigo-600 px-3 py-1 rounded-lg text-xs font-bold uppercase">
                                    {{ $spec->code }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-700">{{ $spec->name }}</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    {{-- Tombol Edit --}}
                                    <button onclick="openEditSpecModal({{ json_encode($spec) }})"
                                        class="p-2 text-gray-400 hover:text-indigo-600 transition-colors">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>

                                    {{-- Form Hapus --}}
                                    <form id="delete-spec-{{ $spec->id }}"
                                        action="{{ route('admin.specialization.destroy', $spec->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDeleteSpec({{ $spec->id }})"
                                            class="p-2 text-gray-400 hover:text-rose-600 transition-colors">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL TAMBAH --}}
    <div id="modalTambahSpec" class="fixed inset-0 z-[999] hidden transition-all duration-300">
        <div class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm" onclick="toggleModal('modalTambahSpec')"></div>
        <div class="flex items-center justify-center min-h-screen p-4 relative">
            <div class="bg-white w-full max-w-md rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
                <div class="px-8 py-6 border-b border-gray-50 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Tambah Spesialisasi</h3>
                    <button onclick="toggleModal('modalTambahSpec')" class="text-gray-400 hover:text-rose-500">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form action="{{ route('admin.specialization.store') }}" method="POST" class="p-8">
                    @csrf
                    <div class="space-y-5">
                        <div>
                            <label class="text-[11px] font-bold text-gray-400 uppercase mb-2 block">Kode (Contoh: SP-ANX)</label>
                            <input type="text" name="code" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:border-indigo-500 outline-none transition-all uppercase">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-gray-400 uppercase mb-2 block">Nama Spesialisasi</label>
                            <input type="text" name="name" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:border-indigo-500 outline-none transition-all">
                        </div>
                        <button type="submit" class="w-full py-4 bg-indigo-600 text-white rounded-2xl font-bold text-sm shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all">
                            Simpan Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div id="modalEditSpec" class="fixed inset-0 z-[999] hidden transition-all duration-300">
        <div class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm" onclick="toggleModal('modalEditSpec')"></div>
        <div class="flex items-center justify-center min-h-screen p-4 relative">
            <div class="bg-white w-full max-w-md rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
                <div class="px-8 py-6 border-b border-gray-50 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Edit Spesialisasi</h3>
                    <button onclick="toggleModal('modalEditSpec')" class="text-gray-400 hover:text-rose-500">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form id="formEditSpec" method="POST" class="p-8">
                    @csrf
                    @method('PUT')
                    <div class="space-y-5">
                        <div>
                            <label class="text-[11px] font-bold text-gray-400 uppercase mb-2 block">Kode</label>
                            <input type="text" name="code" id="edit_code" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:border-indigo-500 outline-none transition-all uppercase">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-gray-400 uppercase mb-2 block">Nama Spesialisasi</label>
                            <input type="text" name="name" id="edit_name" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:border-indigo-500 outline-none transition-all">
                        </div>
                        <button type="submit" class="w-full py-4 bg-indigo-600 text-white rounded-2xl font-bold text-sm shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all">
                            Update Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('admin.specialization.script')
@endsection

