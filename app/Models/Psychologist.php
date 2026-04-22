<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Psychologist extends Model
{
    protected $fillable = [
    'name', 'email', 'phone', 'specialization', 
    'license_number', 'experience_years', 
    'price_per_session', 'bio', 'photo', 'status'
];
}
