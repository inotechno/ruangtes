<?php

namespace App\Repositories;

use App\Models\SuperAdmin;
use Illuminate\Database\Eloquent\Collection;

class SuperAdminRepository extends BaseRepository
{
    public function __construct(SuperAdmin $superAdmin)
    {
        parent::__construct($superAdmin);
    }

    /**
     * Get all super admins
     */
    public function getAllSuperAdmins(): Collection
    {
        return $this->all();
    }

    /**
     * Find super admin by name
     */
    public function findByName(string $name): ?SuperAdmin
    {
        return $this->model->where('name', 'like', "%{$name}%")->first();
    }

    /**
     * Update super admin profile
     */
    public function updateProfile(SuperAdmin $admin, array $data): bool
    {
        return $admin->update($data);
    }
}
