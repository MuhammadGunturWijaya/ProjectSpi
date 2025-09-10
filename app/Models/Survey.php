<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    // Izinkan mass assignment untuk field ini
    protected $fillable = [
        'email',
        'kepuasan',
        'saran',
    ];

}
