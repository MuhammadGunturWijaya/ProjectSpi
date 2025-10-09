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
            if (Schema::hasColumn('pengaduans', 'nama')) {
                $table->dropColumn('nama');
            }
            if (Schema::hasColumn('pengaduans', 'email')) {
                $table->dropColumn('email');
            }
            if (Schema::hasColumn('pengaduans', 'kategori')) {
                $table->dropColumn('kategori');
            }
            if (Schema::hasColumn('pengaduans', 'judul')) {
                $table->dropColumn('judul');
            }
            if (Schema::hasColumn('pengaduans', 'kritik_saran')) {
                $table->dropColumn('kritik_saran');
            }
            if (Schema::hasColumn('pengaduans', 'bukti_foto')) {
                $table->dropColumn('bukti_foto');
            }
        });
    }

    public function down()
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->string('nama')->nullable();
            $table->string('email')->nullable();
            $table->string('kategori')->nullable();
            $table->string('judul')->nullable();
            $table->text('kritik_saran')->nullable();
            $table->string('bukti_foto')->nullable();
        });
    }

};
