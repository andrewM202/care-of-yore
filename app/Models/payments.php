<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payments extends Model
{
    use HasFactory;
    protected $primaryKey = 'payment_id';
    protected $fillable = [
        'patient_id',
        'total_paid',
        'total_due',
    ];  

    public $timestamps = false;
}
