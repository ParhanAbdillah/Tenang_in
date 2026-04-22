
    <script>
        // Fungsi Toggle Modal Universal
        function toggleModal(id) {
            const modal = document.getElementById(id);
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                modal.classList.add('block');
            } else {
                modal.classList.add('hidden');
                modal.classList.remove('block');
            }
        }

        // Fungsi Buka Modal Edit & Isi Data
        function openEditSpecModal(data) {
            // Set Form Action URL (Sesuaikan dengan route admin kamu)
            const form = document.getElementById('formEditSpec');
            form.action = `/admin/specialization/${data.id}`;

            // Isi Value Input
            document.getElementById('edit_code').value = data.code;
            document.getElementById('edit_name').value = data.name;

            // Munculkan Modal
            toggleModal('modalEditSpec');
        }

        // Fungsi Konfirmasi Hapus SweetAlert2
        function confirmDeleteSpec(id) {
            Swal.fire({
                title: 'Hapus Kategori?',
                text: "Pastikan tidak ada psikolog yang menggunakan kode ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4f46e5',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                borderRadius: '1.5rem',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-spec-' + id).submit();
                }
            })
        }
    </script>
