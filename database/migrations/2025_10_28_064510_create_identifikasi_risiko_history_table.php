<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('identifikasi_risiko_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('identifikasi_risiko_id');
            $table->date('tanggal_evaluasi')->nullable();
            $table->string('abjad', 5)->nullable();
            $table->text('tujuan')->nullable();
            $table->string('bagian', 255)->nullable();
            $table->string('departemen', 255)->nullable();
            $table->text('proses_bisnis')->nullable();
            $table->text('kategori_risiko')->nullable();
            $table->text('uraian_risiko')->nullable();
            $table->text('penyebab_risiko')->nullable();
            $table->string('sumber_risiko', 100)->nullable();
            $table->text('akibat')->nullable();
            $table->string('pemilik_risiko', 255)->nullable();
            
            // Skor Awal
            $table->integer('skor_likelihood')->nullable();
            $table->integer('skor_impact')->nullable();
            $table->string('skor_level', 50)->nullable();
            
            // Pengendalian Intern
            $table->string('pengendalian_intern_ada', 50)->nullable();
            $table->string('pengendalian_intern_ada_keterangan', 255)->nullable();
            $table->string('pengendalian_intern_memadai', 50)->nullable();
            $table->string('pengendalian_intern_memadai_keterangan', 255)->nullable();
            $table->integer('pengendalian_intern_dijalankan')->nullable();
            $table->string('pengendalian_intern_dijalankan_keterangan', 255)->nullable();
            
            // Residu
            $table->integer('residu_likelihood')->nullable();
            $table->integer('residu_impact')->nullable();
            $table->string('residu_level', 50)->nullable();
            
            // Mitigasi
            $table->string('mitigasi_opsi', 255)->nullable();
            $table->string('mitigasi_opsi_keterangan', 255)->nullable();
            $table->text('mitigasi_deskripsi')->nullable();
            
            // Skor Akhir
            $table->integer('akhir_likelihood')->nullable();
            $table->integer('akhir_impact')->nullable();
            $table->string('akhir_level', 50)->nullable();
            
            $table->timestamps();
            
            // Foreign key dengan index
            $table->index('identifikasi_risiko_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('identifikasi_risiko_history');
    }
};