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
        Schema::table('pengaduans', function (Blueprint $table) {
            // Step 1
            $table->date('tanggal_pengaduan')->nullable();
            $table->string('perihal')->nullable();
            $table->text('uraian')->nullable();
            $table->json('bukti_file')->nullable();

            $table->integer('usia')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('pekerjaan_lain')->nullable();
            $table->string('waktu_hubung')->nullable();
            $table->string('waktu_lain')->nullable();

            $table->json('pelanggaran')->nullable();
            $table->string('pelanggaran_lain')->nullable();
            $table->json('kontak')->nullable();

            $table->date('tanggal_kejadian')->nullable();
            $table->time('jam_kejadian')->nullable();
            $table->string('tempat_kejadian')->nullable();
            $table->string('tempat_lain')->nullable();

            // Step 2
            $table->json('terlapor')->nullable();

            // Pernyataan & pihak terkait
            $table->string('identitas_diketahui')->nullable();
            $table->text('pihak_terkait')->nullable();
        });
    }

    public function down()
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->dropColumn([
                'tanggal_pengaduan',
                'perihal',
                'uraian',
                'bukti_file',
                'usia',
                'pendidikan',
                'pekerjaan',
                'pekerjaan_lain',
                'waktu_hubung',
                'waktu_lain',
                'pelanggaran',
                'pelanggaran_lain',
                'kontak',
                'tanggal_kejadian',
                'jam_kejadian',
                'tempat_kejadian',
                'tempat_lain',
                'terlapor',
                'identitas_diketahui',
                'pihak_terkait',
            ]);
        });
    }

};
