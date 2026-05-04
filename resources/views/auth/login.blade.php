<x-guest-layout>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center p-4 lg:p-8">
        <div class="max-w-6xl w-full bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col lg:flex-row">
            
            <!-- SISI KIRI: Form Login -->
            <div class="w-full lg:w-1/2 p-8 lg:p-16 flex flex-col justify-between">
                <div>
                    <!-- Logo Tenang.in -->
                    <div class="flex items-center gap-3 mb-10">
                        <div class="w-10 h-10 bg-rose-600 rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-rose-200">T</div>
                        <span class="text-2xl font-bold tracking-tight text-gray-800">Tenang.in</span>
                    </div>

                    <!-- Header Text -->
                    <div class="mb-10">
                        <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Welcome Back</h1>
                        <p class="text-gray-500 text-sm">Enter your email and password to access your account.</p>
                    </div>

                    <!-- Session Status (Pesan Error/Sukses) -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Form Autentikasi -->
                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" class="font-semibold text-gray-700" />
                            <x-text-input id="email" 
                                class="block mt-1 w-full px-4 py-3 rounded-xl border-gray-200 focus:border-rose-500 focus:ring-rose-500 transition-all shadow-sm {{ $errors->has('email') ? 'border-rose-500 ring-rose-500' : '' }}" 
                                type="email" 
                                name="email" 
                                :value="old('email')" 
                                required autofocus 
                                autocomplete="username" 
                                placeholder="nama@email.com" />
                            @if(!$errors->any())
                                <p class="text-xs text-gray-400 mt-1">Gunakan email yang terdaftar</p>
                            @endif
                        </div>

                        <!-- Password -->
                        <div>
                            <div class="flex items-center justify-between">
                                <x-input-label for="password" :value="__('Password')" class="font-semibold text-gray-700" />
                                @if (Route::has('password.request'))
                                    <a class="text-xs font-bold text-rose-600 hover:underline" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                            <div class="relative">
                                <x-text-input id="password" 
                                    class="block mt-1 w-full px-4 py-3 rounded-xl border-gray-200 focus:border-rose-500 focus:ring-rose-500 transition-all shadow-sm {{ $errors->has('password') ? 'border-rose-500 ring-rose-500' : '' }}"
                                    type="password"
                                    name="password"
                                    required 
                                    autocomplete="current-password" 
                                    placeholder="••••••••" />
                                <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                    <i class="fa-solid fa-eye" id="togglePasswordIcon"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center">
                            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-rose-600 shadow-sm focus:ring-rose-500" name="remember">
                                <span class="ms-2 text-sm text-gray-600 font-medium">{{ __('Remember Me') }}</span>
                            </label>
                        </div>

                        <!-- Login Button -->
                        <div class="pt-2">
                            <button type="submit" class="w-full bg-rose-600 hover:bg-rose-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-rose-200 transition-all transform active:scale-95 flex justify-center items-center">
                                <i class="fa-solid fa-right-to-bracket mr-2"></i> {{ __('Log In') }}
                            </button>
                        </div>
                    </form>

                    <!-- Divider -->
                    <div class="relative my-8 text-center">
                        <hr class="border-gray-100">
                        <span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-white px-4 text-[10px] text-gray-400 font-bold uppercase tracking-widest">Or Login With</span>
                    </div>

                    <!-- Social Login Buttons -->
                    <div class="grid grid-cols-2 gap-4">
                        <button type="button" class="flex items-center justify-center gap-2 py-3 border border-gray-200 rounded-xl hover:bg-gray-50 transition-all font-bold text-gray-700 text-sm">
                            <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5" alt="Google"> Google
                        </button>
                        <button type="button" class="flex items-center justify-center gap-2 py-3 border border-gray-200 rounded-xl hover:bg-gray-50 transition-all font-bold text-gray-700 text-sm">
                            <i class="fa-brands fa-apple text-lg"></i> Apple
                        </button>
                    </div>

                    <p class="text-center mt-10 text-sm text-gray-500 font-medium">
                        Don't Have An Account? <a href="{{ route('register') }}" class="text-rose-600 font-bold hover:underline">Register Now.</a>
                    </p>
                </div>

                <!-- Footer Copyright -->
                <div class="flex justify-between items-center text-[10px] text-gray-400 mt-12 font-bold uppercase tracking-wider">
                    <p>Copyright © 2026 Tenang.in Ltd.</p>
                    <a href="#" class="hover:text-gray-600 transition-colors">Privacy Policy</a>
                </div>
            </div>

            <!-- SISI KANAN: Branding & Image -->
            <div class="hidden lg:block lg:w-1/2 relative bg-gray-900">
                <!-- Gambar Psikolog (Gambar Kedua) -->
                <img src="{{ asset('img/dreamina-psikolog.jpg') }}" 
                     class="absolute inset-0 w-full h-full object-cover opacity-60 mix-blend-luminosity" 
                     alt="Psychologist">
                
                <!-- Overlay Gradient -->
                <div class="absolute inset-0 bg-gradient-to-br from-rose-600/40 to-gray-900/80"></div>
                
                <!-- Konten Overlay -->
                <div class="relative h-full flex flex-col justify-center px-20 text-white z-10">
                    <div class="w-16 h-1 bg-white mb-8 rounded-full"></div>
                    <h2 class="text-4xl font-extrabold leading-tight mb-6">
                        Sembuhkan diri dan kelola kesehatan mentalmu bersama kami.
                    </h2>
                    <p class="text-rose-100 text-lg font-medium mb-10 opacity-90">
                        Masuk untuk terhubung dengan terapis profesional dan mulai perjalanan ketenanganmu.
                    </p>
                    
                    <!-- Info Card -->
                    <div class="bg-white/10 backdrop-blur-xl rounded-2xl p-6 border border-white/20 inline-block self-start">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fa-solid fa-quote-left text-white text-xl"></i>
                            </div>
                            <p class="text-sm font-semibold text-rose-50 italic">
                                "Ketenangan dimulai dari langkah pertama untuk bercerita."
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Script untuk Toggle Password & SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const icon = document.getElementById('togglePasswordIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Tampilkan SweetAlert jika ada error validasi
        @if($errors->any())
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal',
                    text: '{!! str_replace("'", "\'", $errors->first()) !!}',
                    confirmButtonColor: '#e11d48',
                    confirmButtonText: 'Coba Lagi',
                    customClass: {
                        popup: 'rounded-2xl',
                        confirmButton: 'rounded-xl font-bold py-3 px-6'
                    }
                });
            });
        @endif
        
        // Tampilkan SweetAlert jika ada session status (misal reset password berhasil)
        @if(session('status'))
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('status') }}',
                    confirmButtonColor: '#10b981',
                    confirmButtonText: 'OK',
                    customClass: {
                        popup: 'rounded-2xl',
                        confirmButton: 'rounded-xl font-bold py-3 px-6'
                    }
                });
            });
        @endif
    </script>
</x-guest-layout>