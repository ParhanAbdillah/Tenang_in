<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Psychologist extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'specialization',
        'license_number',
        'experience_years',
        'price_per_session',
        'bio',
        'photo',
        'status',
        'clinical_type_id',
        'educational_background',
        'total_sessions',
        'satisfaction_rate'
    ];

    public function specializations()
    {
        // Nama tabel pivot harus sesuai dengan yang baru dibuat
        return $this->belongsToMany(Specialization::class, 'psychologist_specialization');
    }

    // Tambahkan juga relasi untuk Clinical Type yang baru kita bahas
    public function clinicalType()
    {
        return $this->belongsTo(ClinicalType::class);
    }

    public function schedules()
    {
        return $this->hasMany(PsychologistSchedule::class)->orderBy('day')->orderBy('start_time');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
