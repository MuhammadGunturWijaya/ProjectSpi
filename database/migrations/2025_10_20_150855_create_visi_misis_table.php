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
        Schema::table('visi_misis', function (Blueprint $table) {
            $table->longText('tujuan')->nullable();
            $table->longText('visi')->nullable();
            $table->longText('misi')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('visi_misis', function (Blueprint $table) {
            $table->dropColumn(['tujuan', 'visi', 'misi']);
        });
    }

};
