<?php

namespace Database\Seeders;

use App\Enums\AdminRole;
use App\Enums\CompanyStatus;
use App\Enums\SubscriptionType;
use App\Enums\UserStatus;
use App\Models\Company;
use App\Models\CompanyAdmin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = Company::create([
            'id' => Str::uuid(),
            'code' => Str::random(10),
            'name' => 'Company',
            'email' => 'company@ruangtes.com',
            'subscription_type' => SubscriptionType::PREPAID,
            'subscription_end' => now()->addYear(),
            'max_participants' => 100,
            'current_participants' => 0,
            'billing_name' => 'Company',
            'billing_email' => 'company@ruangtes.com',
            'billing_address' => 'Company Address',
            'tax_id' => '1234567890',
            'status' => CompanyStatus::ACTIVE,
            'is_verified' => true,
        ]);

        $companyAdmin = CompanyAdmin::create([
            'company_id' => $company->id,
            'name' => 'Company Admin',
            'position' => 'Company Admin',
            'department' => 'Company Department',
            'employee_id' => '1234567890',
            'phone' => '081234567890',
            'avatar' => null,
            'role' => AdminRole::ADMIN,
            'permissions' => [],
        ]);

        $user = User::create([
            'email' => 'companyadmin@ruangtes.com',
            'password' => Hash::make('password'),
            'userable_id' => $companyAdmin->id,
            'userable_type' => CompanyAdmin::class,
            'status' => UserStatus::ACTIVE,
            'email_verified_at' => now(),
            'phone' => null,
            'activation_token' => null,
            'settings' => [],
            'last_login_at' => now(),
            'last_login_ip' => request()->ip(),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ]);

        $user->assignRole('COMPANY_ADMIN');
        echo "Company seeded successfully\n";
    }
}
