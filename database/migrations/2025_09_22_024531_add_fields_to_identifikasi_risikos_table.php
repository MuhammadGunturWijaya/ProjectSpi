<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('identifikasi_risikos', function (Blueprint $table) {
            $table->id();
            $table->string('abjad');
            $table->string('tujuan');
            $table->string('proses_bisnis');
            $table->string('kategori_risiko');
            $table->text('uraian_risiko');
            $table->text('penyebab_risiko');
            $table->string('sumber_risiko'); // internal / eksternal
            $table->text('akibat');
            $table->string('pemilik_risiko');

            // 🔹 tambahan baru
            $table->string('departemen')->nullable();

            // skor awal
            $table->integer('skor_likelihood')->nullable();
            $table->integer('skor_impact')->nullable();
            $table->string('skor_level')->nullable();

            // pengendalian intern
            $table->enum('pengendalian_intern_ada', ['ada', 'tidak ada'])->nullable();
            $table->enum('pengendalian_intern_memadai', ['memadai', 'tidak memadai'])->nullable();
            $table->enum('pengendalian_intern_dijalankan', ['dijalankan', 'belum dijalankan'])->nullable();

            // nilai residu
            $table->integer('residu_likelihood')->nullable();
            $table->integer('residu_impact')->nullable();
            $table->string('residu_level')->nullable();

            // mitigasi risiko
            $table->string('mitigasi_opsi')->nullable();
            $table->text('mitigasi_deskripsi')->nullable();

            // skor akhir
            $table->integer('akhir_likelihood')->nullable();
            $table->integer('akhir_impact')->nullable();
            $table->string('akhir_level')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('identifikasi_risikos');
    }
};