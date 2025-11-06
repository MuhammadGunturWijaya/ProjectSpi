<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleBidang extends Model
{
    use HasFactory;

    protected $table = 'role_bidang';

    protected $fillable = [
        'nama_role',
        'deskripsi',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope untuk mengambil hanya role yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
