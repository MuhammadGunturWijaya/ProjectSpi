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
            // Kolom untuk auto-save verification
            if (!Schema::hasColumn('pengaduans', 'last_verified_at')) {
                $table->timestamp('last_verified_at')->nullable()->after('verified_at');
            }

            // Kolom untuk rejection (kembalikan ke pelapor)
            if (!Schema::hasColumn('pengaduans', 'rejection_reason')) {
                $table->text('rejection_reason')->nullable()->after('verification_notes');
            }
            if (!Schema::hasColumn('pengaduans', 'rejected_at')) {
                $table->timestamp('rejected_at')->nullable()->after('rejection_reason');
            }
            if (!Schema::hasColumn('pengaduans', 'rejected_by')) {
                $table->unsignedBigInteger('rejected_by')->nullable()->after('rejected_at');
            }

            // Kolom untuk menyimpan history verifikasi sebelumnya
            if (!Schema::hasColumn('pengaduans', 'verification_history')) {
                $table->json('verification_history')->nullable()->after('rejected_by');
            }

            // Kolom untuk menyimpan field yang perlu diperbaiki (yang disilang)
            if (!Schema::hasColumn('pengaduans', 'fields_to_fix')) {
                $table->json('fields_to_fix')->nullable()->after('verification_history');
            }

            // Kolom untuk tracking revisi
            if (!Schema::hasColumn('pengaduans', 'revision_count')) {
                $table->integer('revision_count')->default(0)->after('fields_to_fix');
            }
            if (!Schema::hasColumn('pengaduans', 'last_revision_at')) {
                $table->timestamp('last_revision_at')->nullable()->after('revision_count');
            }
        });

        // Tambahkan foreign key secara manual (tanpa Doctrine)
        if (! $this->foreignKeyExists('pengaduans', 'rejected_by')) {
            Schema::table('pengaduans', function (Blueprint $table) {
                $table->foreign('rejected_by')->references('id')->on('users')->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            // Hapus foreign key jika ada
            try {
                $table->dropForeign(['rejected_by']);
            } catch (\Exception $e) {
                // abaikan jika FK tidak ada
            }

            // Hapus kolom jika ada
            $columns = [
                'last_verified_at',
                'rejection_reason',
                'rejected_at',
                'rejected_by',
                'verification_history',
                'fields_to_fix',
                'revision_count',
                'last_revision_at',
            ];

            foreach ($columns as $col) {
                if (Schema::hasColumn('pengaduans', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }

    /**
     * Cek apakah foreign key sudah ada (tanpa Doctrine)
     */
    private function foreignKeyExists(string $table, string $column): bool
    {
        $database = DB::getDatabaseName();
        $query = "
            SELECT CONSTRAINT_NAME
            FROM information_schema.KEY_COLUMN_USAGE
            WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? AND COLUMN_NAME = ? AND REFERENCED_TABLE_NAME IS NOT NULL
        ";
        return DB::select($query, [$database, $table, $column]) !== [];
    }
};
