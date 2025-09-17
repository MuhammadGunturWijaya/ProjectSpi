<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pos_aps', function (Blueprint $table) {
            $table->id();

            // ✅ Jenis hanya boleh salah satu dari audit, reviu, monev
            $table->enum('jenis', ['audit', 'reviu', 'monev']);

            $table->string('judul');
            $table->integer('tahun');
            $table->string('kata_kunci')->nullable();
            $table->text('abstrak')->nullable();
            $table->text('catatan')->nullable();

            // metadata
            $table->string('tipe_dokumen')->nullable();
            $table->string('judul_meta')->nullable();
            $table->string('teu')->nullable();
            $table->string('nomor')->nullable();
            $table->string('bentuk')->nullable();
            $table->string('bentuk_singkat')->nullable();
            $table->string('tahun_meta')->nullable();
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

            $table->string('file_pdf')->nullable();
            $table->text('mencabut')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos_aps');
    }
};
