<script>
    // Konfigurasi SweetAlert profesional
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        customClass: { popup: 'rounded-2xl' }
    });

    @if(session('success'))
        Toast.fire({ icon: 'success', title: "{{ session('success') }}" });
    @endif

    @if(session('error'))
        Toast.fire({ icon: 'error', title: "{{ session('error') }}" });
    @endif

    function confirmDelete(id) {
        Swal.fire({
            title: '<span class="font-black text-slate-800">Hapus Slot Jadwal?</span>',
            text: "Pasien tidak akan bisa melakukan booking pada jam ini lagi.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f43f5e',
            cancelButtonColor: '#f1f5f9',
            confirmButtonText: 'Ya, Hapus Jadwal',
            cancelButtonText: '<span class="text-slate-500 font-bold">Batal</span>',
            customClass: { 
                popup: 'rounded-[32px] p-8',
                confirmButton: 'rounded-xl px-6 py-3 font-bold',
                cancelButton: 'rounded-xl px-6 py-3'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        });
    }

    // Loading state saat submit
    document.getElementById('scheduleForm').addEventListener('submit', function() {
        const btn = this.querySelector('button[type="submit"]');
        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-circle-notch animate-spin mr-2"></i> Memproses...';
        
        // Pastikan dropdown hari kerja ikut ter-submit (karena disabled/pointer-events-none kadang menghambat kalau tidak hati-hati, tapi kita pakai readonly via css saja)
    });

    // Otomatis ubah Hari sesuai dengan Tanggal yang dipilih
    document.getElementById('schedule_date').addEventListener('change', function() {
        if (!this.value) return;
        
        const dateObj = new Date(this.value);
        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const dayName = days[dateObj.getDay()];
        
        const daySelect = document.getElementById('schedule_day');
        daySelect.value = dayName;
    });
</script>