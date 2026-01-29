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
        Schema::table('rws', function (Blueprint $table) {
            $table->string('ketua_rw')->nullable()->after('name');
            $table->string('no_hp_ketua_rw', 20)->nullable()->after('ketua_rw');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rws', function (Blueprint $table) {
            $table->dropColumn(['ketua_rw', 'no_hp_ketua_rw']);
        });
    }
};