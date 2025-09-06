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
        Schema::create('order_deliveries', function (Blueprint $table) {
            $table->id();

            // Relations
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('customer_id');

            // Delivery details
            $table->date('delivery_date')->nullable();
            $table->time('delivery_time')->nullable();
            $table->string('proof_of_delivery')->nullable(); // file path
            $table->text('delivery_notes')->nullable();

            $table->timestamps();

            // Foreign keys
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_deliveries');
    }
};
