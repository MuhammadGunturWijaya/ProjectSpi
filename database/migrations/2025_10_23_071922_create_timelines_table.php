<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('timelines', function (Blueprint $table) {
            $table->id();
            $table->string('year'); // Tahun/fase
            $table->string('title'); // Judul fase
            $table->text('description'); // Deskripsi fase
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('timelines');
    }
};
