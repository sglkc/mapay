<?php

use App\Models\User;
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
            $table->foreignIdFor(User::class, 'source_user_id');
            $table->foreignIdFor(User::class, 'target_user_id');
            $table->decimal('spending', 12, 2);
            $table->ipAddress('ip_address');
            $table->decimal('latitude', 7, 4);
            $table->decimal('longitude', 7, 4);
            $table->timestamp('created_at')->useCurrent();
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
