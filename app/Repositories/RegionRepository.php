<?php

namespace App\Repositories;

use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;

class RegionRepository
{
    /**
     * Get all provinces.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getProvinces(): \Illuminate\Database\Eloquent\Collection
    {
        return Province::all();
    }

    /**
     * Get regencies by province code.
     *
     * @param string $provinceCode
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRegenciesByProvince(string $provinceCode): \Illuminate\Database\Eloquent\Collection
    {
        return Regency::where('province_code', $provinceCode)->get();
    }

    /**
     * Get districts by regency code.
     *
     * @param string $regencyCode
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDistrictsByRegency(string $regencyCode): \Illuminate\Database\Eloquent\Collection
    {
        return District::where('regency_code', $regencyCode)->get();
    }

    /**
     * Get villages by district code.
     *
     * @param string $districtCode
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getVillagesByDistrict(string $districtCode): \Illuminate\Database\Eloquent\Collection
    {
        return Village::where('district_code', $districtCode)->get();
    }

    /**
     * Get all regions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllRegions(): \Illuminate\Database\Eloquent\Collection
    {
        return Province::with('regencies')->get();
    }
}
