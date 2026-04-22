<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    protected $fillable = ['name', 'code'];

    public function psychologists()
{
    // Relasi ke model Specialization menggunakan kolom 'specialization' sebagai key
    return $this->belongsTo(Specialization::class, 'specialization', 'code');
}
}
