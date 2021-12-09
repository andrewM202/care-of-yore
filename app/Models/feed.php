<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class feed extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'date',
        'breakfast',
        'lunch',
        'dinner',
    ];

    public $timestamps = false;
}
