<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidangPengaduan extends Model
{
    use HasFactory;

    protected $table = 'bidang_pengaduan';

    protected $fillable = [
        'nama_bidang',
        'deskripsi',
        'role',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relasi ke Pengaduan
     */
    public function pengaduans()
    {
        return $this->hasMany(Pengaduan::class, 'bidang_id');
    }

    /**
     * Scope untuk bidang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function roles()
    {
        return $this->hasMany(Role::class);
    }

}