<?php

namespace App\Services;

use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Illuminate\Database\Eloquent\Collection;

class RegionService
{
    /**
     * Get all provinces.
     *
     * @return Collection
     */
    public function getProvinces(): Collection
    {
        return Province::select('code', 'name')->get();
    }

    /**
     * Get province by code.
     *
     * @param string $provinceCode
     * @return Province|null
     */
    public function getProvinceByCode(string $provinceCode): ?Province
    {
        return Province::where('code', $provinceCode)->first();
    }

    /**
     * Get all regencies.
     *
     * @return Collection
     */
    public function getRegencies(): Collection
    {
        return Regency::select('code', 'name', 'province_code')->get();
    }

    /**
     * Get regencies by province code.
     *
     * @param string $provinceCode
     * @return Collection
     */
    public function getRegenciesByProvince(string $provinceCode): Collection
    {
        return Regency::where('province_code', $provinceCode)->select('code', 'name', 'province_code')->get();
    }

    /**
     * Get regency by code.
     *
     * @param string $regencyCode
     * @return Regency|null
     */
    public function getRegencyByCode(string $regencyCode): ?Regency
    {
        return Regency::where('code', $regencyCode)->select('code', 'name', 'province_code')->first();
    }

    /**
     * Get all districts.
     *
     * @return Collection
     */
    public function getDistricts(): Collection
    {
        return District::select('code', 'name', 'regency_code')->get();
    }

    /**
     * Get districts by regency code.
     *
     * @param string $regencyCode
     * @return Collection
     */
    public function getDistrictsByRegency(string $regencyCode): Collection
    {
        return District::where('regency_code', $regencyCode)->select('code', 'name', 'regency_code')->get();
    }

    /**
     * Get district by code.
     *
     * @param string $districtCode
     * @return District|null
     */
    public function getDistrictByCode(string $districtCode): ?District
    {
        return District::where('code', $districtCode)->select('code', 'name', 'regency_code')->first();
    }

    /**
     * Get all villages.
     *
     * @return Collection
     */
    public function getVillages(): Collection
    {
        return Village::select('code', 'name', 'district_code')->get();
    }

    /**
     * Get villages by district code.
     *
     * @param string $districtCode
     * @return Collection
     */
    public function getVillagesByDistrict(string $districtCode): Collection
    {
        return Village::where('district_code', $districtCode)->select('code', 'name', 'district_code')->get();
    }

    /**
     * Get village by code.
     *
     * @param string $villageCode
     * @return Village|null
     */
    public function getVillageByCode(string $villageCode): ?Village
    {
        return Village::where('code', $villageCode)->select('code', 'name', 'district_code')->first();
    }

    /**
     * Get all regions (province, regency, district, village) in hierarchical structure.
     *
     * @return Collection
     */
    public function getAllRegionsHierarchy(): Collection
    {
        return Province::with([
            'regencies.districts.villages'
        ])->get();
    }
}
