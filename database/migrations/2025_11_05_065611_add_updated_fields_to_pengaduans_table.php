<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->json('updated_fields')->nullable()->after('fields_to_fix');
        });
    }

    public function down()
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->dropColumn('updated_fields');
        });
    }
};