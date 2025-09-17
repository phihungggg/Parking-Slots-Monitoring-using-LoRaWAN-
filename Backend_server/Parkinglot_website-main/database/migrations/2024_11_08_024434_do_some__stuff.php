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
        Schema::table('reservations1', function (Blueprint $table) {
            // Drop existing foreign key constraints
            $table->dropForeign(['user_id']);
            $table->dropForeign(['Slot_id']);

            // Add foreign key constraints with cascade delete
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('Slot_id')->references('slot_id')->on('slots1')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
