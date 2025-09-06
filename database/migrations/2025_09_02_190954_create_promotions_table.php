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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_id');
            $table->string('title');
            $table->text('description')->nullable();

            // Discount fields
            $table->enum('discount_type', ['percentage', 'fixed', 'bogo'])->nullable();
            $table->decimal('percentage_off', 5, 2)->nullable(); // e.g. 15.00 for 15%
            $table->decimal('fixed_amount', 10, 2)->nullable();

            // BOGO details
            $table->unsignedInteger('buy_x')->nullable();
            $table->unsignedInteger('get_y')->nullable();
            $table->enum('bogo_type', ['free', 'percentOff'])->nullable();

            // Schedule
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();

            // Status
            $table->enum('status', ['active', 'draft', 'ended'])->default('draft');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
