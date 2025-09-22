<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penataan extends Model
{
    use HasFactory;

    // sesuaikan dengan nama tabel di database
    protected $table = 'zona_integritas'; 

    protected $fillable = [
        'jenis',
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
        'mencabut'
    ];

    protected $casts = [
        'tanggal_penetapan'    => 'datetime',
        'tanggal_pengundangan' => 'datetime',
        'tanggal_berlaku'      => 'datetime',
    ];
}
