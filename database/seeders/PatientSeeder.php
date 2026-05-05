<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat Akun Pasien / User Biasa
        User::updateOrCreate(
            ['email' => 'pasien@tenang.in'],
            [
                'name' => 'Pasien Tenang',
                'password' => Hash::make('password'),
                'role' => 'user', // Asumsi role untuk pasien adalah 'user'
            ]
        );
        
        User::updateOrCreate(
            ['email' => 'helmi@gmail.com'],
            [
                'name' => 'Helmi D.',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );
        
        User::updateOrCreate(
            ['email' => 'yuli@gmail.com'],
            [
                'name' => 'Yuli S.',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );
    }
}
