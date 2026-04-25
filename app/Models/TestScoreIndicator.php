<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestScoreIndicator extends Model
{
    protected $fillable = [
        'test_category_id', 
        'min_score', 
        'max_score', 
        'status', 
        'recommended_specialization_id'
    ];

    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'recommended_specialization_id');
    }
}
