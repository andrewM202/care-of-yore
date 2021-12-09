<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class appointments extends Model
{
    use HasFactory;

    protected $primaryKey = 'appointment_id';
    protected $fillable = [
        'appointment_date',
        'doctor_id',
        'patient_id',
    ];

    public $timestamps = false;
}
