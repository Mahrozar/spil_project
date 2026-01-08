<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('image_path'); // Path gambar
            $table->enum('type', ['photo', 'video'])->default('photo'); // Tipe: foto atau video
            $table->string('video_url')->nullable(); // URL video jika tipe video
            $table->integer('order')->default(0); // Urutan tampilan
            $table->boolean('is_active')->default(true); // Status aktif/tidak
            $table->string('category')->nullable(); // Kategori (misal: kegiatan, potensi, dll)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};