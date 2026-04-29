<x-guest-layout>
    @include('landing_page.style')
    @include('landing_page.navbar')

    <section class="relative pt-32 pb-20 overflow-hidden bg-slate-50">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-[#D98324] font-bold uppercase tracking-[0.3em] text-xs mb-4 animate-fade-up">Mengenal Lebih Dekat</p>
            <h1 class="text-5xl md:text-7xl font-bold leading-tight mb-8 animate-fade-up text-slate-900" style="animation-delay: 0.2s">
                {{ \App\Models\WebConfig::get('about_hero_title', 'Membangun Ekosistem') }}<br>
                <span class="serif-italic font-normal text-[#D98324] italic">Kesehatan Mental Inklusif</span>
            </h1>
            <p class="max-w-2xl mx-auto text-lg text-slate-500 leading-relaxed animate-fade-up" style="animation-delay: 0.4s">
                {{ \App\Models\WebConfig::get('hero_description', 'Tenang-in hadir sebagai teman perjalananmu dalam memahami diri...') }}
            </p>
        </div>
        
        <div class="max-w-6xl mx-auto px-6 mt-20 grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center p-8 bg-white rounded-[32px] shadow-sm border border-slate-100 animate-fade-up" style="animation-delay: 0.6s text-center">
                <h3 class="text-4xl font-bold text-rose-500 mb-2">{{ \App\Models\WebConfig::get('stats_psychologists', '50+') }}</h3>
                <p class="text-xs font-bold uppercase text-slate-400">Psikolog Berlisensi</p>
            </div>
            <div class="text-center p-8 bg-white rounded-[32px] shadow-sm border border-slate-100 animate-fade-up" style="animation-delay: 0.7s">
                <h3 class="text-4xl font-bold text-blue-600 mb-2">{{ \App\Models\WebConfig::get('stats_sessions', '10k+') }}</h3>
                <p class="text-xs font-bold uppercase text-slate-400">Sesi Konseling</p>
            </div>
            <div class="text-center p-8 bg-white rounded-[32px] shadow-sm border border-slate-100 animate-fade-up" style="animation-delay: 0.8s text-center">
                <h3 class="text-4xl font-bold text-rose-500 mb-2">{{ \App\Models\WebConfig::get('stats_community', '100k+') }}</h3>
                <p class="text-xs font-bold uppercase text-slate-400">Komunitas</p>
            </div>
            <div class="text-center p-8 bg-white rounded-[32px] shadow-sm border border-slate-100 animate-fade-up" style="animation-delay: 0.9s text-center">
                <h3 class="text-4xl font-bold text-blue-600 mb-2">{{ \App\Models\WebConfig::get('stats_rating', '4.9') }}</h3>
                <p class="text-xs font-bold uppercase text-slate-400">Rating Kepuasan</p>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center gap-16">
            <div class="w-full md:w-1/2">
                <div class="relative">
                    <div class="absolute -top-4 -left-4 w-24 h-24 border-t-2 border-l-2 border-rose-500 opacity-30"></div>
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&q=80&w=800" 
                         alt="Team Meeting" 
                         class="rounded-[40px] shadow-2xl grayscale hover:grayscale-0 transition-all duration-1000">
                </div>
            </div>
            <div class="w-full md:w-1/2">
                <h2 class="text-4xl font-bold mb-6 text-slate-900">Cerita di Balik <span class="text-[#0A4D68] serif-italic italic font-normal">Tenang-in</span></h2>
                <p class="text-slate-500 mb-6 leading-relaxed">
                    {{ \App\Models\WebConfig::get('about_story_description_1', 'Berawal dari keresahan akan sulitnya mendapatkan bantuan profesional...') }}
                </p>
                <p class="text-slate-500 mb-8 leading-relaxed">
                    {{ \App\Models\WebConfig::get('about_story_description_2', 'Kami percaya bahwa kesehatan mental adalah hak asasi setiap individu.') }}
                </p>
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <p class="font-bold text-slate-800 mb-2 flex items-center gap-2">
                            <span class="w-2 h-2 bg-rose-500 rounded-full"></span> Visi
                        </p>
                        <p class="text-sm text-slate-500">{{ \App\Models\WebConfig::get('about_vision', 'Menjadi sahabat utama masyarakat Indonesia...') }}</p>
                    </div>
                    <div>
                        <p class="font-bold text-slate-800 mb-2 flex items-center gap-2">
                            <span class="w-2 h-2 bg-blue-600 rounded-full"></span> Misi
                        </p>
                        <p class="text-sm text-slate-500">{{ \App\Models\WebConfig::get('about_mission', 'Menghubungkan individu dengan ahli psikologi...') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 text-slate-900">Tim di Balik Layanan</h2>
                <p class="text-slate-500">Dipimpin oleh para ahli yang berdedikasi untuk senyuman Anda.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                
                {{-- MEMBER 1: CEO (Key: team_1) --}}
                <div class="group text-left">
                    <div class="relative overflow-hidden rounded-[32px] mb-6 bg-slate-200 aspect-[3/4] shadow-md">
                        <img src="{{ \App\Models\WebConfig::get('team_1_image') ? asset('storage/' . \App\Models\WebConfig::get('team_1_image')) : 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&q=80&w=400' }}" 
                             alt="{{ \App\Models\WebConfig::get('team_1_name', 'Dr. Muhamad Parhan Abdillah') }}" 
                             class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-105 text-left">
                    </div>
                    <h4 class="text-xl font-bold mb-1 text-slate-900">{{ \App\Models\WebConfig::get('team_1_name', 'Dr. Muhamad Parhan Abdillah') }}</h4>
                    <p class="text-sm text-rose-500 font-semibold uppercase tracking-wider mb-2 text-left">{{ \App\Models\WebConfig::get('team_1_title', 'CEO') }}</p>
                    <p class="text-xs text-slate-400 text-left">{{ \App\Models\WebConfig::get('team_1_description', 'Fokus pada pengembangan strategi dan visi Tenang-in.') }}</p>
                </div>

                {{-- MEMBER 2: CLINICAL DIRECTOR (Key: team_2) --}}
                <div class="group text-left">
                    <div class="relative overflow-hidden rounded-[32px] mb-6 bg-slate-200 aspect-[3/4] shadow-md">
                        <img src="{{ \App\Models\WebConfig::get('team_2_image') ? asset('storage/' . \App\Models\WebConfig::get('team_2_image')) : 'https://images.unsplash.com/photo-1567532939604-b6c5b0adcc06?auto=format&fit=crop&q=80&w=400' }}" 
                             alt="{{ \App\Models\WebConfig::get('team_2_name', 'Siska Amelia, M.Psi') }}" 
                             class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-105 text-left">
                    </div>
                    <h4 class="text-xl font-bold mb-1 text-slate-900">{{ \App\Models\WebConfig::get('team_2_name', 'Siska Amelia, M.Psi') }}</h4>
                    <p class="text-sm text-blue-600 font-semibold uppercase tracking-wider mb-2 text-left">{{ \App\Models\WebConfig::get('team_2_title', 'Clinical Director') }}</p>
                    <p class="text-xs text-slate-400 text-left">{{ \App\Models\WebConfig::get('team_2_description', 'Menjamin standar kualitas layanan psikologi kami.') }}</p>
                </div>

                {{-- MEMBER 3: CTO (Key: team_3) --}}
                <div class="group text-left">
                    <div class="relative overflow-hidden rounded-[32px] mb-6 bg-slate-200 aspect-[3/4] shadow-md">
                        <img src="{{ \App\Models\WebConfig::get('team_3_image') ? asset('storage/' . \App\Models\WebConfig::get('team_3_image')) : 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&q=80&w=400' }}" 
                             alt="{{ \App\Models\WebConfig::get('team_3_name', 'Budi Setiawan') }}" 
                             class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-105 text-left">
                    </div>
                    <h4 class="text-xl font-bold mb-1 text-slate-900">{{ \App\Models\WebConfig::get('team_3_name', 'Budi Setiawan') }}</h4>
                    <p class="text-sm text-rose-500 font-semibold uppercase tracking-wider mb-2 text-left">{{ \App\Models\WebConfig::get('team_3_title', 'CTO') }}</p>
                    <p class="text-xs text-slate-400 text-left">{{ \App\Models\WebConfig::get('team_3_description', 'Pengembang platform aman dan nyaman bagi user.') }}</p>
                </div>

                {{-- MEMBER 4: HEAD OF COMMUNITY (Key: team_4) --}}
                <div class="group text-left">
                    <div class="relative overflow-hidden rounded-[32px] mb-6 bg-slate-200 aspect-[3/4] shadow-md">
                        <img src="{{ \App\Models\WebConfig::get('team_4_image') ? asset('storage/' . \App\Models\WebConfig::get('team_4_image')) : 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&q=80&w=400' }}" 
                             alt="{{ \App\Models\WebConfig::get('team_4_name', 'Maya Putri') }}" 
                             class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-105 text-left">
                    </div>
                    <h4 class="text-xl font-bold mb-1 text-slate-900">{{ \App\Models\WebConfig::get('team_4_name', 'Maya Putri') }}</h4>
                    <p class="text-sm text-blue-600 font-semibold uppercase tracking-wider mb-2 text-left">{{ \App\Models\WebConfig::get('team_4_title', 'Head of Community') }}</p>
                    <p class="text-xs text-slate-400 text-left">{{ \App\Models\WebConfig::get('team_4_description', 'Menjaga hubungan erat dengan komunitas Tenang-in.') }}</p>
                </div>
            </div>
        </div>
    </section>

    @include('landing_page.footer')
    @include('landing_page.script')
</x-guest-layout>