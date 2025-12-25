<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    /**
     * Find user by email
     */
    public function findByEmail(string $email): ?User
    {
        return $this->model->where('email', $email)->first();
    }

    /**
     * Get active users
     */
    public function getActiveUsers(): Collection
    {
        return $this->model->active()->get();
    }

    /**
     * Get inactive users
     */
    public function getInactiveUsers(): Collection
    {
        return $this->model->inactive()->get();
    }

    /**
     * Get suspended users
     */
    public function getSuspendedUsers(): Collection
    {
        return $this->model->suspended()->get();
    }

    /**
     * Get super admins
     */
    public function getSuperAdmins(): Collection
    {
        return $this->model->where('userable_type', 'App\Models\SuperAdmin')->get();
    }

    /**
     * Get company admins
     */
    public function getCompanyAdmins(): Collection
    {
        return $this->model->where('userable_type', 'App\Models\CompanyAdmin')->get();
    }

    /**
     * Get public users
     */
    public function getPublicUsers(): Collection
    {
        return $this->model->where('userable_type', 'App\Models\PublicUser')->get();
    }

    /**
     * Update user settings
     */
    public function updateSettings(User $user, array $settings): bool
    {
        return $user->update(['settings' => array_merge($user->settings ?? [], $settings)]);
    }

    /**
     * Update last login
     */
    public function updateLastLogin(User $user, string $ipAddress = null): bool
    {
        $data = ['last_login_at' => now()];
        if ($ipAddress) {
            $data['last_login_ip'] = $ipAddress;
        }
        return $user->update($data);
    }

    /**
     * Get users with their roles
     */
    public function getUsersWithRoles(): Collection
    {
        return $this->model->with('userable')->get();
    }

    /**
     * Search users by name or email
     */
    public function search(string $query): Collection
    {
        return $this->model->where(function($q) use ($query) {
            $q->whereHas('userable', function($subQ) use ($query) {
                $subQ->where('name', 'like', "%{$query}%");
            })->orWhere('email', 'like', "%{$query}%");
        })->get();
    }

    /**
     * Paginate users with roles
     */
    public function paginateWithRoles(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->with('userable')->paginate($perPage);
    }
}
