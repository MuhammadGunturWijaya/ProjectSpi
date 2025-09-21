<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenataanSistem extends Model
{
    protected $table = 'penataan_sistem';

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
        'mencabut'
    ];
    protected $casts = [
        'tanggal_penetapan' => 'datetime',
        'tanggal_pengundangan' => 'datetime',
        'tanggal_berlaku' => 'datetime',
    ];

}
