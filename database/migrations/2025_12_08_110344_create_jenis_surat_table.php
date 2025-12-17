<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('jenis_surat2', function (Blueprint $table) {
        $table->id();
        $table->string('nama_surat');    // contoh: Surat Domisili, SKTM, dsb
        $table->text('deskripsi')->nullable(); 
        $table->text('syarat')->nullable(); 
        $table->timestamps();
    });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_surat');
    }
};
