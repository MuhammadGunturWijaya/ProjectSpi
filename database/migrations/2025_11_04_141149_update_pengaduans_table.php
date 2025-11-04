<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            // Verifikasi data
            $table->json('verification_checks')->nullable()->after('status');
            $table->text('verification_notes')->nullable()->after('verification_checks');
            $table->unsignedBigInteger('verified_by')->nullable()->after('verification_notes');
            $table->timestamp('verified_at')->nullable()->after('verified_by');
            $table->timestamp('last_verified_at')->nullable()->after('verified_at');
            
            // Rejection data
            $table->text('rejection_reason')->nullable()->after('last_verified_at');
            $table->timestamp('rejected_at')->nullable()->after('rejection_reason');
            $table->unsignedBigInteger('rejected_by')->nullable()->after('rejected_at');
            $table->json('fields_to_fix')->nullable()->after('rejected_by');
            
            // Revision tracking
            $table->integer('revision_count')->default(0)->after('fields_to_fix');
            $table->timestamp('last_revision_at')->nullable()->after('revision_count');
            
            // Foreign keys
            $table->foreign('verified_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('rejected_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->dropForeign(['verified_by']);
            $table->dropForeign(['rejected_by']);
            
            $table->dropColumn([
                'verification_checks',
                'verification_notes',
                'verified_by',
                'verified_at',
                'last_verified_at',
                'rejection_reason',
                'rejected_at',
                'rejected_by',
                'fields_to_fix',
                'revision_count',
                'last_revision_at',
            ]);
        });
    }
};
