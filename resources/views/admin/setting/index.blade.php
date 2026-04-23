@extends('layouts.app')

@section('content')
    <div class="p-8">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-slate-800">Pengaturan AI Recommendation</h1>
            <p class="text-slate-500 text-sm">Konfigurasi kunci API dan instruksi kecerdasan buatan untuk rekomendasi
                psikolog.</p>
        </div>

        @if (session('success'))
            <div
                class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-2xl text-sm font-medium flex items-center gap-3">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="max-w-3xl">
            <form action="{{ route('admin.ai.update') }}" method="POST"
                class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 space-y-6">
                @csrf

                <div class="space-y-2">
                    <label for="api_key_input" class="text-slate-600 font-semibold text-sm block">GEMINI / OPENAI API
                        KEY</label>
                    <div class="relative group">
                        <input type="password" id="api_key_input" name="ai_api_key"
                            value="{{ old('ai_api_key', $settings['ai_api_key'] ?? '') }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-indigo-500 pr-12"
                            placeholder="Masukkan API Key Anda..." autocomplete="off">
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-indigo-600 transition-colors">
                            <i id="eye_icon" class="fa-solid fa-eye text-lg"></i>
                        </button>
                    </div>
                    <p class="text-[11px] text-slate-400">Pastikan API Key diawali dengan 'AIzaSy' untuk Google Gemini.</p>
                </div>

                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest">
                        AI System Instruction (Prompt)
                    </label>
                    <textarea name="ai_system_prompt" rows="8"
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium text-slate-700 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none shadow-inner transition-all"
                        placeholder="Contoh: Anda adalah asisten psikologi untuk Tenang.in...">{{ old('ai_system_prompt', $settings['ai_system_prompt'] ?? '') }}</textarea>
                    <div class="flex justify-between items-center">
                        <p class="text-[11px] text-slate-400 italic font-medium">*Instruksi ini sangat menentukan akurasi
                            jawaban AI.</p>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold text-sm shadow-xl shadow-indigo-100 transition-all transform active:scale-[0.98] flex items-center justify-center gap-3">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function togglePassword() {
            const input = document.getElementById('api_key_input');
            const icon = document.getElementById('eye_icon');

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endpush
