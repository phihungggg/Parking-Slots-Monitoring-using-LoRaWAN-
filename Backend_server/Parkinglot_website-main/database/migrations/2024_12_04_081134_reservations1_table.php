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
            $table->dropPrimary(['Reservation_id']); // Bỏ khóa chính cũ
            $table->dropColumn('Reservation_id');

            $table->id('Reservation_id')->first();
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
