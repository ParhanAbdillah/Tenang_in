<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PsychologistSchedule extends Model
{
    protected $fillable = [
        'psychologist_id',
        'day',
        'schedule_date',
        'start_time',
        'end_time',
        'session_interval',
        'is_active',
    ];
}
