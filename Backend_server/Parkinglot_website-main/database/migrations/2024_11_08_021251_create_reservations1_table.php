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
        Schema::create('reservations1', function (Blueprint $table) {
            $table->unsignedInteger('Slot_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger( 'Reservation_id');
            $table->timestamp('Reservation_time');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('Slot_id')->references('slot_id')->on('slots1'); // Updated to `slot_id`
            $table->primary(['Reservation_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations1');
    }
};
