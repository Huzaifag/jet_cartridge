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
        Schema::table('orders', function (Blueprint $table) {
            // New fields
            $table->timestamp('assigned_to_delivery_at')->nullable()->after('delivery_person_id');
            $table->date('estimated_delivery_date')->nullable()->after('assigned_to_delivery_at');
            $table->text('delivery_notes')->nullable()->after('estimated_delivery_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('assigned_to_delivery_at');
            $table->dropColumn('estimated_delivery_date');
            $table->dropColumn('delivery_notes');
        });
    }
};
