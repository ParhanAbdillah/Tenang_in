<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Assistant - Tenang.in</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-slate-50 font-sans h-screen flex flex-col">

    <header class="bg-white border-b border-slate-100 px-6 py-4 flex items-center justify-between shadow-sm">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white shadow-lg">
                <i class="fa-solid fa-robot"></i>
            </div>
            <div>
                <h1 class="font-bold text-slate-800 leading-tight">AI Assistant</h1>
                <div class="flex items-center gap-1.5">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                    <p class="text-[11px] text-slate-400 font-medium uppercase tracking-wider">Online | Tenang.in</p>
                </div>
            </div>
        </div>
        <a href="/" class="text-slate-400 hover:text-slate-600 transition-colors">
            <i class="fa-solid fa-xmark text-xl"></i>
        </a>
    </header>

    <main class="flex-1 overflow-y-auto p-6 space-y-6" id="chat-container">
        <div class="flex gap-4 max-w-[85%]">
            <div
                class="w-8 h-8 rounded-full bg-slate-200 flex-shrink-0 flex items-center justify-center text-slate-500 text-xs">
                <i class="fa-solid fa-robot"></i>
            </div>
            <div class="bg-white p-4 rounded-2xl rounded-tl-none shadow-sm border border-slate-100">
                <p class="text-sm text-slate-600 leading-relaxed">Halo! Saya asisten AI Tenang.in. Ceritakan apa yang
                    sedang kamu rasakan hari ini, saya akan mendengarkan dan mencoba merekomendasikan psikolog yang
                    paling tepat untukmu. 😊</p>
            </div>
        </div>

        <div class="flex gap-4 max-w-[85%] ml-auto flex-row-reverse">
            <div
                class="w-8 h-8 rounded-full bg-indigo-100 flex-shrink-0 flex items-center justify-center text-indigo-600 text-xs font-bold">
                U
            </div>
            <div class="bg-indigo-600 p-4 rounded-2xl rounded-tr-none shadow-md shadow-indigo-100">
                <p class="text-sm text-white leading-relaxed">Saya merasa sangat cemas belakangan ini karena tekanan
                    pekerjaan.</p>
            </div>
        </div>
    </main>

    <footer class="bg-white p-6 border-t border-slate-100">
        <form id="chat-form"
            class="max-w-4xl mx-auto flex gap-4 items-center bg-slate-50 p-2 rounded-2xl border border-slate-200">
            <input type="text" id="chat-input" placeholder="Ceritakan masalahmu di sini..."
                class="flex-1 bg-transparent border-none focus:ring-0 px-4 py-2 text-sm text-slate-600 font-medium"
                required>

            <button type="submit" id="btn-send"
                class="bg-indigo-600 text-white w-10 h-10 rounded-xl flex items-center justify-center hover:bg-indigo-700 transition-all">
                <i class="fa-solid fa-paper-plane text-sm"></i>
            </button>
        </form>
    </footer>

</body>

</html>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatForm = document.getElementById('chat-form');
        const chatInput = document.getElementById('chat-input');
        const chatContainer = document.getElementById('chat-container');

        console.log("Chat System: Ready");

        chatForm.addEventListener('submit', function(e) {
            e.preventDefault();
            console.log("Tombol ditekan!");

            const message = chatInput.value.trim();
            if (!message) return;

            // 1. Tampilkan Chat User
            const userBubble = `
                <div class="flex gap-4 max-w-[85%] ml-auto flex-row-reverse mb-4">
                    <div class="w-8 h-8 rounded-full bg-indigo-100 flex-shrink-0 flex items-center justify-center text-indigo-600 text-xs font-bold">U</div>
                    <div class="bg-indigo-600 p-4 rounded-2xl rounded-tr-none shadow-md shadow-indigo-100 text-white text-sm">
                        ${message}
                    </div>
                </div>`;
            chatContainer.insertAdjacentHTML('beforeend', userBubble);
            chatInput.value = '';
            chatContainer.scrollTop = chatContainer.scrollHeight;

            // 2. Tampilkan Loading
            const loadingId = 'loading-' + Date.now();
            chatContainer.insertAdjacentHTML('beforeend', `<div id="${loadingId}" class="text-xs italic text-slate-400 mb-4">Menghubungkan ke server...</div>`);

            // 3. Kirim ke Server
            console.log("Mengirim request ke Laravel...");
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
                document.getElementById(loadingId).remove();
                const aiBubble = `
                    <div class="flex gap-4 max-w-[85%] mb-4 text-sm text-slate-600 leading-relaxed bg-white p-4 rounded-2xl border border-slate-100">
                        ${data.reply}
                    </div>`;
                chatContainer.insertAdjacentHTML('beforeend', aiBubble);
                chatContainer.scrollTop = chatContainer.scrollHeight;
            })
            .catch(error => {
                console.error("Error Detail:", error);
                document.getElementById(loadingId).innerHTML = `<span class="text-red-500 underline">Gagal: ${error.message}</span>`;
            });
        });
    });
</script>
