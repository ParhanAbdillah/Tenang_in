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
            ['key' => 'price_basic', 'value' => '199000'],
            ['key' => 'price_essential', 'value' => '299000'],
            ['key' => 'price_premium', 'value' => '399000'],
        ];

        foreach ($settings as $setting) {
            \App\Models\WebConfig::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
