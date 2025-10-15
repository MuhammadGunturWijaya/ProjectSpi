<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'tanggal_pengaduan',
        'perihal',
        'uraian',
        'bukti_file',
        'usia',
        'pendidikan',
        'pekerjaan',
        'pekerjaan_lain',
        'waktu_hubung',
        'waktu_lain',
        'pelanggaran',
        'pelanggaran_lain',
        'kontak',
        'tanggal_kejadian',
        'jam_kejadian',
        'tempat_kejadian',
        'tempat_lain',
        'terlapor',
        'identitas_diketahui',
        'pihak_terkait',
        'status',
    ];

    protected $casts = [
        'bukti_file' => 'array',
        'pelanggaran' => 'array',
        'kontak' => 'array',
        'terlapor' => 'array',
    ];
}