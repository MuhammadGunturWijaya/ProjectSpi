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
        if (!Schema::hasColumn('pengaduans', 'kode_verifikasi')) {
            $table->string('kode_verifikasi')->unique()->after('id');
        }

        if (!Schema::hasColumn('pengaduans', 'kode_aduan')) {
            $table->string('kode_aduan')->unique()->after('kode_verifikasi');
        }
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
