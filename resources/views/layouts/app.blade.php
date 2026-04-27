<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenang.in</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8f9fa; }
        .sidebar-active { background-color: #fef2f2; color: #b91c1c; border-right: 4px solid #b91c1c; }
    </style>
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Extra Style -->
    @stack('styles')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="flex min-h-screen bg-[#F8F9FA] text-gray-800">

    @include('layouts.navigation')

    <div class="flex-1 flex flex-col min-w-0 min-h-screen ">
    
        @include('layouts.header')

        <main class="  flex-1 overflow-y-auto p-6 lg:p-8">
            <div class="max-w-[1600px] mx-auto">
                @yield('content')
            </div>
        </main>

    </div>

</body>
</html>