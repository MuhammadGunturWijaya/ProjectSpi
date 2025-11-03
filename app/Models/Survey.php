<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'jenis_kelamin',
        'pendidikan',
        'pekerjaan',
        'tanggal',
        'jawaban',      // kolom baru
        'kendala',
        'saran',
    ];

    protected $casts = [
        'jawaban' => 'array',   // otomatis decode JSON ke array
    ];
}
