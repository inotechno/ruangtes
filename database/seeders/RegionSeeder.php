<?php

namespace Database\Seeders;

use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //  Insert data from wilayah.sql
        $sql = file_get_contents(database_path('wilayah.sql'));
        // $sql = str_replace('utf8mb4', 'utf8', $sql);
        // $sql = str_replace('utf8mb4_unicode_ci', 'utf8_unicode_ci', $sql);
        // $sql = str_replace('utf8mb4_general_ci', 'utf8_general_ci', $sql);
        // $sql = str_replace('utf8mb4_unicode_520_ci', 'utf8_unicode_520_ci', $sql);
        // $sql = str_replace('utf8mb4_unicode_520_ci', 'utf8_unicode_520_ci', $sql);
        // $sql = str_replace('latin1', 'utf8', $sql);
        DB::unprepared($sql);
        echo "Region data seeded successfully\n";

        
        // Untuk optimasi, cache tiap response per step, lalu batch insert per level untuk mengurangi query dan menahan re-request API yang sama.
        // $provinceResponse = Cache::store('redis')->remember(
        //     'wilayah_provinces',
        //     now()->addDay(),
        //     fn () => Http::get('https://wilayah.id/api/provinces.json')->json('data')
        // );

        // $provinceData = [];
        // $regencyData = [];
        // $districtData = [];
        // $villageData = [];

        // foreach ($provinceResponse as $province) {
        //     $provinceData[] = [
        //         'code' => $province['code'],
        //         'name' => $province['name'],
        //     ];

        //     $regencies = Cache::store('redis')->remember("wilayah_regencies_{$province['code']}", now()->addDay(), function () use ($province) {
        //         return Http::get("https://wilayah.id/api/regencies/{$province['code']}.json")->json('data');
        //     });

        //     // INFO saat seeding, print the response
        //     echo "Regencies: Seeding {$province['name']} - {$province['code']}\n";

        //     foreach ($regencies as $regency) {
        //         $regencyData[] = [
        //             'code' => $regency['code'],
        //             'name' => $regency['name'],
        //             'province_code' => $province['code'],
        //         ];

        //         $districts = Cache::store('redis')->remember("wilayah_districts_{$regency['code']}", now()->addDay(), function () use ($regency) {
        //             return Http::get("https://wilayah.id/api/districts/{$regency['code']}.json")->json('data');
        //         });

        //         // INFO saat seeding, print the response
        //         echo "Districts: Seeding {$regency['name']} - {$regency['code']}\n";

        //         foreach ($districts as $district) {
        //             $districtData[] = [
        //                 'code' => $district['code'],
        //                 'name' => $district['name'],
        //                 'regency_code' => $regency['code'],
        //             ];

        //             $villages = Cache::store('redis')->remember("wilayah_villages_{$district['code']}", now()->addDay(), function () use ($district) {
        //                 return Http::get("https://wilayah.id/api/villages/{$district['code']}.json")->json('data');
        //             });

        //             foreach ($villages as $village) {
        //                 $villageData[] = [
        //                     'code' => $village['code'],
        //                     'name' => $village['name'],
        //                     'district_code' => $district['code'],
        //                 ];

        //                 // INFO saat seeding, print the response
        //                 echo "Villages: Seeding {$district['name']} - {$district['code']}\n";
        //             }
        //         }
        //     }
        // }

        // // Insert menggunakan chunk agar memory tidak over kalau entry besar
        // foreach (array_chunk($provinceData, 100) as $chunk) {
        //     Province::insert($chunk);
        // }
        // foreach (array_chunk($regencyData, 500) as $chunk) {
        //     Regency::insert($chunk);
        // }
        // foreach (array_chunk($districtData, 1000) as $chunk) {
        //     District::insert($chunk);
        // }
        // foreach (array_chunk($villageData, 2000) as $chunk) {
        //     Village::insert($chunk);
        // }
    }
}
