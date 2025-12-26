<?php

namespace App\Services;

use App\Repositories\RegionRepository;

class RegionService
{
    protected $regionRepository;

    /**
     * Create a new class instance.
     */
    public function __construct(RegionRepository $regionRepository)
    {
        $this->regionRepository = $regionRepository;
    }

    /**
     * Get all provinces.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getProvinces(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->regionRepository->getProvinces();
    }

    /**
     * Get regencies by province code.
     *
     * @param string $provinceCode
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRegenciesByProvince(string $provinceCode): \Illuminate\Database\Eloquent\Collection
    {
        return $this->regionRepository->getRegenciesByProvince($provinceCode);
    }

    /**
     * Get districts by regency code.
     *
     * @param string $regencyCode
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDistrictsByRegency(string $regencyCode): \Illuminate\Database\Eloquent\Collection
    {
        return $this->regionRepository->getDistrictsByRegency($regencyCode);
    }

    /**
     * Get villages by district code.
     *
     * @param string $districtCode
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getVillagesByDistrict(string $districtCode): \Illuminate\Database\Eloquent\Collection
    {
        return $this->regionRepository->getVillagesByDistrict($districtCode);
    }

    /**
     * Get all regions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllRegions(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->regionRepository->getAllRegions();
    }
}
