<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patients extends Model
{
    use HasFactory;

    protected $primaryKey = 'patient_id';
    protected $fillable = [
        'morning_med',
        'afternoon_med',
        'night_med'
    ];

    public $timestamps = false;
}
