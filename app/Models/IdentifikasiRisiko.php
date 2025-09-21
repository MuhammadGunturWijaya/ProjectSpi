<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentifikasiRisiko extends Model
{
    use HasFactory;

    protected $fillable = [
        'abjad',
        'no',
        'tujuan',
        'proses_bisnis',
        'kategori_risiko',
        'uraian_risiko',
        'penyebab_risiko',
        'sumber_risiko',
        'akibat',
        'pemilik_risiko'
    ];
}
