<?php

namespace Database\Seeders;

use App\Enums\UserStatus;
use App\Models\SuperAdmin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = SuperAdmin::create([
            'name' => 'Super Admin',
            'avatar' => null,
            'position' => 'Super Admin',
            'permissions' => [],
        ]);

        $user = User::create([
            'email' => 'superadmin@ruangtes.com',
            'password' => Hash::make('dutaMas26'),
            'password_string' => 'dutaMas26',
            'userable_id' => $superAdmin->id,
            'userable_type' => SuperAdmin::class,
            'status' => UserStatus::ACTIVE,
            'settings' => [],
            'last_login_at' => now(),
            'last_login_ip' => request()->ip(),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ]);

        $user->assignRole('SUPER_ADMIN');
        echo "Super admin seeded successfully\n";
    }
}
