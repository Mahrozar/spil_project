<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('report_status_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained()->onDelete('cascade');
            $table->enum('old_status', [
                'submitted',
                'verified',
                'in_progress',
                'completed',
                'rejected',
                'closed'
            ])->nullable();
            $table->enum('new_status', [
                'submitted',
                'verified',
                'in_progress',
                'completed',
                'rejected',
                'closed'
            ]);
            $table->foreignId('changed_by')->nullable()->constrained('users');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('report_status_history');
    }
};