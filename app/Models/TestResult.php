<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    protected $fillable = [
        'user_id',
        'test_category_id',
        'total_score',
        'diagnosis',
        'suggestion'
    ];
    // Tambahkan relasi ini
    public function category()
    {
        return $this->belongsTo(TestCategory::class, 'test_category_id');
    }
}
