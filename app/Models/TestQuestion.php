<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestQuestion extends Model
{
    protected $fillable = ['test_category_id', 'question_text', 'order'];

    // Relasi: Pertanyaan ini milik sebuah kategori
    public function category()
    {
        return $this->belongsTo(TestCategory::class, 'test_category_id');
    }

    public function options()
    {
        return $this->hasMany(TestOption::class);
    }
}
