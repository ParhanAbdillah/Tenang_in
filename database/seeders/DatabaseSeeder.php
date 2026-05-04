<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Psychologist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Admin (Jika belum ada)
        User::updateOrCreate(
            ['email' => 'admin@tenang.in'],
            [
                'name' => 'Admin Tenang',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // 2. Cari data Psikolog yang sudah ada di database (Misal berdasarkan Lisensi/STR)
        // Kita ambil contoh Dr. Ikhsan Hidayat yang ada di gambar kamu
        $existingPsychologist = Psychologist::where('license_number', 'STR-2000-7000')->first();

        if ($existingPsychologist) {
            // 3. Buat Akun User untuk Psikolog tersebut
            $user = User::updateOrCreate(
                ['email' => 'ikhsan@gmail.com'],
                [
                    'name' => 'Dr. Ikhsan Hidayat',
                    'password' => Hash::make('password'),
                    'role' => 'psychologist',
                ]
            );

            // 4. Update data Psikolog agar terhubung ke User ID yang baru dibuat
            $existingPsychologist->update([
                'user_id' => $user->id
            ]);
        }
    }
}