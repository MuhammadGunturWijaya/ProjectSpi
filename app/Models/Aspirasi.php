<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'keterangan',
        'asal_pelapor',
        'instansi',
        'tanggal',
        'kategori',
        'kategori_lainnya',
        'lampiran',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    // Accessor untuk mendapatkan kategori lengkap
    public function getKategoriLengkapAttribute()
    {
        if ($this->kategori === 'lainnya' && $this->kategori_lainnya) {
            return $this->kategori_lainnya;
        }
        return ucfirst($this->kategori);
    }
}