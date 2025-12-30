<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, HasRoles, Notifiable, SoftDeletes;

    protected $fillable = [
        'email',
        'password',
        'password_string',
        'phone',
        'userable_id',
        'userable_type',
        'status',
        'activation_token',
        'last_login_at',
        'last_login_ip',
        'settings',
    ];

    protected $hidden = [
        'password',
        'password_string',
        'remember_token',
        'activation_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'settings' => 'array',
            'password' => 'hashed',
        ];
    }

    // Polymorphic relationship
    public function userable()
    {
        return $this->morphTo();
    }

    // Helper methods
    public function isSuperAdmin(): bool
    {
        return $this->userable_type === SuperAdmin::class;
    }

    public function isCompanyAdmin(): bool
    {
        return $this->userable_type === CompanyAdmin::class;
    }

    public function isPublicUser(): bool
    {
        return $this->userable_type === PublicUser::class;
    }

    public function getUserable()
    {
        return $this->userable;
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        $name = $this->userable?->name ?? $this->email;

        return Str::of($name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    // Scope untuk filter status
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    public function scopeSuspended($query)
    {
        return $query->where('status', 'suspended');
    }
}
