<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peningkatan_kualitas', function (Blueprint $table) {
            $table->id();

            // ===== MATERI POKOK PERATURAN =====
            $table->string('judul');
            $table->year('tahun')->nullable();
            $table->string('kata_kunci')->nullable();
            $table->text('abstrak')->nullable();
            $table->text('catatan')->nullable();

            // ===== METADATA PERATURAN =====
            $table->string('tipe_dokumen')->nullable();
            $table->string('judul_meta')->nullable();
            $table->string('teu')->nullable();
            $table->string('nomor')->nullable();
            $table->string('bentuk')->nullable();
            $table->string('bentuk_singkat')->nullable();
            $table->year('tahun_meta')->nullable();
            $table->string('tempat_penetapan')->nullable();
            $table->date('tanggal_penetapan')->nullable();
            $table->date('tanggal_pengundangan')->nullable();
            $table->date('tanggal_berlaku')->nullable();
            $table->string('sumber')->nullable();
            $table->string('subjek')->nullable();
            $table->string('status')->nullable();
            $table->string('bahasa')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('bidang')->nullable();

            // ===== FILE & STATUS =====
            $table->string('file_pdf')->nullable();
            $table->string('mencabut')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peningkatan_kualitas');
    }
};
