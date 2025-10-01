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
        Schema::table('identifikasi_risikos', function (Blueprint $table) {
            $table->string('pengendalian_intern_ada_keterangan')->nullable();
            $table->string('pengendalian_intern_memadai_keterangan')->nullable();
            $table->string('pengendalian_intern_dijalankan_keterangan')->nullable();
            $table->string('mitigasi_opsi_keterangan')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('identifikasi_risikos', function (Blueprint $table) {
            $table->dropColumn([
                'pengendalian_intern_ada_keterangan',
                'pengendalian_intern_memadai_keterangan',
                'pengendalian_intern_dijalankan_keterangan',
                'mitigasi_opsi_keterangan'
            ]);
        });
    }

};
