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
        Schema::create('slot_occupied', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedInteger('slot_id');
            $table->foreign('slot_id')->references('slot_id')->on('slots1')->onDelete('cascade');

            

            $table->timestamps();
            $table->timestamp('Come_at')->nullable();
            $table->timestamp('Leave_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slot_occupied');
    }
};
