@extends('layouts.app')
@section('content')
<div class="p-8 space-y-8">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold">Dashboard Overview</h2>
                <div class="bg-white border border-gray-200 rounded-lg px-4 py-2 text-sm font-semibold flex items-center gap-2 shadow-sm cursor-pointer hover:bg-gray-50">
                    <i class="fa-solid fa-calendar text-rose-500"></i> Bulan Ini
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div class="flex justify-between items-start">
                        <p class="text-sm font-semibold text-gray-500 italic">Total Pasien</p>
                        <i class="fa-solid fa-ellipsis-vertical text-gray-300"></i>
                    </div>
                    <div class="mt-4">
                        <p class="text-3xl font-bold">1,248</p>
                        <p class="text-[11px] text-gray-400 mt-1 uppercase font-bold tracking-wider">Jumlah pasien aktif</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between border-t-4 border-t-rose-500">
                    <div class="flex justify-between items-start text-rose-600">
                        <p class="text-sm font-semibold italic">Verifikasi Psikolog</p>
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </div>
                    <div class="mt-4">
                        <p class="text-3xl font-bold">23</p>
                        <p class="text-[11px] text-gray-400 mt-1 uppercase font-bold tracking-wider">Menunggu persetujuan</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div class="flex justify-between items-start">
                        <p class="text-sm font-semibold text-gray-500 italic">Psikolog Aktif</p>
                        <i class="fa-solid fa-ellipsis-vertical text-gray-300"></i>
                    </div>
                    <div class="mt-4">
                        <p class="text-3xl font-bold">58</p>
                        <p class="text-[11px] text-gray-400 mt-1 uppercase font-bold tracking-wider">Terapis terdaftar</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div class="flex justify-between items-start">
                        <p class="text-sm font-semibold text-gray-500 italic">Pendapatan Platform</p>
                        <i class="fa-solid fa-ellipsis-vertical text-gray-300"></i>
                    </div>
                    <div class="mt-4">
                        <p class="text-3xl font-bold">Rp 45,2jt</p>
                        <p class="text-[11px] text-gray-400 mt-1 uppercase font-bold tracking-wider">Total komisi bulan ini</p>
                    </div>
                </div>
            </div>

            <!-- Middle Charts/Stats Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- AI Engine Performance -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-bold text-gray-800">Akurasi Respon AI Chat</h3>
                        <i class="fa-solid fa-chevron-right text-rose-500 text-xs"></i>
                    </div>
                    <div class="space-y-5">
                        <div>
                            <div class="flex justify-between text-xs font-bold mb-1.5">
                                <span>Sentiment Analysis</span>
                                <span class="text-indigo-600">98%</span>
                            </div>
                            <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                                <div class="bg-indigo-600 h-full rounded-full" style="width: 98%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-xs font-bold mb-1.5">
                                <span>Empathy Matching</span>
                                <span class="text-indigo-600">86%</span>
                            </div>
                            <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                                <div class="bg-indigo-600 h-full rounded-full" style="width: 86%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-xs font-bold mb-1.5">
                                <span>Response Speed</span>
                                <span class="text-indigo-600">90%</span>
                            </div>
                            <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                                <div class="bg-indigo-600 h-full rounded-full" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Critical Cases -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-800 mb-6">Deteksi Kasus Kritis (AI Monitoring)</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-[11px] uppercase text-gray-400 font-bold border-b border-gray-100">
                                <tr>
                                    <th class="pb-3">Nickname</th>
                                    <th class="pb-3 text-center">Mood Score</th>
                                    <th class="pb-3">Lansiran</th>
                                    <th class="pb-3">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                <tr>
                                    <td class="py-3 font-semibold">User_921</td>
                                    <td class="py-3 text-center">15</td>
                                    <td class="py-3 font-medium text-gray-500">Tingkat Depresi Berat</td>
                                    <td class="py-3"><span class="px-2 py-1 bg-rose-50 text-rose-600 text-[10px] font-bold rounded uppercase">Urgent</span></td>
                                </tr>
                                <tr>
                                    <td class="py-3 font-semibold">Cahaya_Pagi</td>
                                    <td class="py-3 text-center">22</td>
                                    <td class="py-3 font-medium text-gray-500">Kecemasan Akut</td>
                                    <td class="py-3"><span class="px-2 py-1 bg-orange-50 text-orange-600 text-[10px] font-bold rounded uppercase">Follow up</span></td>
                                </tr>
                                <tr>
                                    <td class="py-3 font-semibold">Mencari_Jalan</td>
                                    <td class="py-3 text-center">10</td>
                                    <td class="py-3 font-medium text-gray-500">Krisis Identitas</td>
                                    <td class="py-3"><span class="px-2 py-1 bg-red-50 text-red-600 text-[10px] font-bold rounded uppercase">Critical</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Bottom Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Konsultasi Chart -->
                <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-bold text-gray-800">Statistik Konsultasi</h3>
                        <div class="text-[11px] font-bold space-x-4 uppercase">
                            <span class="text-indigo-500"><i class="fa-solid fa-circle mr-1"></i> Sesi Berhasil</span>
                            <span class="text-rose-400"><i class="fa-solid fa-circle mr-1"></i> Pembatalan</span>
                        </div>
                    </div>
                    <canvas id="consultationChart" height="150"></canvas>
                </div>

                <!-- Top Categories -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-bold text-gray-800">Topik Konsultasi Terbanyak</h3>
                        <i class="fa-solid fa-chevron-right text-rose-500 text-xs"></i>
                    </div>
                    <div class="relative h-[200px] flex items-center justify-center">
                        <canvas id="topicChart"></canvas>
                    </div>
                    <div class="mt-6 grid grid-cols-2 gap-y-2 text-[11px] font-bold text-gray-500">
                        <div class="flex items-center gap-2"><div class="w-2 h-2 rounded-full bg-indigo-600"></div> Hubungan Asmara</div>
                        <div class="flex items-center gap-2"><div class="w-2 h-2 rounded-full bg-blue-400"></div> Karir & Pekerjaan</div>
                        <div class="flex items-center gap-2"><div class="w-2 h-2 rounded-full bg-orange-400"></div> Kecemasan Sosial</div>
                        <div class="flex items-center gap-2"><div class="w-2 h-2 rounded-full bg-rose-400"></div> Trauma Masa Lalu</div>
                    </div>
                </div>
            </div>

            <!-- Recent Transaction Table -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex items-center justify-between">
                    <h3 class="font-bold text-gray-800">Transaksi Terakhir</h3>
                    <div class="bg-white border border-gray-200 rounded-lg px-3 py-1.5 text-xs font-semibold flex items-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-clock-rotate-left"></i> Terkini <i class="fa-solid fa-chevron-down text-[10px]"></i>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50/50 text-[11px] uppercase text-gray-400 font-bold border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4">Pasien</th>
                                <th class="px-6 py-4">Psikolog</th>
                                <th class="px-6 py-4">Metode Bayar</th>
                                <th class="px-6 py-4">Total</th>
                                <th class="px-6 py-4">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 font-medium">
                            <tr class="hover:bg-gray-50/50 transition-all">
                                <td class="px-6 py-4 text-gray-500">Okt 21, 2025</td>
                                <td class="px-6 py-4">Sanjaya_Putra</td>
                                <td class="px-6 py-4">Dr. Amanda S.Psi</td>
                                <td class="px-6 py-4 text-gray-500 italic">QRIS / Dana</td>
                                <td class="px-6 py-4">Rp 150.000</td>
                                <td class="px-6 py-4"><span class="text-green-600 bg-green-50 px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wide">Success</span></td>
                            </tr>
                            <tr class="hover:bg-gray-50/50 transition-all">
                                <td class="px-6 py-4 text-gray-500">Okt 21, 2025</td>
                                <td class="px-6 py-4">Bunga_Lestari</td>
                                <td class="px-6 py-4">Raka Abimanyu M.Psi</td>
                                <td class="px-6 py-4 text-gray-500 italic">Virtual Account BCA</td>
                                <td class="px-6 py-4">Rp 200.000</td>
                                <td class="px-6 py-4"><span class="text-orange-600 bg-orange-50 px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wide">Pending</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('admin.dashboard.script')

@endsection