<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('report_code')->unique();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            
            // Facility Information
            $table->enum('facility_category', [
                'jalan_jembatan',
                'penerangan_umum',
                'fasilitas_air',
                'fasilitas_publik',
                'fasilitas_kesehatan',
                'fasilitas_pendidikan',
                'lainnya'
            ]);
            
            $table->enum('facility_type', [
                'jalan_rusak',
                'jalan_berlubang',
                'jembatan_rusak',
                'drainase_tersumbat',
                'trotoar_rusak',
                'lampu_jalan_mati',
                'lampu_rusak',
                'tiang_lampu_miring',
                'keran_umum_rusak',
                'pipa_bocor',
                'salunar_air_tersumbat',
                'pos_kamling_rusak',
                'balai_desa_rusak',
                'taman_rusak',
                'lapangan_rusak',
                'puskesdes_rusak',
                'posyandu_rusak',
                'sekolah_rusak',
                'taman_baca_rusak',
                'lainnya'
            ]);
            
            // Location Information - SIMPLE VERSION
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 10, 8);
            $table->string('address')->nullable();
            $table->string('dusun')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            
            // Reporter Information
            $table->string('reporter_name')->nullable();
            $table->string('reporter_phone')->nullable();
            $table->string('reporter_email')->nullable();
            $table->boolean('is_anonymous')->default(false);
            
            // Report Status
            $table->enum('status', [
                'submitted',
                'verified',
                'in_progress',
                'completed',
                'rejected',
                'closed'
            ])->default('submitted');
            
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            
            // Assignment
            $table->foreignId('assigned_to')->nullable()->constrained('users');
            $table->date('due_date')->nullable();
            
            // Metadata
            $table->ipAddress('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->boolean('is_public')->default(true);
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes - SIMPLE VERSION (tanpa spatial index)
            $table->index(['status', 'priority']);
            $table->index(['facility_category', 'facility_type']);
            $table->index(['latitude', 'longitude']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};