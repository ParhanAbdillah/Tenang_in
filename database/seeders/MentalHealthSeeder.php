<?php

namespace Database\Seeders;

use App\Models\TestCategory;
use App\Models\TestQuestion;
use App\Models\TestScoreIndicator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MentalHealthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat Kategori Tes dengan SLUG
        $categoryName = 'Tes Tingkat Cemas (GAD-7)';
        $category = TestCategory::create([
            'name' => $categoryName,
            'slug' => Str::slug($categoryName), // Menambahkan slug otomatis
            'description' => 'Generalized Anxiety Disorder-7 (GAD-7) adalah alat skrining untuk mengukur tingkat kecemasan.',
        ]);

        // ... Sisa kode pertanyaan dan indikator tetap sama seperti sebelumnya ...
        // ... (Pastikan bagian indikator skor juga ikut dijalankan) ...
        
        $indicators = [
            ['min' => 0, 'max' => 4, 'status' => 'Normal'],
            ['min' => 5, 'max' => 9, 'status' => 'Kecemasan Ringan'],
            ['min' => 10, 'max' => 14, 'status' => 'Kecemasan Sedang'],
            ['min' => 15, 'max' => 21, 'status' => 'Kecemasan Berat'],
        ];

        foreach ($indicators as $ind) {
            TestScoreIndicator::create([
                'test_category_id' => $category->id,
                'min_score' => $ind['min'],
                'max_score' => $ind['max'],
                'status' => $ind['status'],
            ]);
        }
    }
}
