<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\RegionSeeder;
use Database\Seeders\CompanySeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RegionSeeder::class,
            SuperAdminSeeder::class,
            PublicUserSeeder::class,
            CompanySeeder::class,
        ]);
    }
}
