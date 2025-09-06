<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('delivery_boys', function (Blueprint $table) {
            $table->string('previous_company')->nullable();
            $table->string('previous_position')->nullable();
            $table->date('previous_employment_start')->nullable();
            $table->date('previous_employment_end')->nullable();
            $table->text('work_experience')->nullable();
            $table->integer('years_of_experience')->nullable();
            $table->string('vehicle_type')->nullable();
            $table->string('license_number')->nullable();
            $table->date('license_expiry')->nullable();
        });
    }

    public function down()
    {
        Schema::table('delivery_boys', function (Blueprint $table) {
            $table->dropColumn([
                'previous_company',
                'previous_position',
                'previous_employment_start',
                'previous_employment_end',
                'work_experience',
                'years_of_experience',
                'vehicle_type',
                'license_number',
                'license_expiry'
            ]);
        });
    }
};
