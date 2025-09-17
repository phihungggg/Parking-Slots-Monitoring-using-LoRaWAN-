<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Jobs\DoMqttsubscribe;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DoMqttsubscribe::dispatch();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
