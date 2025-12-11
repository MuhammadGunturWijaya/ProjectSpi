<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetOtp extends Model
{
    protected $fillable = [
        'email',
        'otp',
        'expires_at',
        'is_used'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_used' => 'boolean'
    ];

    public function isExpired()
    {
        return $this->expires_at < now();
    }

    public function isValid()
    {
        return !$this->is_used && !$this->isExpired();
    }
}