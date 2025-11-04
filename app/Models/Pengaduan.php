<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduans';

    // Menggunakan guarded kosong agar fleksibel, tapi tetap bisa gunakan fillable sesuai kebutuhan
    protected $guarded = [];

    /**
     * ✅ CASTING OTOMATIS UNTUK JSON DAN DATETIME
     */
    protected $casts = [
        // JSON Fields
        'pelanggaran' => 'array',
        'kontak' => 'array',
        'terlapor' => 'array',
        'bukti_file' => 'array',
        'verification_checks' => 'array',
        'verification_history' => 'array',
        'fields_to_fix' => 'array',

        // Date/Time Fields
        'tanggal_pengaduan' => 'date',
        'tanggal_kejadian' => 'date',
        'verified_at' => 'datetime',
        'last_verified_at' => 'datetime',
        'rejected_at' => 'datetime',
        'last_revision_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',

        // Integer Fields
        'revision_count' => 'integer',
        'usia' => 'integer',
    ];

    /**
     * ✅ ACCESSOR: Pastikan kolom array tetap mengembalikan array
     */
    public function getPelanggaranAttribute($value)
    {
        return $this->decodeJson($value);
    }

    public function getKontakAttribute($value)
    {
        return $this->decodeJson($value);
    }

    public function getTerlaporAttribute($value)
    {
        return $this->decodeJson($value);
    }

    public function getBuktiFileAttribute($value)
    {
        return $this->decodeJson($value);
    }

    /**
     * 🔧 Helper untuk decoding JSON field
     */
    protected function decodeJson($value)
    {
        if (is_array($value)) {
            return $value;
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : [];
        }

        return [];
    }

    /**
     * 🔗 Relasi ke User (Pelapor)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * 🔗 Relasi ke User (Admin yang verifikasi)
     */
    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * 🔗 Relasi ke User (Admin yang menolak/kembalikan)
     */
    public function rejectedBy()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    /**
     * 🟡 Accessor - Cek apakah laporan ditolak
     */
    public function getIsRejectedAttribute()
    {
        return !is_null($this->rejected_at);
    }

    /**
     * 🟢 Accessor - Jumlah field yang ditolak
     */
    public function getRejectedFieldsCountAttribute()
    {
        if (!$this->verification_checks) {
            return 0;
        }

        return collect($this->verification_checks)
            ->filter(fn($value) => $value === 'no')
            ->count();
    }

    /**
     * 🔵 Accessor - Jumlah field yang disetujui
     */
    public function getApprovedFieldsCountAttribute()
    {
        if (!$this->verification_checks) {
            return 0;
        }

        return collect($this->verification_checks)
            ->filter(fn($value) => $value === 'yes')
            ->count();
    }

    /**
     * 🧩 Scope - Hanya laporan yang perlu koreksi
     */
    public function scopeNeedsCorrection($query)
    {
        return $query->where('status', 'laporan_dikirim')
                     ->whereNotNull('rejected_at');
    }

    /**
     * 🧩 Scope - Berdasarkan user
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
