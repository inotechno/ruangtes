<?php

namespace App\Repositories;

use App\Models\CompanyAdmin;
use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

class CompanyAdminRepository extends BaseRepository
{
    public function __construct(CompanyAdmin $companyAdmin)
    {
        parent::__construct($companyAdmin);
    }

    /**
     * Get primary admin for company
     */
    public function getPrimaryAdmin(string $companyId): ?CompanyAdmin
    {
        return $this->model->where('company_id', $companyId)
            ->where('is_primary', true)
            ->first();
    }

    /**
     * Get all admins for company
     */
    public function getCompanyAdmins(string $companyId): Collection
    {
        return $this->model->where('company_id', $companyId)->get();
    }

    /**
     * Get active admins
     */
    public function getActiveAdmins(): Collection
    {
        return $this->model->where('is_active', true)->get();
    }

    /**
     * Set primary admin
     */
    public function setPrimaryAdmin(CompanyAdmin $admin): bool
    {
        // Remove primary status from other admins in the same company
        $this->model->where('company_id', $admin->company_id)
            ->where('id', '!=', $admin->id)
            ->update(['is_primary' => false]);

        return $admin->update(['is_primary' => true]);
    }

    /**
     * Update admin permissions
     */
    public function updatePermissions(CompanyAdmin $admin, array $permissions): bool
    {
        return $admin->update(['permissions' => $permissions]);
    }

    /**
     * Update last login
     */
    public function updateLastLogin(CompanyAdmin $admin): bool
    {
        return $admin->update([
            'last_login_at' => now(),
            'login_count' => $admin->login_count + 1,
        ]);
    }
}
