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
            $table->enum('status', [
                'laporan_dikirim',     // Step 1
                'diverifikasi',        // Step 2
                'tindak_lanjut',       // Step 3
                'tanggapan_pelapor',   // Step 4
                'selesai'              // Step 5
            ])->default('laporan_dikirim');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            //
        });
    }
};
