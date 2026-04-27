<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TestQuestion extends Model
{
    protected $fillable = ['test_category_id', 'question_text', 'order'];

    // Relasi: Pertanyaan ini milik sebuah kategori
    public function category()
    {
        return $this->belongsTo(TestCategory::class, 'test_category_id');
    }

    public function testOptions(): HasMany
    {
        // Pastikan foreign key di tabel test_options adalah 'test_question_id'
        return $this->hasMany(TestOption::class, 'test_question_id');
    }
}
