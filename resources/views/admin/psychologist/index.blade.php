@extends('layouts.app')

@section('content')
    <div class="p-8 space-y-8 min-h-screen">
        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Manajemen Psikolog</h2>
                <p class="text-sm text-slate-500 mt-1 font-medium">Sistem kendali data terapis dan verifikasi profesional.
                </p>
            </div>
            <button onclick="toggleModal('modalTambah')"
                class="bg-rose-500 hover:bg-rose-600 text-white px-6 py-3 rounded-2xl font-bold text-sm transition-all flex items-center gap-2 shadow-xl shadow-rose-200 active:scale-95">
                <i class="fa-solid fa-plus-circle text-lg"></i> Tambah Psikolog
            </button>
        </div>

        {{-- Table Section --}}
        <div class="bg-white rounded-[32px] shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-50 flex items-center justify-between bg-white/50 backdrop-blur-md">
                <div class="relative w-80">
                    <i
                        class="fa-solid fa-magnifying-glass absolute left-4 top-4/6 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" placeholder="Cari nama atau lisensi..."
                        class="w-full pl-11 pr-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-4 focus:ring-rose-500/10 focus:border-rose-500 transition-all placeholder:text-slate-400">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left border-collapse">
                    <thead
                        class="bg-slate-50/80 text-[11px] uppercase text-slate-500 font-bold tracking-widest border-b border-slate-100">
                        <tr>
                            <th class="px-8 py-5">Psikolog</th>
                            <th class="px-6 py-5">Spesialisasi</th>
                            <th class="px-6 py-5">STR / Lisensi</th>
                            <th class="px-6 py-5 text-center">Status</th>
                            <th class="px-8 py-5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach ($psychologists as $psy)
                            <tr class="hover:bg-slate-50/50 transition-all group">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        @if ($psy->photo)
                                            <img src="{{ asset('storage/' . $psy->photo) }}"
                                                class="w-12 h-12 rounded-xl object-cover border-2 border-white shadow-sm group-hover:scale-105 transition-transform">
                                        @else
                                            <div
                                                class="w-12 h-12 rounded-xl bg-rose-50 flex items-center justify-center text-rose-500 border border-rose-100 font-black text-xs">
                                                {{ strtoupper(substr($psy->name, 0, 2)) }}
                                            </div>
                                        @endif
                                        <div>
                                            <p class="text-slate-800 font-bold text-sm leading-none mb-1">
                                                {{ $psy->name }}</p>
                                            <p class="text-[11px] text-slate-400 font-medium">{{ $psy->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <span
                                        class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded-lg text-[10px] font-extrabold uppercase">{{ $psy->specialization }}</span>
                                </td>
                                <td class="px-6 py-5 font-mono text-[11px] text-slate-500">{{ $psy->license_number }}</td>
                                <td class="px-6 py-5 text-center">
                                    <span
                                        class="px-3 py-1 rounded-full text-[10px] font-black uppercase {{ $psy->status == 'active' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-amber-50 text-amber-600 border border-amber-100' }}">
                                        {{ $psy->status }}
                                    </span>
                                </td>
                                <td class="px-8 py-5 text-center">
                                    <div class="flex justify-center gap-1">
                                        <a href="{{ route('admin.schedule.show', $psy->id) }}"
                                            class="w-9 h-9 flex items-center justify-center text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all"
                                            title="Atur Jadwal Praktik">
                                            <i class="fa-solid fa-calendar-days text-sm"></i>
                                        </a>
                                        {{-- Button Info --}}
                                        <button onclick="showInfo({{ $psy }})"
                                            class="w-9 h-9 flex items-center justify-center text-slate-400 hover:text-sky-600 hover:bg-sky-50 rounded-xl transition-all"
                                            title="Detail Info">
                                            <i class="fa-solid fa-circle-info text-sm"></i>
                                        </button>
                                        {{-- Button Edit --}}
                                        <button onclick="openEditModal({{ $psy }})"
                                            class="w-9 h-9 flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all">
                                            <i class="fa-solid fa-pen-to-square text-sm"></i>
                                        </button>
                                        {{-- Button Delete --}}
                                        <form id="delete-form-{{ $psy->id }}"
                                            action="{{ route('admin.psychologist.destroy', $psy->id) }}" method="POST"
                                            class="inline">
                                            @csrf @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{ $psy->id }})"
                                                class="w-9 h-9 flex items-center justify-center text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all">
                                                <i class="fa-solid fa-trash-can text-sm"></i>
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
    </div>

    {{-- MODAL TAMBAH (FULL INPUT) --}}
    <div id="modalTambah" class="fixed inset-0 z-[999] hidden overflow-y-auto">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-md" onclick="toggleModal('modalTambah')"></div>
        <div class="flex items-center justify-center min-h-screen p-4">
            <div
                class="relative bg-white w-full max-w-4xl rounded-[40px] shadow-2xl overflow-hidden z-[1000] border border-white/20">
                <div class="px-10 py-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                    <h3 class="text-2xl font-black text-slate-800">Registrasi Psikolog</h3>
                    <button onclick="toggleModal('modalTambah')"
                        class="text-slate-400 hover:text-rose-500 transition-all"><i
                            class="fa-solid fa-xmark text-xl"></i></button>
                </div>

                <form action="{{ route('admin.psychologist.store') }}" method="POST" enctype="multipart/form-data"
                    class="p-10">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        {{-- Photo Section --}}
                        <div class="space-y-4">
                            <div class="relative group">
                                <div id="previewContainer"
                                    class="w-full aspect-square rounded-[32px] bg-slate-50 border-2 border-dashed border-slate-200 flex items-center justify-center overflow-hidden transition-all group-hover:border-rose-300">
                                    <img id="imgPreview" src="" class="hidden w-full h-full object-cover">
                                    <div id="placeholderPreview" class="text-center p-4">
                                        <i class="fa-solid fa-camera text-4xl text-slate-200 mb-2"></i>
                                        <p class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">Pilih Foto
                                            Profile</p>
                                    </div>
                                </div>
                                <input type="file" name="photo" id="photoInput" accept="image/*"
                                    class="absolute inset-0 opacity-0 cursor-pointer"
                                    onchange="previewImage(this, 'imgPreview', 'placeholderPreview')">
                            </div>
                            <div class="bg-rose-50 p-4 rounded-2xl border border-rose-100">
                                <p class="text-[10px] font-bold text-rose-500 uppercase mb-1">💡 Tips Foto</p>
                                <p class="text-[10px] text-rose-400 leading-relaxed font-medium">Gunakan foto profesional
                                    dengan background polos agar tampilan aplikasi konsisten.</p>
                            </div>
                        </div>

                        {{-- Form Inputs Section --}}
                        <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase mb-1.5 block ml-1">Nama
                                    Lengkap & Gelar</label>
                                <input type="text" name="name" required
                                    class="w-full px-5 py-3.5 bg-slate-50 border-none rounded-2xl text-sm focus:ring-2 focus:ring-rose-500/20 shadow-inner"
                                    placeholder="Dr. Tono, M.Psi">
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase mb-1.5 block ml-1">Email
                                    Aktif</label>
                                <input type="email" name="email" required
                                    class="w-full px-5 py-3.5 bg-slate-50 border-none rounded-2xl text-sm focus:ring-2 focus:ring-rose-500/20 shadow-inner">
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase mb-1.5 block ml-1">No.
                                    WhatsApp</label>
                                <input type="text" name="phone" required
                                    class="w-full px-5 py-3.5 bg-slate-50 border-none rounded-2xl text-sm focus:ring-2 focus:ring-rose-500/20 shadow-inner">
                            </div>
                            <div>
                                <label
                                    class="text-[10px] font-black text-slate-400 uppercase mb-1.5 block ml-1">Spesialisasi</label>
                                <select name="specialization" required
                                    class="w-full px-5 py-3.5 bg-slate-50 border-none rounded-2xl text-sm focus:ring-2 focus:ring-rose-500/20 shadow-inner">
                                    @foreach ($specializations as $spec)
                                        <option value="{{ $spec->code }}">{{ $spec->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase mb-1.5 block ml-1">Nomor STR
                                    (Lisensi)</label>
                                <input type="text" name="license_number" required
                                    class="w-full px-5 py-3.5 bg-slate-50 border-none rounded-2xl text-sm focus:ring-2 focus:ring-rose-500/20 shadow-inner">
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase mb-1.5 block ml-1">Pengalaman
                                    (Tahun)</label>
                                <input type="number" name="experience_years" required
                                    class="w-full px-5 py-3.5 bg-slate-50 border-none rounded-2xl text-sm focus:ring-2 focus:ring-rose-500/20 shadow-inner">
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase mb-1.5 block ml-1">Harga per
                                    Sesi (Rp)</label>
                                <input type="number" name="price_per_session" required
                                    class="w-full px-5 py-3.5 bg-slate-50 border-none rounded-2xl text-sm focus:ring-2 focus:ring-rose-500/20 shadow-inner">
                            </div>
                            <div class="col-span-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase mb-1.5 block ml-1">Biografi
                                    Singkat</label>
                                <textarea name="bio" rows="3"
                                    class="w-full px-5 py-3.5 bg-slate-50 border-none rounded-2xl text-sm focus:ring-2 focus:ring-rose-500/20 shadow-inner"
                                    placeholder="Tuliskan keahlian dan pendekatan terapi..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 flex gap-4">
                        <button type="button" onclick="toggleModal('modalTambah')"
                            class="flex-1 py-4 font-bold text-xs text-slate-400 bg-slate-50 rounded-2xl">Batal</button>
                        <button type="submit"
                            class="flex-[2] py-4 font-bold text-xs text-white bg-rose-500 rounded-2xl shadow-xl shadow-rose-100 hover:bg-rose-600 transition-all">Daftarkan
                            Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT (FULL INPUT) --}}
    <div id="modalEdit" class="fixed inset-0 z-[999] hidden overflow-y-auto">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-md" onclick="toggleModal('modalEdit')"></div>
        <div class="flex items-center justify-center min-h-screen p-4">
            <div
                class="relative bg-white w-full max-w-4xl rounded-[40px] shadow-2xl overflow-hidden z-[1000] border border-white/20 transition-all transform">
                <div class="px-10 py-8 border-b border-slate-50 flex justify-between items-center bg-indigo-50/30">
                    <h3 class="text-2xl font-black text-slate-800">Edit Data Profesional</h3>
                    <button onclick="toggleModal('modalEdit')"
                        class="text-slate-400 hover:text-indigo-500 transition-all"><i
                            class="fa-solid fa-xmark text-xl"></i></button>
                </div>

                <form id="formEdit" method="POST" enctype="multipart/form-data" class="p-10">
                    @csrf @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        {{-- Photo Update --}}
                        <div class="space-y-4">
                            <div class="relative group">
                                <div id="editPreviewWrap"
                                    class="w-full aspect-square rounded-[32px] bg-slate-50 border-2 border-indigo-100 flex items-center justify-center overflow-hidden shadow-inner">
                                    <img id="editImgPreview" src="" class="w-full h-full object-cover">
                                </div>
                                <input type="file" name="photo" id="editPhotoInput" accept="image/*"
                                    class="absolute inset-0 opacity-0 cursor-pointer"
                                    onchange="previewImage(this, 'editImgPreview', null)">
                            </div>
                            <p class="text-[10px] font-black text-center text-indigo-400 uppercase tracking-widest">Ganti
                                Foto Profil</p>
                        </div>

                        {{-- Inputs Section --}}
                        <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase mb-1.5 block ml-1">Nama
                                    Lengkap</label>
                                <input type="text" name="name" id="edit_name" required
                                    class="w-full px-5 py-3.5 bg-slate-50 border-none rounded-2xl text-sm focus:ring-2 focus:ring-indigo-500/20 shadow-inner">
                            </div>
                            <div>
                                <label
                                    class="text-[10px] font-black text-slate-400 uppercase mb-1.5 block ml-1">Email</label>
                                <input type="email" name="email" id="edit_email" required
                                    class="w-full px-5 py-3.5 bg-slate-50 border-none rounded-2xl text-sm focus:ring-2 focus:ring-indigo-500/20 shadow-inner">
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase mb-1.5 block ml-1">No.
                                    STR</label>
                                <input type="text" name="license_number" id="edit_license" required
                                    class="w-full px-5 py-3.5 bg-slate-50 border-none rounded-2xl text-sm focus:ring-2 focus:ring-indigo-500/20 shadow-inner">
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase mb-1.5 block ml-1">Harga
                                    Sesi</label>
                                <input type="number" name="price_per_session" id="edit_price" required
                                    class="w-full px-5 py-3.5 bg-slate-50 border-none rounded-2xl text-sm focus:ring-2 focus:ring-indigo-500/20 shadow-inner">
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase mb-1.5 block ml-1">Status
                                    Akun</label>
                                <select name="status" id="edit_status"
                                    class="w-full px-5 py-3.5 bg-slate-50 border-none rounded-2xl text-sm font-bold focus:ring-2 focus:ring-indigo-500/20 shadow-inner">
                                    <option value="active">Active</option>
                                    <option value="pending">Pending</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-span-2">
                                <label
                                    class="text-[10px] font-black text-slate-400 uppercase mb-1.5 block ml-1">Biografi</label>
                                <textarea name="bio" id="edit_bio" rows="3"
                                    class="w-full px-5 py-3.5 bg-slate-50 border-none rounded-2xl text-sm focus:ring-2 focus:ring-indigo-500/20 shadow-inner"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 flex gap-4">
                        <button type="button" onclick="toggleModal('modalEdit')"
                            class="flex-1 py-4 font-bold text-xs text-slate-400 bg-slate-50 rounded-2xl">Batal</button>
                        <button type="submit"
                            class="flex-[2] py-4 font-bold text-xs text-white bg-indigo-600 rounded-2xl shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition-all">Simpan
                            Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- SCRIPTS (NOTIF & PREVIEW) --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });

        // Tampilkan Notifikasi Laravel Session
        @if (session('success'))
            Toast.fire({
                icon: 'success',
                title: "{{ session('success') }}"
            });
        @endif

        // Image Preview Logic
        function previewImage(input, imgId, placeholderId) {
            const preview = document.getElementById(imgId);
            const placeholder = document.getElementById(placeholderId);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    if (placeholder) placeholder.classList.add('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Modal Toggles
        function toggleModal(id) {
            document.getElementById(id).classList.toggle('hidden');
        }

        // Open Edit Modal & Populate Data
        function openEditModal(psy) {
            const form = document.getElementById('formEdit');
            form.action = `/admin/psychologist/${psy.id}`;

            document.getElementById('edit_name').value = psy.name;
            document.getElementById('edit_email').value = psy.email;
            document.getElementById('edit_license').value = psy.license_number;
            document.getElementById('edit_price').value = psy.price_per_session;
            document.getElementById('edit_status').value = psy.status;
            document.getElementById('edit_bio').value = psy.bio || '';

            document.getElementById('editImgPreview').src = psy.photo ? `/storage/${psy.photo}` :
                `https://ui-avatars.com/api/?name=${psy.name}&background=random`;

            toggleModal('modalEdit');
        }

        // Confirm Delete
        function confirmDelete(id) {
            Swal.fire({
                title: 'Hapus Psikolog?',
                text: "Data yang dihapus tidak dapat dikembalikan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f43f5e',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-[32px]'
                }
            }).then((result) => {
                if (result.isConfirmed) document.getElementById(`delete-form-${id}`).submit();
            });
        }

        // Show Info SweetAlert
        function showInfo(psy) {
            Swal.fire({
                title: `<span class="text-xl font-black">${psy.name}</span>`,
                html: `
                    <div class="text-left space-y-3 mt-4 text-sm">
                        <div class="flex justify-between border-b pb-2"><b>Spesialisasi:</b> <span>${psy.specialization}</span></div>
                        <div class="flex justify-between border-b pb-2"><b>STR:</b> <span>${psy.license_number}</span></div>
                        <div class="flex justify-between border-b pb-2"><b>Harga/Sesi:</b> <span>Rp ${new Intl.NumberFormat().format(psy.price_per_session)}</span></div>
                        <div class="flex justify-between border-b pb-2"><b>WhatsApp:</b> <span>${psy.phone}</span></div>
                        <div class="pt-2 italic text-slate-500">"${psy.bio}"</div>
                    </div>
                `,
                confirmButtonColor: '#6366f1',
                confirmButtonText: 'Tutup',
                customClass: {
                    popup: 'rounded-[32px]'
                }
            });
        }
    </script>
@endsection
