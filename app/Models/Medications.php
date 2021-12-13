<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medications extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'morning_med',
        'afternoon_med',
        'evening_med',
        'comment',
        'appointment_id',
    ];
    public $timestamps = false;
}
