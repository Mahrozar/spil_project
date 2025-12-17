<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('residents', function (Blueprint $table) {
            $table->boolean('is_head')->default(false)->after('kk_number');
        });
    }

    public function down()
    {
        Schema::table('residents', function (Blueprint $table) {
            $table->dropColumn('is_head');
        });
    }
};
