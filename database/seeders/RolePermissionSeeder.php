<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'SUPER_ADMIN',
            'COMPANY_ADMIN',
            'PUBLIC_USER',
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        echo "Roles and permissions seeded successfully\n";
    }
}
