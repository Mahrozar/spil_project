<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class FixReportsCoordinatesPrecision extends Migration
{
    public function up()
    {
        // Untuk MySQL/MariaDB
        if (DB::connection()->getDriverName() == 'mysql') {
            if (Schema::hasColumn('reports', 'latitude')) {
                DB::statement('ALTER TABLE reports MODIFY latitude DECIMAL(10, 8)');
            }
            if (Schema::hasColumn('reports', 'longitude')) {
                DB::statement('ALTER TABLE reports MODIFY longitude DECIMAL(11, 8)');
            }
        }
        // Untuk PostgreSQL
        elseif (DB::connection()->getDriverName() == 'pgsql') {
            if (Schema::hasColumn('reports', 'latitude')) {
                DB::statement('ALTER TABLE reports ALTER COLUMN latitude TYPE DECIMAL(10, 8)');
            }
            if (Schema::hasColumn('reports', 'longitude')) {
                DB::statement('ALTER TABLE reports ALTER COLUMN longitude TYPE DECIMAL(11, 8)');
            }
        }
        // Untuk SQLite (tidak support ALTER untuk tipe data)
        elseif (DB::connection()->getDriverName() == 'sqlite') {
            // SQLite tidak bisa mengubah tipe kolom secara langsung
            // Perlu recreate table
        }
    }

    public function down()
    {
        if (DB::connection()->getDriverName() == 'mysql') {
            if (Schema::hasColumn('reports', 'latitude')) {
                DB::statement('ALTER TABLE reports MODIFY latitude DECIMAL(9, 6)');
            }
            if (Schema::hasColumn('reports', 'longitude')) {
                DB::statement('ALTER TABLE reports MODIFY longitude DECIMAL(9, 6)');
            }
        }
        // ... down untuk database lain
    }
}