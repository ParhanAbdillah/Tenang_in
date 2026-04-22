<?php

namespace Database\Seeders;

use App\Models\Psychologist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PsychologistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        Psychologist::create([
            'name' => 'Dr. Amanda S.Psi',
            'email' => 'amanda@tenang.in',
            'phone' => '08123456789',
            'specialization' => 'Kecemasan',
            'license_number' => 'STR-2024-0981',
            'experience_years' => 5,
            'status' => 'active',
            'price_per_session' => 150000
        ]);

        Psychologist::create([
            'name' => 'Raka Abimanyu M.Psi',
            'email' => 'raka@tenang.in',
            'phone' => '08987654321',
            'specialization' => 'Trauma',
            'license_number' => 'STR-2024-0772',
            'experience_years' => 3,
            'status' => 'pending',
            'price_per_session' => 200000
        ]);
    }
}
