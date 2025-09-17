<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('maps1', function (Blueprint $table) {
             $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->float('current_latitude');
            $table->float('current_longtitude');
            $table->float('destination_latitude');
            $table->float('destination_longtitude');
            $table->foreign('user_id')->references('id')->on('users');
            //$table->primary(['user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maps1');
    }
};
