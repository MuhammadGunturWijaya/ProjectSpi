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
        Schema::create('processes', function (Blueprint $table) {
            $table->id();
            $table->integer('step_number'); // contoh: 1, 2, 3, dst
            $table->string('icon')->nullable(); // contoh: 'bi bi-clipboard-check'
            $table->string('title'); // contoh: 'Perencanaan'
            $table->text('description'); // penjelasan
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('processes');
    }
};
