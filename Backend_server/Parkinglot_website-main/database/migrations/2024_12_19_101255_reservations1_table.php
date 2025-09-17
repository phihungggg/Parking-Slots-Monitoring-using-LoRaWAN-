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
            // Thêm cột 'id' tự động tăng
            

            // Xóa cột 'Reservation_id' (nếu không cần dùng nữa)
          
            $table->timestamp('Expiration_Time')->nullable();;
           
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
