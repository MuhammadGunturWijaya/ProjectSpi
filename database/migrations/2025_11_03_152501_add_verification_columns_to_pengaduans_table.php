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
            // Tambahkan kolom jika belum ada
            if (!Schema::hasColumn('pengaduans', 'verification_checks')) {
                $table->json('verification_checks')->nullable()->after('status');
            }
            
            if (!Schema::hasColumn('pengaduans', 'verification_notes')) {
                $table->text('verification_notes')->nullable()->after('verification_checks');
            }
            
            if (!Schema::hasColumn('pengaduans', 'verified_by')) {
                $table->foreignId('verified_by')->nullable()->constrained('users')->after('verification_notes');
            }
            
            if (!Schema::hasColumn('pengaduans', 'verified_at')) {
                $table->timestamp('verified_at')->nullable()->after('verified_by');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->dropColumn(['verification_checks', 'verification_notes', 'verified_by', 'verified_at']);
        });
    }
};