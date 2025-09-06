<?php

namespace Database\Seeders;

use App\Models\Lead;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        Lead::create([
            'customer_id' => 1,
            'product_id'  => 1,
            'seller_id'   => 1,
            'message'     => 'Interested in bulk order, please share price details.',
            'status'      => 'new',
        ]);

        Lead::create([
            'customer_id' => 2,
            'product_id'  => 1,
            'seller_id'   => 1,
            'message'     => 'Customer asked for discount offer.',
            'status'      => 'contacted',
        ]);

        Lead::create([
            'customer_id' => 3,
            'product_id'  => 2,
            'seller_id'   => 1,
            'message'     => 'Converted after negotiation.',
            'status'      => 'converted',
        ]);

        Lead::create([
            'customer_id' => 4,
            'product_id'  => 3,
            'seller_id'   => 1,
            'message'     => 'Customer lost interest.',
            'status'      => 'lost',
        ]);
    }
}
