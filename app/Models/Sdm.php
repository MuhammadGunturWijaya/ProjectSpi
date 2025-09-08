<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sdm extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'jabatan',
        'bidang',
        'biodata',
        'pengalaman',
        'tanggal_lahir',
        'foto',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

}
