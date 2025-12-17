<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('letter_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('submission_number')->unique();
            $table->string('jenis_surat');
            $table->string('nama');
            $table->string('nik', 16);
            $table->text('alamat');
            $table->text('keperluan');
            $table->string('telepon');
            $table->string('email')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('letter_submissions');
    }
};
