<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'slug'];

    // Relasi: Satu kategori punya banyak pertanyaan
    public function questions()
    {
        return $this->hasMany(TestQuestion::class, 'test_category_id');
    }
}
