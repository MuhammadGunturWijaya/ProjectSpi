<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedoman extends Model
{
    protected $table = 'pedoman';

    protected $fillable = [
        // Materi Pokok
        'judul',
        'tahun',
        'kata_kunci',
        'abstrak',
        'catatan',

        // Metadata
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

        // File & Status
        'file_pdf',
        'mencabut'
    ];
}