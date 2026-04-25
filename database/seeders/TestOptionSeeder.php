<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $questions = \App\Models\TestQuestion::all();
        $options = [
            ['text' => 'Tidak pernah', 'points' => 0],
            ['text' => 'Beberapa hari', 'points' => 1],
            ['text' => 'Lebih dari separuh waktu', 'points' => 2],
            ['text' => 'Hampir setiap hari', 'points' => 3],
        ];

        foreach ($questions as $q) {
            foreach ($options as $opt) {
                \App\Models\TestOption::create([
                    'test_question_id' => $q->id,
                    'option_text' => $opt['text'],
                    'points' => $opt['points']
                ]);
            }
        }
    }
}
