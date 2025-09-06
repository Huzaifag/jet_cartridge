<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Seller;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class BulkOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
        public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles if they don't exist
        $retailerRole = Role::firstOrCreate(['name' => 'retailer']);
        // Create some products
        $products = [];
        $productNames = [
            'Ink Cartridge Black', 'Ink Cartridge Color', 'Toner Cartridge', 'Photo Paper', 'Printer Maintenance Kit',
            'Laser Toner Black', 'Laser Toner Color', 'Ink Refill Kit', 'Printer Cleaning Sheets', 'Printer Head'
        ];

        // Create seller
        $seller = Seller::first();

        
        // Create retailer users with retailer role
        $retailer1 = User::create([
            'name' => 'Retailer One',
            'email' => 'retailer10@example.com',
            'password' => bcrypt('password'),
        ]);
        $retailer1->assignRole($retailerRole);

        $retailer2 = User::create([
            'name' => 'Retailer Two',
            'email' => 'retailer20@example.com',
            'password' => bcrypt('password'),
            
        ]);
        $retailer2->assignRole($retailerRole);

        foreach ($productNames as $index => $name) {
            $products[] = \App\Models\Product::create([
                'seller_id' => $seller->id,
                'name' => $name,
                'description' => 'High quality ' . $name . ' for all major printer brands',
                'price' => rand(500, 2000),
                'moq' => rand(1, 5),
                'stock_quantity' => rand(50, 200),
                'category' => 'Printer Supplies',
                'brand' => ['HP', 'Canon', 'Epson', 'Brother', 'Xerox'][$index % 5],
                'model' => 'MOD-' . strtoupper(substr($name, 0, 3)) . '-' . rand(1000, 9999),
                'specifications' => json_encode([
                    'color' => explode(' ', $name)[count(explode(' ', $name)) - 1],
                    'compatibility' => 'Works with most ' . ['HP', 'Canon', 'Epson', 'Brother', 'Xerox'][$index % 5] . ' printers',
                    'yield' => rand(1000, 5000) . ' pages',
                ]),
                'images' => json_encode(['products/sample-product.jpg']),
                'status' => 'active',
                'is_featured' => $index < 3,
                'rating' => rand(30, 50) / 10,
                
            ]);
        }

        // Create a normal order (not bulk)
        $order1 = Order::create([
            'seller_id' => $seller->id,
            'customer_id' => $retailer1->id,
            'total' => 500,
            'status' => 'pending',
            'is_bulk' => 0,
            'payment_status' => 'pending',
            'payment_method' => 'cash',
            'shipping_address' => json_encode([
                'street' => '123 Street',
                'city' => 'City',
                'state' => 'State',
                'postal_code' => '12345',
                'country' => 'Country'
            ]),
            'billing_address' => json_encode([
                'street' => '123 Street',
                'city' => 'City',
                'state' => 'State',
                'postal_code' => '12345',
                'country' => 'Country'
            ]),
            'notes' => 'Normal order',
        ]);

        OrderItem::create([
            'order_id' => $order1->id,
            'product_id' => 1,
            'quantity' => 2,
            'price' => 250,
        ]);

        // Create a bulk order (≥20 items total)
        $order2 = Order::create([
            'seller_id' => $seller->id,
            'customer_id' => $retailer1->id,
            'total' => 2000,
            'status' => 'pending',
            'is_bulk' => 1, // mark as bulk
            'payment_status' => 'pending',
            'payment_method' => 'bank transfer',
            'shipping_address' => json_encode([
                'street' => '456 Avenue',
                'city' => 'Town',
                'state' => 'State',
                'postal_code' => '12345',
                'country' => 'Country'
            ]),
            'billing_address' => json_encode([
                'street' => '456 Avenue',
                'city' => 'Town',
                'state' => 'State',
                'postal_code' => '12345',
                'country' => 'Country'
            ]),
            'notes' => 'Bulk order',
        ]);

        // Add 9 order items to this order
        for ($i = 1; $i <= 9; $i++) {
            OrderItem::create([
                'order_id' => $order2->id,
                'product_id' => $products[$i % count($products)]->id,
                'quantity' => 1,
                'price' => 100,
            ]);
        }

        // Another bulk order (single product but high quantity)
        $order3 = Order::create([
            'seller_id' => $seller->id,
            'customer_id' => $retailer2->id,
            'total' => 5000,
            'status' => 'pending',
            'is_bulk' => 1,
            'payment_status' => 'paid',
            'payment_method' => 'credit card',
            'shipping_address' => json_encode([
                'street' => '789 Blvd',
                'city' => 'City',
                'state' => 'State',
                'postal_code' => '12345',
                'country' => 'Country'
            ]),
            'billing_address' => json_encode([
                'street' => '789 Blvd',
                'city' => 'City',
                'state' => 'State',
                'postal_code' => '12345',
                'country' => 'Country'
            ]),
            'notes' => 'High quantity bulk order',
        ]);

        OrderItem::create([
            'order_id' => $order3->id,
            'product_id' => $products[6]->id,
            'quantity' => 25, // high quantity
            'price' => 200,
        ]);
    }
    
}
