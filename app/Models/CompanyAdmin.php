<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyAdmin extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'company_id',
        'name',
        'position',
        'department',
        'employee_id',
        'phone',
        'avatar',
        'role',
        'is_primary',
        'is_active',
        'last_login_at',
        'last_login_ip',
        'login_count',
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'last_login_at' => 'datetime',
            'permissions' => 'array',
            'password' => 'hashed',
        ];
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'userable_id', 'id')
            ->where('userable_type', User::class);
    }

    public function isPrimary(): bool
    {
        return $this->is_primary;
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function isOwner(): bool
    {
        return $this->role === 'owner';
    }
    
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isManager(): bool
    {
        return $this->role === 'manager';
    }
}
