<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PsychologistSchedule extends Model
{
    protected $fillable = [
        'psychologist_id',
        'day',
        'start_time',
        'end_time',
    ];
}
