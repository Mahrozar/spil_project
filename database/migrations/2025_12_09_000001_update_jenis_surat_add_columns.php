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
        // If table exists, ensure columns are present
        if (Schema::hasTable('jenis_surat')) {
            Schema::table('jenis_surat', function (Blueprint $table) {
                if (! Schema::hasColumn('jenis_surat', 'nama_surat')) {
                    $table->string('nama_surat')->nullable()->after('id');
                }
                if (! Schema::hasColumn('jenis_surat', 'keterangan')) {
                    $table->text('keterangan')->nullable()->after('nama_surat');
                }
                if (! Schema::hasColumn('jenis_surat', 'status')) {
                    $table->string('status')->default('active')->after('keterangan');
                }
            });

            return;
        }

        // If the 'jenis_surat2' table exists (some older migration used that name), try to add columns there too
        if (Schema::hasTable('jenis_surat2')) {
            Schema::table('jenis_surat2', function (Blueprint $table) {
                if (! Schema::hasColumn('jenis_surat2', 'nama_surat')) {
                    $table->string('nama_surat')->nullable()->after('id');
                }
                if (! Schema::hasColumn('jenis_surat2', 'keterangan')) {
                    $table->text('keterangan')->nullable()->after('nama_surat');
                }
                if (! Schema::hasColumn('jenis_surat2', 'status')) {
                    $table->string('status')->default('active')->after('keterangan');
                }
            });

            return;
        }

        // Otherwise create the table
        Schema::create('jenis_surat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_surat');
            $table->text('keterangan')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('jenis_surat')) {
            Schema::table('jenis_surat', function (Blueprint $table) {
                if (Schema::hasColumn('jenis_surat', 'status')) {
                    $table->dropColumn('status');
                }
                if (Schema::hasColumn('jenis_surat', 'keterangan')) {
                    $table->dropColumn('keterangan');
                }
                if (Schema::hasColumn('jenis_surat', 'nama_surat')) {
                    $table->dropColumn('nama_surat');
                }
            });

            // If table only had these columns, we don't drop the table to avoid data loss.
            return;
        }

        if (Schema::hasTable('jenis_surat2')) {
            Schema::table('jenis_surat2', function (Blueprint $table) {
                if (Schema::hasColumn('jenis_surat2', 'status')) {
                    $table->dropColumn('status');
                }
                if (Schema::hasColumn('jenis_surat2', 'keterangan')) {
                    $table->dropColumn('keterangan');
                }
                if (Schema::hasColumn('jenis_surat2', 'nama_surat')) {
                    $table->dropColumn('nama_surat');
                }
            });

            return;
        }

        // If neither table exists, nothing to rollback.
    }
};
