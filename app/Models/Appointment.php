<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara manual
    protected $table = 'janji_temu';

    protected $fillable = [
        'id_pasien',
        'id_psikolog',
        'tanggal_janji',
        'jam_janji',
        'status',
        'catatan_keluhan',
        'order_id',
        'gross_amount',
        'snap_token',
        'link_video_call',
    ];

    // Relasi ke User (Pasien)
    public function pasien()
    {
        return $this->belongsTo(User::class, 'id_pasien');
    }

    // Relasi ke Psikolog
    public function psikolog()
    {
        return $this->belongsTo(Psychologist::class, 'id_psikolog');
    }
}
