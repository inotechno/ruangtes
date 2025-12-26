<?php

namespace Database\Seeders;

use App\Enums\UserStatus;
use App\Models\PublicUser;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PublicUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $publicUser = PublicUser::create([
            'name' => 'Public User',
            'date_of_birth' => null,
            'gender' => null,
            'phone' => null,
            'address' => null,
            'province_code' => null,
            'regency_code' => null,
            'district_code' => null,
            'village_code' => null,
            'education_level' => null,
            'major' => null,
            'university' => null,
            'graduation_year' => null,
            'current_job' => null,
            'company' => null,
            'bio' => null,
            'avatar' => null,
            'cv_url' => null,
            'preferences' => [],
            'test_history_summary' => [],
            'total_tests_taken' => 0,
            'average_score' => null,
            'last_test_taken_at' => null,
            'is_profile_complete' => false,
            'profile_completed_at' => null,
        ]);

        $user = User::create([
            'email' => 'publicuser@ruangtes.com',
            'password' => Hash::make('password'),
            'userable_id' => $publicUser->id,
            'userable_type' => PublicUser::class,
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

        echo "Public user seeded successfully\n";
    }
}
