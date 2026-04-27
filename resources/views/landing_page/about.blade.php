<!-- --- HERO SECTION --- -->

<x-guest-layout>
    @include('landing_page.style')
    @include('landing_page.navbar')
    <section class="relative pt-32 pb-20 overflow-hidden hero-gradient">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-sage font-bold uppercase tracking-[0.3em] text-xs mb-4 animate-fade-up">Mengenal Lebih Dekat</p>
            <h1 class="text-5xl md:text-7xl font-bold leading-tight mb-8 animate-fade-up" style="animation-delay: 0.2s">
                Membangun Ekosistem<br>
                <span class="serif-italic font-normal text-sage italic">Kesehatan Mental yang Inklusif</span>
            </h1>
            <p class="max-w-2xl mx-auto text-lg text-[#718096] leading-relaxed animate-fade-up" style="animation-delay: 0.4s">
                Tenang-in hadir sebagai teman perjalananmu dalam memahami diri, mengatasi luka, dan menemukan kembali kebahagiaan melalui layanan psikologi profesional yang mudah diakses.
            </p>
        </div>
        
        <!-- Stats Row -->
        <div class="max-w-6xl mx-auto px-6 mt-20 grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center p-8 bg-white rounded-[32px] shadow-sm border border-gray-100 animate-fade-up" style="animation-delay: 0.6s">
                <h3 class="text-4xl font-bold text-sage mb-2">50+</h3>
                <p class="text-xs font-bold uppercase text-[#A0AEC0]">Psikolog Berlisensi</p>
            </div>
            <div class="text-center p-8 bg-white rounded-[32px] shadow-sm border border-gray-100 animate-fade-up" style="animation-delay: 0.7s">
                <h3 class="text-4xl font-bold text-sage mb-2">10k+</h3>
                <p class="text-xs font-bold uppercase text-[#A0AEC0]">Sesi Konseling</p>
            </div>
            <div class="text-center p-8 bg-white rounded-[32px] shadow-sm border border-gray-100 animate-fade-up" style="animation-delay: 0.8s">
                <h3 class="text-4xl font-bold text-sage mb-2">100k+</h3>
                <p class="text-xs font-bold uppercase text-[#A0AEC0]">Komunitas</p>
            </div>
            <div class="text-center p-8 bg-white rounded-[32px] shadow-sm border border-gray-100 animate-fade-up" style="animation-delay: 0.9s">
                <h3 class="text-4xl font-bold text-sage mb-2">4.9</h3>
                <p class="text-xs font-bold uppercase text-[#A0AEC0]">Rating Kepuasan</p>
            </div>
        </div>
    </section>

    <!-- --- STORY SECTION --- -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center gap-16">
            <div class="w-full md:w-1/2">
                <div class="relative">
                    <div class="absolute -top-4 -left-4 w-24 h-24 border-t-2 border-l-2 border-sage opacity-30"></div>
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&q=80&w=800" 
                         alt="Team Meeting" 
                         class="rounded-[40px] shadow-2xl grayscale hover:grayscale-0 transition-all duration-1000">
                </div>
            </div>
            <div class="w-full md:w-1/2">
                <h2 class="text-4xl font-bold mb-6">Cerita di Balik <span class="text-sage serif-italic italic font-normal">Tenang-in</span></h2>
                <p class="text-[#718096] mb-6 leading-relaxed">
                    Berawal dari keresahan akan sulitnya mendapatkan bantuan profesional kesehatan mental di Indonesia, Ibunda lahir di tahun 2026 sebagai wadah aman bagi siapa saja yang ingin bercerita tanpa takut dihakimi.
                </p>
                <p class="text-[#718096] mb-8 leading-relaxed">
                    Kami percaya bahwa kesehatan mental adalah hak asasi setiap individu. Oleh karena itu, kami terus berinovasi dalam mengintegrasikan teknologi dan empati manusia untuk menciptakan layanan yang personal.
                </p>
                <div class="flex space-x-12">
                    <div>
                        <p class="font-bold text-[#4A5568]">Visi</p>
                        <p class="text-sm text-[#718096]">Menjadi sahabat utama masyarakat Indonesia dalam mencapai kesejahteraan emosional.</p>
                    </div>
                    <div>
                        <p class="font-bold text-[#4A5568]">Misi</p>
                        <p class="text-sm text-[#718096]">Menghubungkan individu dengan ahli psikologi melalui cara yang paling nyaman.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- --- TEAM SECTION --- -->
    <section class="py-24 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Tim di Balik Layanan</h2>
                <p class="text-[#718096]">Dipimpin oleh para ahli yang berdedikasi untuk senyuman Anda.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Member 1 -->
                <div class="group">
                    <div class="relative overflow-hidden rounded-[32px] mb-6 bg-gray-200 aspect-[3/4]">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&q=80&w=400" 
                             alt="Founder" 
                             class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-105">
                    </div>
                    <h4 class="text-xl font-bold mb-1">Adit Pratama</h4>
                    <p class="text-sm text-sage font-semibold uppercase tracking-wider mb-2">Founder & CEO</p>
                    <p class="text-xs text-[#A0AEC0]">Fokus pada pengembangan strategi dan visi Ibunda.</p>
                </div>

                <!-- Member 2 -->
                <div class="group">
                    <div class="relative overflow-hidden rounded-[32px] mb-6 bg-gray-200 aspect-[3/4]">
                        <img src="https://images.unsplash.com/photo-1567532939604-b6c5b0adcc06?auto=format&fit=crop&q=80&w=400" 
                             alt="Clinical Director" 
                             class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-105">
                    </div>
                    <h4 class="text-xl font-bold mb-1">Siska Amelia, M.Psi</h4>
                    <p class="text-sm text-sage font-semibold uppercase tracking-wider mb-2">Clinical Director</p>
                    <p class="text-xs text-[#A0AEC0]">Menjamin standar kualitas layanan psikologi kami.</p>
                </div>

                <!-- Member 3 -->
                <div class="group">
                    <div class="relative overflow-hidden rounded-[32px] mb-6 bg-gray-200 aspect-[3/4]">
                        <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&q=80&w=400" 
                             alt="CTO" 
                             class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-105">
                    </div>
                    <h4 class="text-xl font-bold mb-1">Budi Setiawan</h4>
                    <p class="text-sm text-sage font-semibold uppercase tracking-wider mb-2">CTO</p>
                    <p class="text-xs text-[#A0AEC0]">Pengembang platform aman dan nyaman bagi user.</p>
                </div>

                <!-- Member 4 -->
                <div class="group">
                    <div class="relative overflow-hidden rounded-[32px] mb-6 bg-gray-200 aspect-[3/4]">
                        <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&q=80&w=400" 
                             alt="Head of Marketing" 
                             class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-105">
                    </div>
                    <h4 class="text-xl font-bold mb-1">Maya Putri</h4>
                    <p class="text-sm text-sage font-semibold uppercase tracking-wider mb-2">Head of Community</p>
                    <p class="text-xs text-[#A0AEC0]">Menjaga hubungan erat dengan komunitas Ibunda.</p>
                </div>
            </div>
        </div>
    </section>
    @include('landing_page.footer')
    @include('landing_page.script')
</x-guest-layout>