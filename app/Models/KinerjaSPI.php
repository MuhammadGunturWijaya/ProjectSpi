<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KinerjaSPI extends Model
{
    use HasFactory;

    protected $table = 'kinerja_spi';

    protected $fillable = [
        'judul',
        'tahun',
        'kata_kunci',
        'abstrak',
        'catatan',
        'tipe_dokumen',
        'judul_meta',
        'teu',
        'nomor',
        'bentuk',
        'bentuk_singkat',
        'tahun_meta',
        'tempat_penetapan',
        'tanggal_penetapan',
        'tanggal_pengundangan',
        'tanggal_berlaku',
        'sumber',
        'subjek',
        'status',
        'bahasa',
        'lokasi',
        'bidang',
        'file_pdf',
        'mencabut',
        'views',
    ];
}