<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('account_persons', function (Blueprint $table) {
            if (!Schema::hasColumn('account_persons', 'date_of_birth')) {
                $table->date('date_of_birth')->nullable();
            }
            if (!Schema::hasColumn('account_persons', 'gender')) {
                $table->string('gender')->nullable();
            }
            if (!Schema::hasColumn('account_persons', 'phone')) {
                $table->string('phone')->nullable();
            }
            if (!Schema::hasColumn('account_persons', 'address')) {
                $table->text('address')->nullable();
            }
            if (!Schema::hasColumn('account_persons', 'city')) {
                $table->string('city')->nullable();
            }
            if (!Schema::hasColumn('account_persons', 'state')) {
                $table->string('state')->nullable();
            }
            if (!Schema::hasColumn('account_persons', 'postal_code')) {
                $table->string('postal_code')->nullable();
            }
            if (!Schema::hasColumn('account_persons', 'country')) {
                $table->string('country')->nullable();
            }
            if (!Schema::hasColumn('account_persons', 'profile_picture')) {
                $table->string('profile_picture')->nullable();
            }
            if (!Schema::hasColumn('account_persons', 'bio')) {
                $table->text('bio')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('account_persons', function (Blueprint $table) {
            $table->dropColumn([
                'date_of_birth',
                'gender',
                'phone',
                'address',
                'city',
                'state',
                'postal_code',
                'country',
                'profile_picture',
                'bio'
            ]);
        });
    }
}; 