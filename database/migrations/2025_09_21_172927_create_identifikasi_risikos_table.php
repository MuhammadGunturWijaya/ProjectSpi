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
            $table->integer('no');
            $table->string('tujuan');
            $table->string('proses_bisnis');
            $table->string('kategori_risiko');
            $table->text('uraian_risiko');
            $table->text('penyebab_risiko');
            $table->string('sumber_risiko'); // internal / eksternal
            $table->text('akibat');
            $table->string('pemilik_risiko');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('identifikasi_risikos');
    }
};
