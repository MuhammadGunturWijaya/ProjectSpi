<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentifikasiRisiko extends Model
{
    use HasFactory;

    protected $fillable = [
        'abjad',
        'tujuan',
        'proses_bisnis',
        'kategori_risiko',
        'uraian_risiko',
        'penyebab_risiko',
        'sumber_risiko',
        'akibat',
        'pemilik_risiko',

        // tambahan baru
        'departemen',

        // skor awal
        'skor_likelihood',
        'skor_impact',
        'skor_level',

        // pengendalian intern
        'pengendalian_intern_ada',
        'pengendalian_intern_memadai',
        'pengendalian_intern_dijalankan',

        // nilai residu
        'residu_likelihood',
        'residu_impact',
        'residu_level',

        // mitigasi risiko
        'mitigasi_opsi',
        'mitigasi_deskripsi',

        // skor akhir
        'akhir_likelihood',
        'akhir_impact',
        'akhir_level',
    ];
}
