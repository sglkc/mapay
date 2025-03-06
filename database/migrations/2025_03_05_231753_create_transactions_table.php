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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->decimal('spending', 12, 2);
            $table->unsignedInteger('ip');
            $table->string('city');
            $table->string('state');
            $table->decimal('lat', 8, 5);
            $table->decimal('long', 8, 5);
            $table->timestamp('created-at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
