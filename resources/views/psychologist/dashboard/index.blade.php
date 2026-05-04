@extends('layouts.app')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 border-b border-gray-100">
                    <h3 class="text-xl font-bold text-gray-800">Selamat Datang, {{ auth()->user()->name }}!</h3>
                    <p class="mt-2 text-gray-500 font-medium">Ini adalah halaman dashboard khusus untuk menangani sesi konsultasi Anda.</p>
                </div>
            </div>

            <!-- Bagian Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-6 rounded-2xl shadow text-white relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 opacity-20">
                        <i class="fa-solid fa-users text-6xl"></i>
                    </div>
                    <p class="text-sm opacity-90 font-semibold mb-1">Total Pasien</p>
                    <p class="text-4xl font-extrabold">12</p>
                </div>
                <div class="bg-gradient-to-br from-green-500 to-emerald-600 p-6 rounded-2xl shadow text-white relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 opacity-20">
                        <i class="fa-solid fa-calendar-check text-6xl"></i>
                    </div>
                    <p class="text-sm opacity-90 font-semibold mb-1">Sesi Hari Ini</p>
                    <p class="text-4xl font-extrabold">4</p>
                </div>
                <div class="bg-gradient-to-br from-purple-500 to-indigo-600 p-6 rounded-2xl shadow text-white relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 opacity-20">
                        <i class="fa-solid fa-star text-6xl"></i>
                    </div>
                    <p class="text-sm opacity-90 font-semibold mb-1">Rating Rata-rata</p>
                    <p class="text-4xl font-extrabold">4.9/5</p>
                </div>
            </div>
        </div>
    </div>
@endsection