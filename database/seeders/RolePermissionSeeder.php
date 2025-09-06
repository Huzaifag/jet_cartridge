<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Permission as ModelsPermission;
use Spatie\Permission\Models\Role as ModelsRole;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $buyProducts   = ModelsPermission::firstOrCreate(['name' => 'buy_products']);
        $sendInquiry   = ModelsPermission::firstOrCreate(['name' => 'send_inquiry']);

        // Create roles
        $manufacturer  = ModelsRole::firstOrCreate(['name' => 'manufacturer']);
        $dealer        = ModelsRole::firstOrCreate(['name' => 'dealer']);
        $retailer      = ModelsRole::firstOrCreate(['name' => 'retailer']);
        $endUser       = ModelsRole::firstOrCreate(['name' => 'end_user']);

        // Assign permissions to roles
        $manufacturer->givePermissionTo($sendInquiry);
        $dealer->givePermissionTo($sendInquiry);

        $retailer->givePermissionTo($buyProducts);
        $endUser->givePermissionTo($buyProducts);
    }
}
