<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('households', function (Blueprint $table) {
            $table->id();
            $table->string('kk_number')->unique();
            $table->unsignedBigInteger('head_id')->nullable();
            $table->timestamps();
        });

        Schema::table('residents', function (Blueprint $table) {
            $table->unsignedBigInteger('household_id')->nullable()->after('kk_number');
            $table->foreign('household_id')->references('id')->on('households')->onDelete('set null');
        });

        // Populate households from existing distinct kk_number values
        $rows = DB::table('residents')
            ->select('kk_number')
            ->whereNotNull('kk_number')
            ->groupBy('kk_number')
            ->get();

        foreach ($rows as $row) {
            $kk = $row->kk_number;
            if (empty($kk)) continue;

            // create household record
            $hid = DB::table('households')->insertGetId([
                'kk_number' => $kk,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // set household_id on residents
            DB::table('residents')->where('kk_number', $kk)->update(['household_id' => $hid]);

            // set head_id if any resident has is_head = true
            $head = DB::table('residents')->where('kk_number', $kk)->where('is_head', true)->first();
            if ($head) {
                DB::table('households')->where('id', $hid)->update(['head_id' => $head->id]);
            }
        }
    }

    public function down()
    {
        Schema::table('residents', function (Blueprint $table) {
            $table->dropForeign(['household_id']);
            $table->dropColumn('household_id');
        });

        Schema::dropIfExists('households');
    }
};
