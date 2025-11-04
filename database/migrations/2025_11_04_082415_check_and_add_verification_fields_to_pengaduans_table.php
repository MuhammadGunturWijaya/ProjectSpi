<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            // Helper function to check if column exists
            $hasColumn = function($columnName) {
                return Schema::hasColumn('pengaduans', $columnName);
            };

            // Add verification_checks if not exists
            if (!$hasColumn('verification_checks')) {
                $table->json('verification_checks')->nullable()->after('status');
            }

            // Add verification_notes if not exists
            if (!$hasColumn('verification_notes')) {
                $table->text('verification_notes')->nullable()->after('verification_checks');
            }

            // Add verified_by if not exists
            if (!$hasColumn('verified_by')) {
                $table->unsignedBigInteger('verified_by')->nullable()->after('verification_notes');
                $table->foreign('verified_by')->references('id')->on('users')->onDelete('set null');
            }

            // Add verified_at if not exists
            if (!$hasColumn('verified_at')) {
                $table->timestamp('verified_at')->nullable()->after('verified_by');
            }

            // Add last_verified_at if not exists
            if (!$hasColumn('last_verified_at')) {
                $table->timestamp('last_verified_at')->nullable()->after('verified_at');
            }

            // Add rejection_reason if not exists
            if (!$hasColumn('rejection_reason')) {
                $table->text('rejection_reason')->nullable()->after('last_verified_at');
            }

            // Add rejected_at if not exists
            if (!$hasColumn('rejected_at')) {
                $table->timestamp('rejected_at')->nullable()->after('rejection_reason');
            }

            // Add rejected_by if not exists
            if (!$hasColumn('rejected_by')) {
                $table->unsignedBigInteger('rejected_by')->nullable()->after('rejected_at');
                $table->foreign('rejected_by')->references('id')->on('users')->onDelete('set null');
            }

            // Add fields_to_fix if not exists
            if (!$hasColumn('fields_to_fix')) {
                $table->json('fields_to_fix')->nullable()->after('rejected_by');
            }

            // Add revision_count if not exists
            if (!$hasColumn('revision_count')) {
                $table->integer('revision_count')->default(0)->after('fields_to_fix');
            }

            // Add last_revision_at if not exists
            if (!$hasColumn('last_revision_at')) {
                $table->timestamp('last_revision_at')->nullable()->after('revision_count');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            // Drop foreign keys first
            if (Schema::hasColumn('pengaduans', 'verified_by')) {
                try {
                    $table->dropForeign(['verified_by']);
                } catch (\Exception $e) {
                    // Foreign key might not exist
                }
            }

            if (Schema::hasColumn('pengaduans', 'rejected_by')) {
                try {
                    $table->dropForeign(['rejected_by']);
                } catch (\Exception $e) {
                    // Foreign key might not exist
                }
            }

            // Drop columns if they exist
            $columns = [
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
                'last_revision_at'
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('pengaduans', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};