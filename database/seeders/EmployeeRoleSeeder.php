<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class EmployeeRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create roles if they don't exist
        $roles = [
            'Accountant',
            'Warehouse',
            'Delivery_boy',
            'Sales Manager',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['name' => $role, 'guard_name' => 'employee']
            );
        }

        // Assign role to each employee based on position column
        $employees = Employee::all();

        foreach ($employees as $employee) {
            if ($employee->position) {
                $employee->syncRoles([$employee->position]);
            }
        }
    }
}
