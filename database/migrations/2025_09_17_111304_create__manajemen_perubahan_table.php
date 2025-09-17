<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('manajemenperubahan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_manajemen');
            $table->year('tahun');
            $table->string('file_path'); // path file di storage
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('manajemenperubahan');
    }
};
