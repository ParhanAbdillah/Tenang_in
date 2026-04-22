    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
        }

        .serif-italic {
            font-family: 'Playfair Display', serif;
            font-style: italic;
        }

        /* Palet Zen: Sage Green & Deep Slate */
        .hero-gradient {
            background: linear-gradient(180deg, #F0F4F2 0%, #DDE5E0 100%);
        }

        /* Carousel Slide Ke Samping */
        .carousel-container {
            display: flex;
            transition: transform 0.8s cubic-bezier(0.45, 0, 0.55, 1);
            width: 200%;
        }

        .carousel-slide {
            width: 50%;
            flex-shrink: 0;
        }

        /* Glassmorphism Effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .active-dot {
            width: 48px !important;
            background-color: #5F7A61 !important;
        }

        .btn-zen-primary {
            background-color: #5F7A61;
            transition: all 0.3s ease;
        }

        .btn-zen-primary:hover {
            background-color: #4A614C;
            transform: translateY(-2px);
        }

        .btn-zen-secondary {
            background-color: #4A5568;
            transition: all 0.3s ease;
        }

        .btn-zen-secondary:hover {
            background-color: #2D3748;
            transform: translateY(-2px);
        }

        /* Mega Menu Styles (Sistem Klik) */
        .mega-menu {
            display: none;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }

        .mega-menu.active {
            display: grid;
            opacity: 1;
            transform: translateY(0);
        }

        /* Mencegah klik di dalam menu menutup menu itu sendiri jika diinginkan */
        .mega-menu-content {
            pointer-events: auto;
        }

        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }

        .card-transition {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Hide scrollbar for carousel */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Footer Styling */
        .footer-bg {
            background-color: #052c3e;
            position: relative;
        }

        /* SVG Wave Styling - Dioptimalkan agar persis seperti gambar */
        .wave-top {
            position: absolute;
            top: -95px;
            /* Menyesuaikan agar gelombang menumpuk di atas konten */
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }

        .wave-top svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 100px;
        }

        .wave-top .shape-fill {
            fill: #052c3e;
        }

        .footer-link {
            color: #cbd5e1;
            transition: color 0.3s ease;
        }

        .footer-link:hover {
            color: #ffffff;
        }

        .badge-soon {
            background-color: #475569;
            color: white;
            font-size: 10px;
            padding: 1px 6px;
            border-radius: 4px;
            text-transform: uppercase;
        }
    </style>