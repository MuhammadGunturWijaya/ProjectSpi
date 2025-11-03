<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->json('verification_checks')->nullable()->after('status');
            $table->text('verification_notes')->nullable()->after('verification_checks');
            $table->timestamp('verified_at')->nullable()->after('verification_notes');
            $table->unsignedBigInteger('verified_by')->nullable()->after('verified_at');
        });
    }

    public function down()
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->dropColumn(['verification_checks', 'verification_notes', 'verified_at', 'verified_by']);
        });
    }
};