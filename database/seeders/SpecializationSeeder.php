<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Specialization::create([
            'name' => 'Kecemasan',
            'code' => 'SP-ANX'
        ]);

        \App\Models\Specialization::create([
            'name' => 'Trauma',
            'code' => 'SP-TRM'
        ]);
    }
}
