<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    // Izinkan mass assignment untuk field ini
    protected $fillable = [
        'email',      // email user pengisi survey
        'jawaban_1',  // jawaban pertanyaan 1
        'jawaban_2',  // jawaban pertanyaan 2
        'jawaban_3',  // jawaban pertanyaan 3
        'jawaban_4',  // jawaban pertanyaan 4
        'jawaban_5',  // jawaban pertanyaan 5
        'jawaban_6',  // jawaban pertanyaan 6
        'jawaban_7',  // jawaban pertanyaan 7
        'jawaban_8',  // jawaban pertanyaan 8
        'jawaban_9',  // jawaban pertanyaan 9
        'kendala',    // field kendala (boleh kosong)
        'saran',      // field saran (boleh kosong)
    ];
}
