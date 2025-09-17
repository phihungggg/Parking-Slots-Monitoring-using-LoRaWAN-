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
        Schema::table('vehicles', function (Blueprint $table) {

            $table->string('license_plate')->unique();
        
            $table->enum('Vehicle_type', ['Car','Truck','Bus' ,'Motorcycle']);
            $table->string( 'Owner_name');
            $table->string( 'Owner_identify_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            //
        });
    }
};
