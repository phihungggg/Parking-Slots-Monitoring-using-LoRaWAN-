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
        Schema::create('slots1', function (Blueprint $table) {
           
            $table->unsignedInteger('slot_id');
            $table->timestamps();
            $table->string('slot_name');
            $table->unsignedInteger('slot_status');
            $table->float('slot_lat');
            $table->float('slot_long');
            $table->primary(['slot_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slots1');
    }
};
