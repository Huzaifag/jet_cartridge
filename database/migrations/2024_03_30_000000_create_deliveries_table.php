<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delivery_boy_id')->constrained()->onDelete('cascade');
            $table->string('order_id');
            $table->string('customer_name');
            $table->text('delivery_address');
            $table->enum('status', ['pending', 'picked_up', 'in_transit', 'delivered', 'cancelled'])->default('pending');
            $table->string('pickup_location');
            $table->dateTime('delivery_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
}; 