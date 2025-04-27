<?php

use App\Enums\OrderStatus;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->constrained('users');
            $table->enum('status',OrderStatus::getStatus())->default('pending');
            $table->foreignId('address_id')->constrained('addresses');
            $table->foreignId('payment_method_id')->constrained('payment_methods');
            $table->foreignId('delivery_boy_id')->nullable()->constrained('delivery_boys');
            $table->foreignId('vehicle_id')->nullable()->constrained('vehicles');
            $table->decimal('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
