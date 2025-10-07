<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'alt_email')) {
                $table->string('alt_email')->nullable();
            }
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable();
            }
            if (!Schema::hasColumn('users', 'address')) {
                $table->text('address')->nullable();
            }
            if (!Schema::hasColumn('users', 'user_type')) {
                $table->enum('user_type', ['pegawai','whistleblower','masyarakat'])->nullable();
            }
            if (!Schema::hasColumn('users', 'pegawai_role')) {
                $table->enum('pegawai_role', ['pimpinan','pejabat','pegawai','admin','pengawas'])->nullable();
            }
            if (!Schema::hasColumn('users', 'gender')) {
                $table->enum('gender', ['Laki-laki','Perempuan','Disembunyikan'])->nullable();
            }
            if (!Schema::hasColumn('users', 'disability')) {
                $table->enum('disability', ['iya','tidak'])->nullable();
            }
            if (!Schema::hasColumn('users', 'disability_type')) {
                $table->enum('disability_type', ['low_vision','blind','hearing','other'])->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'alt_email','phone','address','user_type','pegawai_role','gender','disability','disability_type'
            ]);
        });
    }
};
