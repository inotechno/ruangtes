<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublicUser extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'date_of_birth',
        'gender',
        'phone',
        'address',
        'province_code',
        'regency_code',
        'district_code',
        'village_code',
        'education_level',
        'major',
        'university',
        'graduation_year',
        'current_job',
        'company',
        'bio',
        'avatar',
        'cv_url',
        'preferences',
        'test_history_summary',
        'total_tests_taken',
        'average_score',
        'last_test_taken_at',
        'is_profile_complete',
        'profile_completed_at',
    ];


    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'last_test_taken_at' => 'datetime',
            'profile_completed_at' => 'datetime',
            'preferences' => 'array',
            'test_history_summary' => 'array',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->hasOne(User::class, 'userable_id', 'id')
            ->where('userable_type', User::class);
    }

    // Helper methods
    public function isProfileCompleted(): bool
    {
        return $this->is_profile_complete ? true : false;
    }
    
}
