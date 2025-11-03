<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('surveys', function (Blueprint $table) {
            if (!Schema::hasColumn('surveys', 'jawaban')) {
                $table->json('jawaban')->nullable();
            }
        });

        // Drop kolom hanya jika memang masih ada
        Schema::table('surveys', function (Blueprint $table) {
            $columns = [
                'jawaban_1',
                'jawaban_2',
                'jawaban_3',
                'jawaban_4',
                'jawaban_5',
                'jawaban_6',
                'jawaban_7',
                'jawaban_8',
                'jawaban_9',
                'jawaban_custom'
            ];

            foreach ($columns as $col) {
                if (Schema::hasColumn('surveys', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }


    public function down()
    {
        Schema::table('surveys', function (Blueprint $table) {
            // Tambahkan kembali jika rollback
            $table->string('jawaban_1')->nullable();
            $table->string('jawaban_2')->nullable();
            $table->string('jawaban_3')->nullable();
            $table->string('jawaban_4')->nullable();
            $table->string('jawaban_5')->nullable();
            $table->string('jawaban_6')->nullable();
            $table->string('jawaban_7')->nullable();
            $table->string('jawaban_8')->nullable();
            $table->string('jawaban_9')->nullable();
            $table->json('jawaban_custom')->nullable();
            $table->dropColumn('jawaban');
        });
    }
};
