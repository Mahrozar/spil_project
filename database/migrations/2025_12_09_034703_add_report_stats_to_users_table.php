<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Untuk petugas/admin
            $table->integer('assigned_reports_count')->default(0);
            $table->integer('completed_reports_count')->default(0);
            $table->integer('pending_reports_count')->default(0);
            $table->string('phone')->nullable(); // untuk notifikasi
            $table->boolean('can_manage_reports')->default(false);
            $table->boolean('can_assign_reports')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'assigned_reports_count',
                'completed_reports_count',
                'pending_reports_count',
                'phone',
                'can_manage_reports',
                'can_assign_reports'
            ]);
        });
    }
};