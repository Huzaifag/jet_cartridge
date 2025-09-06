<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Add fields to account_persons table
        Schema::table('account_persons', function (Blueprint $table) {
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('profile_picture')->nullable();
            $table->text('bio')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->boolean('is_profile_completed')->default(false);
        });

        // Add fields to employees table
        Schema::table('employees', function (Blueprint $table) {
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('profile_picture')->nullable();
            $table->text('bio')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('department')->nullable();
            $table->string('designation')->nullable();
            $table->date('joining_date')->nullable();
            $table->boolean('is_profile_completed')->default(false);
        });

        // Add fields to delivery_boys table
        Schema::table('delivery_boys', function (Blueprint $table) {
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('profile_picture')->nullable();
            $table->text('bio')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('vehicle_type')->nullable();
            $table->string('vehicle_number')->nullable();
            $table->string('license_number')->nullable();
            $table->boolean('is_profile_completed')->default(false);
        });
    }

    public function down()
    {
        // Remove fields from account_persons table
        Schema::table('account_persons', function (Blueprint $table) {
            $table->dropColumn([
                'address', 'city', 'state', 'postal_code', 'country',
                'date_of_birth', 'gender', 'profile_picture', 'bio',
                'emergency_contact', 'is_profile_completed'
            ]);
        });

        // Remove fields from employees table
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn([
                'address', 'city', 'state', 'postal_code', 'country',
                'date_of_birth', 'gender', 'profile_picture', 'bio',
                'emergency_contact', 'department', 'designation',
                'joining_date', 'is_profile_completed'
            ]);
        });

        // Remove fields from delivery_boys table
        Schema::table('delivery_boys', function (Blueprint $table) {
            $table->dropColumn([
                'address', 'city', 'state', 'postal_code', 'country',
                'date_of_birth', 'gender', 'profile_picture', 'bio',
                'emergency_contact', 'vehicle_type', 'vehicle_number',
                'license_number', 'is_profile_completed'
            ]);
        });
    }
}; 