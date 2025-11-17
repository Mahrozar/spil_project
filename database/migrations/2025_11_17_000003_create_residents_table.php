<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->nullable()->unique();
            $table->string('name');
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('kk_number')->nullable();
            $table->foreignId('rt_id')->nullable()->constrained('rts')->onDelete('set null');
            $table->foreignId('rw_id')->nullable()->constrained('rws')->onDelete('set null');
            $table->string('occupation')->nullable();
            $table->string('education')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('source_import')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
