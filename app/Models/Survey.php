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
        'jenis_kelamin', // ✅ tambah ini
        'pendidikan',    // ✅ tambah ini
        'pekerjaan',     // ✅ tambah ini
        'tanggal',
        'jawaban_1',
        'jawaban_2',
        'jawaban_3',
        'jawaban_4',
        'jawaban_5',
        'jawaban_6',
        'jawaban_7',
        'jawaban_8',
        'jawaban_9',
        'kendala',
        'saran',
    ];

}
