<x-guest-layout>
    @include('landing_page.navbar')

    <div class="pt-28 pb-6 bg-slate-50 h-screen font-sans flex flex-col overflow-hidden">
        <div class="max-w-6xl mx-auto w-full px-4 sm:px-6 lg:px-8 flex-1 flex flex-col min-h-0">
            
            <!-- Chat Card Container -->
            <div class="bg-white rounded-[2.5rem] shadow-2xl border border-slate-100 flex flex-col flex-1 min-h-0 mb-4 overflow-hidden">
                
                <!-- Chat Header -->
                <div class="bg-white/80 backdrop-blur-md border-b border-slate-100 px-8 py-5 flex items-center justify-between z-10">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-[#0A4D68] rounded-2xl flex items-center justify-center shadow-lg shadow-blue-900/20">
                            <span class="text-white font-extrabold italic text-2xl">T</span>
                        </div>
                        <div>
                            <h1 class="font-extrabold text-slate-800 text-lg leading-tight">AI Teman Cerita</h1>
                            <div class="flex items-center gap-1.5">
                                <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                                <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">Beroperasi Secara Terenkripsi</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="hidden sm:flex items-center gap-2 bg-slate-50 px-4 py-2 rounded-xl border border-slate-100">
                            <i class="fa-solid fa-shield-halved text-emerald-500 text-xs"></i>
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Privasi Aman</span>
                        </div>
                    </div>
                </div>

                <!-- Chat Body (Hanya area ini yang scroll) -->
                <main class="flex-1 overflow-y-auto p-6 md:p-10 space-y-8 custom-scrollbar bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:20px_20px]" id="chat-container">
                    <!-- Bot Message -->
                    <div class="flex gap-4 max-w-[85%] animate-fade-in">
                        <div class="w-10 h-10 rounded-2xl bg-[#0A4D68] flex-shrink-0 flex items-center justify-center shadow-sm">
                            <span class="text-white font-bold italic text-sm">T</span>
                        </div>
                        <div class="bg-white p-6 rounded-3xl rounded-tl-none border border-slate-100 shadow-sm">
                            <p class="text-[15px] text-slate-700 leading-relaxed font-medium">
                                Halo! Saya **AI Teman Cerita** dari Tenang.in. 👋 <br><br>
                                Apa yang sedang membebani pikiranmu saat ini? Ceritakan saja semuanya, saya di sini untuk mendengarkan tanpa menghakimi.
                            </p>
                        </div>
                    </div>
                </main>

                <!-- Chat Input Area (Fixed di bawah card) -->
                <footer class="bg-white p-6 border-t border-slate-100">
                    <form id="chat-form" class="max-w-4xl mx-auto relative">
                        <div class="relative flex items-center p-1 bg-slate-50 rounded-[2rem] border border-slate-200 focus-within:border-[#0A4D68]/30 focus-within:ring-4 focus-within:ring-[#0A4D68]/5 transition-all duration-300">
                            <input type="text" id="chat-input" placeholder="Ceritakan perasaanmu di sini..."
                                class="flex-1 bg-transparent border-none focus:ring-0 px-6 py-4 text-[15px] text-slate-700 font-medium placeholder:text-slate-400"
                                required autocomplete="off">

                            <button type="submit" id="btn-send"
                                class="bg-[#0A4D68] text-white h-12 px-6 rounded-[1.5rem] flex items-center justify-center gap-2 hover:bg-[#07364a] hover:shadow-lg hover:shadow-blue-900/20 transition-all active:scale-95 group">
                                <span class="hidden sm:inline text-sm font-bold">Kirim</span>
                                <i class="fa-solid fa-paper-plane text-xs group-hover:translate-x-1 group-hover:-translate-y-0.5 transition-transform"></i>
                            </button>
                        </div>
                        <p class="text-center text-[9px] text-slate-400 font-bold mt-4 uppercase tracking-[0.2em] opacity-60">Pesan anda tidak akan dibagikan kepada siapapun tanpa izin anda</p>
                    </form>
                </footer>
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 20px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #cbd5e1;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.4s ease-out forwards;
        }

        /* Hilangkan focus ring default browser yang kaku */
        input:focus {
            outline: none !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatForm = document.getElementById('chat-form');
            const chatInput = document.getElementById('chat-input');
            const chatContainer = document.getElementById('chat-container');

            function scrollToBottom() {
                chatContainer.scrollTo({
                    top: chatContainer.scrollHeight,
                    behavior: 'smooth'
                });
            }

            chatForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const message = chatInput.value.trim();
                if (!message) return;

                // 1. Tampilkan Chat User
                const userBubble = `
                    <div class="flex gap-4 max-w-[85%] ml-auto flex-row-reverse mb-8 animate-fade-in">
                        <div class="w-10 h-10 rounded-2xl bg-[#D98324] flex-shrink-0 flex items-center justify-center text-white shadow-lg shadow-orange-900/20 font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="bg-[#0A4D68] p-5 rounded-3xl rounded-tr-none shadow-xl shadow-blue-900/10 text-white">
                            <p class="text-[15px] font-medium leading-relaxed">${message}</p>
                        </div>
                    </div>`;
                chatContainer.insertAdjacentHTML('beforeend', userBubble);
                chatInput.value = '';
                scrollToBottom();

                // 2. Tampilkan Animasi Sedang Mengetik
                const loadingId = 'loading-' + Date.now();
                const typingBubble = `
                    <div id="${loadingId}" class="flex gap-4 max-w-[85%] mb-8 items-start animate-fade-in">
                        <div class="w-10 h-10 rounded-2xl bg-[#0A4D68] flex-shrink-0 flex items-center justify-center shadow-sm">
                            <span class="text-white font-bold italic text-sm">T</span>
                        </div>
                        <div class="bg-white p-5 rounded-3xl rounded-tl-none shadow-sm border border-slate-100 flex gap-3 items-center">
                            <div class="flex gap-1">
                                <span class="w-1.5 h-1.5 bg-[#0A4D68] rounded-full animate-bounce"></span>
                                <span class="w-1.5 h-1.5 bg-[#0A4D68] rounded-full animate-bounce [animation-delay:-0.15s]"></span>
                                <span class="w-1.5 h-1.5 bg-[#0A4D68] rounded-full animate-bounce [animation-delay:-0.3s]"></span>
                            </div>
                            <span class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">AI sedang merespon...</span>
                        </div>
                    </div>`;
                
                chatContainer.insertAdjacentHTML('beforeend', typingBubble);
                scrollToBottom();

                // 3. Kirim ke Server
                fetch("{{ route('chat.send') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ message: message })
                })
                .then(response => {
                    if (!response.ok) throw new Error('Server bermasalah');
                    return response.json();
                })
                .then(data => {
                    const loadingElement = document.getElementById(loadingId);
                    if (loadingElement) loadingElement.remove();

                    const aiBubble = `
                        <div class="flex gap-4 max-w-[85%] mb-8 items-start animate-fade-in">
                            <div class="w-10 h-10 rounded-2xl bg-[#0A4D68] flex-shrink-0 flex items-center justify-center shadow-sm">
                                <span class="text-white font-bold italic text-sm">T</span>
                            </div>
                            <div class="bg-white p-6 rounded-3xl rounded-tl-none border border-slate-100 shadow-sm">
                                <p class="text-[15px] text-slate-700 leading-relaxed font-medium">${data.reply}</p>
                            </div>
                        </div>`;
                    
                    chatContainer.insertAdjacentHTML('beforeend', aiBubble);
                    scrollToBottom();
                })
                .catch(error => {
                    const loadingElement = document.getElementById(loadingId);
                    if (loadingElement) {
                        loadingElement.innerHTML = `<div class="ml-14 bg-red-50 text-red-600 text-xs px-4 py-2 rounded-xl border border-red-100 font-bold">Maaf, ada gangguan teknis. Coba lagi nanti.</div>`;
                    }
                });
            });
        });
    </script>
</x-guest-layout>
