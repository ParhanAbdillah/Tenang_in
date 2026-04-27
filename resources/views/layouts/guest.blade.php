<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tenang-in | Layanan Kesehatan Mental</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans antialiased bg-white text-gray-900">
    {{-- Hapus semua div wrapper yang memiliki class 'items-center' atau 'max-w-md' --}}
    <div class="min-h-screen">
        {{ $slot }}
    </div>
    @stack('scripts')
</body>
</html>