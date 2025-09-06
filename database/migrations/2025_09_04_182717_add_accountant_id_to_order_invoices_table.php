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
        Schema::table('order_invoices', function (Blueprint $table) {
            $table->unsignedBigInteger('accountant_id')->nullable()->after('id');

            $table->foreign('accountant_id')
                  ->references('id')
                  ->on('employees')
                  ->onDelete('set null'); // if accountant deleted, keep invoice
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_invoices', function (Blueprint $table) {
            $table->dropForeign(['accountant_id']);
            $table->dropColumn('accountant_id');
        });
    }
};
