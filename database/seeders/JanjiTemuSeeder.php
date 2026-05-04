<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Psychologist;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class JanjiTemuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat data Pasien simulasi
        $pasien1 = User::updateOrCreate(
            ['email' => 'pasien1@gmail.com'],
            [
                'name' => 'Budi Santoso',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );

        $pasien2 = User::updateOrCreate(
            ['email' => 'pasien2@gmail.com'],
            [
                'name' => 'Siti Aminah',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );

        // 2. Ambil spesifik Psikolog ID 5 (Akun Muhamad Parhan Abdillah / Dr. Ikhsan)
        // Ini memastikan data muncul di dashboard yang sedang kamu buka
        $psikolog = Psychologist::find(5);

        if ($psikolog) {
            // Hapus data lama agar tidak duplikat saat seeding ulang
            Appointment::where('id_psikolog', $psikolog->id)->delete();

            // 3. Buat data janji temu simulasi
            Appointment::create([
                'id_pasien' => $pasien1->id,
                'id_psikolog' => $psikolog->id,
                'tanggal_janji' => now()->format('Y-m-d'),
                'jam_janji' => '09:00:00',
                'status' => 'dikonfirmasi',
                'catatan_keluhan' => 'Sering merasa cemas saat berada di keramaian.',
            ]);

            Appointment::create([
                'id_pasien' => $pasien2->id,
                'id_psikolog' => $psikolog->id,
                'tanggal_janji' => now()->addDays(1)->format('Y-m-d'),
                'jam_janji' => '13:30:00',
                'status' => 'menunggu',
                'catatan_keluhan' => 'Tekanan pekerjaan yang berat.',
            ]);
        }
    }
}
