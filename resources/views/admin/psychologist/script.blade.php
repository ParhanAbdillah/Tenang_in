{{-- Delete Sciprt --}}

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data psikolog ini akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f43f5e', // warna rose-500
            cancelButtonColor: '#9ca3af', // warna gray-400
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            borderRadius: '1.5rem',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>

{{-- Modal Script --}}
<script>
    function toggleModal(id) {
        const modal = document.getElementById(id);
        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.add('opacity-100');
            }, 10);
        } else {
            modal.classList.remove('opacity-100');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
    }
</script>

{{-- Modal Edit Script --}}
<script>
    ffunction openEditModal(psy) {
        // Set Action Form
        const form = document.getElementById('formEdit');
        form.action = `/admin/psychologist/${psy.id}`;

        // Isi data ke input modal
        document.getElementById('edit_name').value = psy.name;
        document.getElementById('edit_email').value = psy.email;
        document.getElementById('edit_phone').value = psy.phone;
        document.getElementById('edit_license').value = psy.license_number;
        document.getElementById('edit_specialization').value = psy.specialization;
        document.getElementById('edit_experience').value = psy.experience_years;
        document.getElementById('edit_price').value = psy.price_per_session;
        document.getElementById('edit_status').value = psy.status;
        document.getElementById('edit_bio').value = psy.bio || '';

        toggleModal('modalEdit');
    }
</script>
