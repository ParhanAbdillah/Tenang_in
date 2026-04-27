<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    :root {
        --sage-primary: #5F7A61;
        --sage-light: #8DA490;
        --warm-white: #FDFCFB;
        --soft-gray: #718096;
    }

    body {
        background-color: var(--warm-white);
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .hero-gradient {
        background: radial-gradient(circle at top right, #E9F0EC 0%, #FDFCFB 100%);
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .serif-italic {
        font-family: 'Playfair Display', serif;
        /* Pastikan font ini di-import */
    }

    .btn-zen-primary {
        background-color: var(--sage-primary);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .btn-zen-primary:hover {
        background-color: var(--sage-light);
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(95, 122, 97, 0.2);
    }

    /* Custom Scrollbar untuk Card Psikolog */
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }


    /* Container Pagination */
    .custom-line-pagination.swiper-pagination-bullets {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 12px;
    }

    /* Bentuk Garis Non-Aktif */
    .custom-line-pagination .swiper-pagination-bullet {
        width: 32px;
        /* Lebih lebar dari dot biasa */
        height: 6px;
        border-radius: 10px;
        background: #E2E8F0;
        opacity: 1;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        margin: 0 !important;
    }

    /* Bentuk Garis Aktif (Warna Biru Tua) */
    .custom-line-pagination .swiper-pagination-bullet-active {
        width: 60px;
        /* Garis memanjang saat aktif */
        background: #0A4D68;
        /* Warna brand Tenang-in */
    }

    /* Efek Hover Card Ulasan */
    .card-ulasan {
        position: relative;
        overflow: hidden;
        cursor: pointer;
        z-index: 1;
    }

    /* Membuat gradasi saat hover */
    .card-ulasan:hover {
        background: linear-gradient(135deg, #0A4D68 0%, #176B87 100%);
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(10, 77, 104, 0.15);
    }

    /* Memastikan transisi smooth pada teks */
    .card-ulasan p,
    .card-ulasan h4,
    .card-ulasan span {
        transition: color 0.4s ease;
    }

    
</style>
