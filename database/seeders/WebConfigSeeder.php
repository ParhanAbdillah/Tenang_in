<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $settings = [
            ['key' => 'hero_title', 'value' => 'Ruang Aman untuk Pulihkan Dirimu'],
            ['key' => 'price_basic_min', 'value' => '20000'],
            ['key' => 'price_basic_max', 'value' => '50000'],
            ['key' => 'price_essential_min', 'value' => '60000'],
            ['key' => 'price_essential_max', 'value' => '150000'],
            ['key' => 'price_premium_min', 'value' => '200000'],
            ['key' => 'price_premium_max', 'value' => '500000'],
            ['key' => 'price_basic', 'value' => '199000'],
            ['key' => 'price_essential', 'value' => '299000'],
            ['key' => 'price_premium', 'value' => '399000'],
        ];

        foreach ($settings as $setting) {
            \App\Models\WebConfig::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
