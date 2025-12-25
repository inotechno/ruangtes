<?php

namespace App\Repositories;

use App\Models\PublicUser;
use Illuminate\Database\Eloquent\Collection;

class PublicUserRepository extends BaseRepository
{
    public function __construct(PublicUser $publicUser)
    {
        parent::__construct($publicUser);
    }

    /**
     * Find public user by email
     */
    public function findByEmail(string $email): ?PublicUser
    {
        return $this->model->where('email', $email)->first();
    }

    /**
     * Search public users
     */
    public function search(string $query): Collection
    {
        return $this->model->where(function($q) use ($query) {
            $q->where('name', 'like', "%{$query}%")
              ->orWhere('email', 'like', "%{$query}%");
        })->get();
    }

    /**
     * Get users by education level
     */
    public function getUsersByEducation(string $education): Collection
    {
        return $this->model->where('education', $education)->get();
    }

    /**
     * Get users by age range
     */
    public function getUsersByAgeRange(int $minAge, int $maxAge): Collection
    {
        return $this->model->whereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) BETWEEN ? AND ?', [$minAge, $maxAge])->get();
    }

    /**
     * Update user profile
     */
    public function updateProfile(PublicUser $user, array $data): bool
    {
        return $user->update($data);
    }
}
