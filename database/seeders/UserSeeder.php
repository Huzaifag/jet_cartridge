<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 5 retailers
        User::factory()->count(5)->create([
            'role' => 'retailer',
        ]);

        // Create 10 end users
        User::factory()->count(10)->create([
            'role' => 'end_user',
        ]);
    }
}
