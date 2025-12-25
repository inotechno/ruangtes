<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Participant extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'unique_code',
        'name',
        'email',
        'phone',
        'employee_id',
        'date_of_birth',
        'gender',
        'education',
        'department',
        'position',
        'test_period_start',
        'test_period_end',
        'assigned_tests_summary',
        'total_assigned_tests',
        'completed_tests',
        'in_progress_tests',
        'pending_tests',
        'status',
        'invited_at',
        'first_accessed_at',
        'started_test_at',
        'completed_at',
        'banned_at',
        'ban_reason',
        'access_token',
        'token_expires_at',
        'access_count',
        'last_accessed_at',
        'profile_completed',
        'profile_completed_at',
        'profile_data',
        'metadata',
        'import_batch_id',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'test_period_start' => 'datetime',
        'test_period_end' => 'datetime',
        'invited_at' => 'datetime',
        'first_accessed_at' => 'datetime',
        'started_test_at' => 'datetime',
        'completed_at' => 'datetime',
        'banned_at' => 'datetime',
        'token_expires_at' => 'datetime',
        'last_accessed_at' => 'datetime',
        'profile_completed_at' => 'datetime',
        'assigned_tests_summary' => 'array',
        'profile_data' => 'array',
        'metadata' => 'array',
        'profile_completed' => 'boolean',
    ];

    // Relationships
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function assignments()
    {
        return $this->hasMany(ParticipantTestAssignment::class);
    }

    public function attempts()
    {
        return $this->hasMany(TestAttempt::class);
    }

    public function importBatch()
    {
        return $this->belongsTo(ImportBatch::class);
    }

    // Helper methods
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isBanned(): bool
    {
        return $this->status === 'banned';
    }

    public function isExpired(): bool
    {
        return $this->test_period_end && $this->test_period_end->isPast();
    }

    public function canAccessTest(): bool
    {
        if ($this->isBanned()) {
            return false;
        }

        if ($this->isExpired()) {
            return false;
        }

        return $this->status === 'active';
    }

    public function getAssignedTests()
    {
        return $this->assignments()->with('test')->orderBy('test_order')->get();
    }

    public function getNextTest()
    {
        return $this->assignments()
            ->where('status', 'available')
            ->orderBy('test_order')
            ->first();
    }

    public function getCompletionPercentage(): float
    {
        if ($this->total_assigned_tests <= 0) {
            return 0;
        }
        return round(($this->completed_tests / $this->total_assigned_tests) * 100, 2);
    }

    public function generateAccessToken(): string
    {
        $token = Str::random(64);
        $this->access_token = hash('sha256', $token);
        $this->token_expires_at = now()->addHours(24); // Token valid for 24 hours
        $this->save();

        return $token;
    }

    public function invalidateAccessToken()
    {
        $this->access_token = null;
        $this->token_expires_at = null;
        $this->save();
    }

    public function recordAccess()
    {
        $this->access_count++;
        $this->last_accessed_at = now();

        if (!$this->first_accessed_at) {
            $this->first_accessed_at = now();
        }

        $this->save();
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeByCompany($query, $companyId)
    {
        return $query->where('company_id', $companyId);
    }

    public function scopeProfileCompleted($query)
    {
        return $query->where('profile_completed', true);
    }

    public function scopeExpired($query)
    {
        return $query->where('test_period_end', '<', now());
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($participant) {
            if (empty($participant->unique_code)) {
                $participant->unique_code = strtoupper(Str::random(10));
            }
        });
    }
}
