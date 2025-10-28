<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisiMisi extends Model
{
    public function up(): void
    {
        Schema::create('visi_misis', function (Blueprint $table) {
            $table->id();
            $table->longText('tujuan')->nullable();
            $table->longText('visi')->nullable();
            $table->longText('misi')->nullable();
            $table->longText('tanggal')->nullable();
            $table->longText('jam')->nullable();
            $table->timestamps();
        });
    }

    protected $fillable = [
        'tujuan',
        'visi',
        'misi',
        'tanggal',
        'jam',
    ];

}
