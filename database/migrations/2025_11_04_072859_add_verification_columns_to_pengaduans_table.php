<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            // Kolom untuk auto-save verification
            $table->timestamp('last_verified_at')->nullable()->after('verified_at');
            
            // Kolom untuk rejection (kembalikan ke pelapor)
            $table->text('rejection_reason')->nullable()->after('verification_notes');
            $table->timestamp('rejected_at')->nullable()->after('rejection_reason');
            $table->unsignedBigInteger('rejected_by')->nullable()->after('rejected_at');
            
            // Kolom untuk menyimpan history verifikasi sebelumnya
            $table->json('verification_history')->nullable()->after('rejected_by');
            
            // Foreign key untuk rejected_by
            $table->foreign('rejected_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->dropForeign(['rejected_by']);
            $table->dropColumn([
                'last_verified_at',
                'rejection_reason',
                'rejected_at',
                'rejected_by',
                'verification_history'
            ]);
        });
    }
};