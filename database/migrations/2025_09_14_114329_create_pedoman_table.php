<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pedoman', function (Blueprint $table) {
            $table->id();

            // ===== MATERI POKOK PERATURAN =====
            $table->string('judul');                       // Judul materi
            $table->year('tahun')->nullable();             // Tahun
            $table->string('kata_kunci')->nullable();      // Kata kunci
            $table->text('abstrak')->nullable();           // Abstrak
            $table->text('catatan')->nullable();           // Catatan

            // ===== METADATA PERATURAN =====
            $table->string('tipe_dokumen')->nullable();
            $table->string('judul_meta')->nullable();      // Judul metadata
            $table->string('teu')->nullable();             // T.E.U
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
            $table->string('file_pdf')->nullable();        // path pdf
            $table->string('mencabut')->nullable();        // status mencabut

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedoman');
    }
};
