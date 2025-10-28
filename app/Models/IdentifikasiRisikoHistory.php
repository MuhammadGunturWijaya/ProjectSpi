<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdentifikasiRisikoHistory extends Model
{
    protected $table = 'identifikasi_risiko_history';

    protected $fillable = [
        'identifikasi_risiko_id',
        'tanggal_evaluasi',
        'abjad',
        'tujuan',
        'bagian',
        'departemen',
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
        'pengendalian_intern_ada_keterangan',
        'pengendalian_intern_memadai',
        'pengendalian_intern_memadai_keterangan',
        'pengendalian_intern_dijalankan',
        'pengendalian_intern_dijalankan_keterangan',
        'residu_likelihood',
        'residu_impact',
        'residu_level',
        'mitigasi_opsi',
        'mitigasi_opsi_keterangan',
        'mitigasi_deskripsi',
        'akhir_likelihood',
        'akhir_impact',
        'akhir_level',
    ];

    protected $casts = [
        'tanggal_evaluasi' => 'date',
    ];

    public function identifikasiRisiko()
    {
        return $this->belongsTo(IdentifikasiRisiko::class);
    }
}