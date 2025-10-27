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
        'departemen',
        'bagian',
        'proses_bisnis',
        'kategori_risiko',
        'uraian_risiko',
        'penyebab_risiko',
        'sumber_risiko',
        'akibat',
        'pemilik_risiko',
        'skor_likelihood',
        'skor_impact',
        'skor_level',
        'pengendalian_intern_ada',
        'pengendalian_intern_memadai',
        'pengendalian_intern_dijalankan',
        'pengendalian_intern_ada_keterangan',
        'pengendalian_intern_memadai_keterangan',
        'pengendalian_intern_dijalankan_keterangan',
        'residu_likelihood',
        'residu_impact',
        'residu_level',
        'mitigasi_opsi',
        'mitigasi_deskripsi',
        'mitigasi_opsi_keterangan',
        'akhir_likelihood',
        'akhir_impact',
        'akhir_level'
    ];
}
