<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seller  = Seller::first();
        $customers = User::role('end_user')->get();

        if ($seller->count() == 0 || $customers->count() == 0) {
            $this->command->warn('No sellers or customers found. Run UserSeeder first.');
            return;
        }

        // create 10 random orders
        for ($i = 0; $i < 10; $i++) {
            Order::create([
                'seller_id'        => $seller->id,
                'customer_id'      => $customers->random()->id,
                'total'            => rand(500, 5000),
                'status'           => fake()->randomElement(['pending', 'processing', 'completed']),
                'payment_status'   => fake()->randomElement(['pending', 'paid']),
                'payment_method'   => fake()->randomElement(['COD', 'Bank Transfer', 'Stripe']),
                'shipping_address' => fake()->address(),
                'billing_address'  => fake()->address(),
                'notes'            => fake()->sentence(),
            ]);
        }
    }
}
