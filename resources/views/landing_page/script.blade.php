    <script>
        const carousel = document.getElementById('psychologistCarousel');
        const navBars = document.querySelectorAll('.nav-bar');

        /**
         * Menggulir carousel ke indeks tertentu berdasarkan klik indikator
         */
        function scrollToIndex(index) {
            const card = carousel.querySelector('div');
            const cardWidth = card.offsetWidth + 24; // Lebar kartu + gap (6 * 4px)
            carousel.scrollTo({
                left: index * cardWidth,
                behavior: 'smooth'
            });
            // Indikator akan diperbarui secara otomatis oleh event listener 'scroll'
        }

        /**
         * Memperbarui tampilan visual indikator garis
         */
        function updateNavBars(activeIndex) {
            navBars.forEach((bar, i) => {
                if (i === activeIndex) {
                    bar.classList.remove('bg-gray-300');
                    bar.classList.add('bg-[#0A3D5A]');
                } else {
                    bar.classList.add('bg-gray-300');
                    bar.classList.remove('bg-[#0A3D5A]');
                }
            });
        }

        /**
         * Event listener untuk mendeteksi guliran (scroll) carousel
         * dan memperbarui posisi indikator secara real-time
         */
        carousel.addEventListener('scroll', () => {
            const card = carousel.querySelector('div');
            const cardWidth = card.offsetWidth + 24;
            // Menghitung indeks berdasarkan posisi scroll saat ini
            const index = Math.round(carousel.scrollLeft / cardWidth);

            // Pastikan indeks tidak melebihi jumlah indikator yang tersedia
            if (index >= 0 && index < navBars.length) {
                updateNavBars(index);
            }
        });

        // Inisialisasi awal untuk memastikan indikator pertama aktif
        window.addEventListener('load', () => {
            updateNavBars(0);
        });
    </script>



    <script>
        // --- LOGIKA MEGA MENU (KLIK) ---
        function toggleMegaMenu(event) {
            event.stopPropagation(); // Mencegah event bubbling
            const menu = document.getElementById('mega-menu');
            const arrow = document.getElementById('arrow-icon');

            const isActive = menu.classList.contains('active');

            if (isActive) {
                menu.classList.remove('active');
                arrow.style.transform = 'rotate(0deg)';
                setTimeout(() => {
                    menu.style.display = 'none';
                }, 300);
            } else {
                menu.style.display = 'grid';
                // Trigger reflow untuk animasi
                menu.offsetHeight;
                menu.classList.add('active');
                arrow.style.transform = 'rotate(180deg)';
            }
        }

        // Tutup menu jika klik di luar area navbar
        document.addEventListener('click', (event) => {
            const menu = document.getElementById('mega-menu');
            const arrow = document.getElementById('arrow-icon');
            const nav = document.getElementById('main-nav');

            if (!nav.contains(event.target) && menu.classList.contains('active')) {
                menu.classList.remove('active');
                arrow.style.transform = 'rotate(0deg)';
                setTimeout(() => {
                    menu.style.display = 'none';
                }, 300);
            }
        });

        // --- LOGIKA CAROUSEL SLIDING ---
        let currentSlide = 0;
        const track = document.getElementById('carousel-track');
        const dots = document.querySelectorAll('.dot');

        function updateCarousel() {
            track.style.transform = `translateX(-${currentSlide * 50}%)`;
            dots.forEach((dot, idx) => {
                if (idx === currentSlide) {
                    dot.classList.add('active-dot');
                } else {
                    dot.classList.remove('active-dot');
                }
            });
        }

        function goToSlide(index) {
            currentSlide = index;
            updateCarousel();
        }

        function autoSlide() {
            currentSlide = (currentSlide + 1) % 2;
            updateCarousel();
        }

        setInterval(autoSlide, 7000);
    </script>