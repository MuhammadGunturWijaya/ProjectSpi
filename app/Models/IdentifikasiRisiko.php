<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdentifikasiRisiko extends Model
{
    protected $table = 'identifikasi_risikos';

    protected $fillable = [
        'urutan',
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

    // Relasi ke history
    public function histories()
    {
        return $this->hasMany(IdentifikasiRisikoHistory::class)->orderBy('tanggal_evaluasi', 'desc');
    }

    // Method untuk menyimpan ke history sebelum update
    public function saveToHistory()
    {
        IdentifikasiRisikoHistory::create([
            'identifikasi_risiko_id' => $this->id,
            'tanggal_evaluasi' => $this->tanggal_evaluasi,
            'abjad' => $this->abjad,
            'tujuan' => $this->tujuan,
            'bagian' => $this->bagian,
            'departemen' => $this->departemen,
            'proses_bisnis' => $this->proses_bisnis,
            'kategori_risiko' => $this->kategori_risiko,
            'uraian_risiko' => $this->uraian_risiko,
            'penyebab_risiko' => $this->penyebab_risiko,
            'sumber_risiko' => $this->sumber_risiko,
            'akibat' => $this->akibat,
            'pemilik_risiko' => $this->pemilik_risiko,
            'skor_likelihood' => $this->skor_likelihood,
            'skor_impact' => $this->skor_impact,
            'skor_level' => $this->skor_level,
            'pengendalian_intern_ada' => $this->pengendalian_intern_ada,
            'pengendalian_intern_ada_keterangan' => $this->pengendalian_intern_ada_keterangan,
            'pengendalian_intern_memadai' => $this->pengendalian_intern_memadai,
            'pengendalian_intern_memadai_keterangan' => $this->pengendalian_intern_memadai_keterangan,
            'pengendalian_intern_dijalankan' => $this->pengendalian_intern_dijalankan,
            'pengendalian_intern_dijalankan_keterangan' => $this->pengendalian_intern_dijalankan_keterangan,
            'residu_likelihood' => $this->residu_likelihood,
            'residu_impact' => $this->residu_impact,
            'residu_level' => $this->residu_level,
            'mitigasi_opsi' => $this->mitigasi_opsi,
            'mitigasi_opsi_keterangan' => $this->mitigasi_opsi_keterangan,
            'mitigasi_deskripsi' => $this->mitigasi_deskripsi,
            'akhir_likelihood' => $this->akhir_likelihood,
            'akhir_impact' => $this->akhir_impact,
            'akhir_level' => $this->akhir_level,
        ]);
    }
}