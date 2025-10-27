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
        Schema::table('identifikasi_risikos', function (Blueprint $table) {
            $table->string('bagian')->nullable()->after('departemen'); // setelah kolom departemen
        });
    }

    public function down()
    {
        Schema::table('identifikasi_risikos', function (Blueprint $table) {
            $table->dropColumn('bagian');
        });
    }

};
