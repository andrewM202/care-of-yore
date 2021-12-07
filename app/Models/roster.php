<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roster extends Model
{
    use HasFactory;

    protected $primaryKey = 'roster_id';
    protected $fillable = [
        'role',
        'personnel_name',
        'roster_date',
    ];

    public $timestamps = false;
}
