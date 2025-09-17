<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;



return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('slots1', function (Blueprint $table) {
            //
        });

        DB::table('slots1')->insert([
            'slot_id' => 0,
            'slot_name' => '3 thang 2',
            'slot_status' => 1,
            'slot_lat' => 10.763723871833784,
            'slot_long'=> 106.65976955431256,
        ]);

        DB::table('slots1')->insert([
            'slot_id' => 1,
            'slot_name' => 'Ly Thuong Kiet',
            'slot_status' => 1,
            'slot_lat' => 10.761078620733292,
            'slot_long'=> 106.66060917741723,
        ]);
        DB::table('slots1')->insert([
            'slot_id' => 2,
            'slot_name' => 'Nguyen Kim',
            'slot_status' => 1,
            'slot_lat' => 10.762378881477494,
            'slot_long'=> 106.66195345162645,
        ]);
        DB::table('slots1')->insert([
            'slot_id' => 3,
            'slot_name' => 'Le Dai Hanh',
            'slot_status' => 1,
            'slot_lat' => 10.766211203146504,
            'slot_long'=> 106.6543467857687,
        ]);
        DB::table('slots1')->insert([
            'slot_id' => 4,
            'slot_name' => 'Lu Gia',
            'slot_status' => 1,
            'slot_lat' => 10.770669889748305,
            'slot_long'=> 106.65629512277314,
        ]);
        DB::table('slots1')->insert([
            'slot_id' => 5,
            'slot_name' => 'To Hien Thanh',
            'slot_status' => 1,
            'slot_lat' => 10.774398028512875,
            'slot_long'=> 106.66200563634163,
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('slot', function (Blueprint $table) {
            //
        });
    }
};
