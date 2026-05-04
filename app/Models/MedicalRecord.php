<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    protected $table = 'catatan_medis';
    protected $fillable = ['id_janji', 'id_pasien', 'id_psikolog', 'catatan_konsultasi'];


    public function pasien()
    {
        return $this->belongsTo(User::class, 'id_pasien');
    }
}

