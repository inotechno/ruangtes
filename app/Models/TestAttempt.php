<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class TestAttempt extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'attempt_code',
        'assignment_id',
        'participant_id',
        'test_id',
        'company_id',
        'user_id',
        'order_item_id',
        'attempt_type',
        'status',
        'instructions_started_at',
        'test_started_at',
        'last_activity_at',
        'submitted_at',
        'expires_at',
        'instruction_time',
        'test_time',
        'idle_time',
        'total_time',
        'current_page',
        'current_question',
        'total_questions',
        'questions_answered',
        'questions_skipped',
        'questions_flagged',
        'answers',
        'answer_history',
        'answer_timestamps',
        'is_flagged',
        'flag_reasons',
        'security_events',
        'browser_info',
        'device_info',
        'ip_address',
        'user_agent',
        'screen_resolution',
        'was_fullscreen',
        'tab_change_count',
        'copy_attempt_count',
        'right_click_count',
        'devtool_open_count',
        'inactivity_count',
        'cheating_score',
        'payment_status',
        'amount_paid',
        'paid_at',
        'test_settings_snapshot',
        'user_profile_snapshot',
        'raw_score',
        'normalized_score',
        'percentile',
        'section_scores',
        'detailed_results',
        'report_url',
        'certificate_url',
        'report_generated_at',
    ];

    protected $casts = [
        'instructions_started_at' => 'datetime',
        'test_started_at' => 'datetime',
        'last_activity_at' => 'datetime',
        'submitted_at' => 'datetime',
        'expires_at' => 'datetime',
        'paid_at' => 'datetime',
        'report_generated_at' => 'datetime',
        'answers' => 'array',
        'answer_history' => 'array',
        'answer_timestamps' => 'array',
        'flag_reasons' => 'array',
        'security_events' => 'array',
        'browser_info' => 'array',
        'device_info' => 'array',
        'test_settings_snapshot' => 'array',
        'user_profile_snapshot' => 'array',
        'section_scores' => 'array',
        'detailed_results' => 'array',
        'raw_score' => 'decimal:4',
        'normalized_score' => 'decimal:4',
        'amount_paid' => 'decimal:2',
        'cheating_score' => 'decimal:2',
        'is_flagged' => 'boolean',
        'was_fullscreen' => 'boolean',
    ];

    // Relationships
    public function assignment()
    {
        return $this->belongsTo(ParticipantTestAssignment::class);
    }

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    // Helper methods
    public function isActive(): bool
    {
        return in_array($this->status, ['instructions', 'in_progress', 'paused']);
    }

    public function isCompleted(): bool
    {
        return in_array($this->status, ['submitted', 'auto_submitted']);
    }

    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    public function isCheatingSuspected(): bool
    {
        return $this->cheating_score && $this->cheating_score > 50;
    }

    public function getProgressPercentage(): float
    {
        if ($this->total_questions <= 0) {
            return 0;
        }
        return round(($this->questions_answered / $this->total_questions) * 100, 2);
    }

    public function getTimeSpent(): int
    {
        return $this->instruction_time + $this->test_time;
    }

    public function flagForReview(string $reason, array $additionalData = [])
    {
        $this->is_flagged = true;
        $currentReasons = $this->flag_reasons ?? [];
        $currentReasons[] = [
            'reason' => $reason,
            'timestamp' => now(),
            'data' => $additionalData,
        ];
        $this->flag_reasons = $currentReasons;
        $this->save();
    }

    public function recordSecurityEvent(string $event, array $data = [])
    {
        $currentEvents = $this->security_events ?? [];
        $currentEvents[] = [
            'event' => $event,
            'timestamp' => now(),
            'data' => $data,
        ];
        $this->security_events = $currentEvents;
        $this->save();
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->whereIn('status', ['instructions', 'in_progress', 'paused']);
    }

    public function scopeCompleted($query)
    {
        return $query->whereIn('status', ['submitted', 'auto_submitted']);
    }

    public function scopeFlagged($query)
    {
        return $query->where('is_flagged', true);
    }

    public function scopeByType($query, string $type)
    {
        return $query->where('attempt_type', $type);
    }

    public function scopeByCompany($query, $companyId)
    {
        return $query->where('company_id', $companyId);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($attempt) {
            if (empty($attempt->attempt_code)) {
                $attempt->attempt_code = 'ATT-' . date('Ymd') . '-' . strtoupper(Str::random(6));
            }
        });
    }

    // ============================================
    // **SCOPES UNTUK FILTER**
    // ============================================
    
    public function scopeForParticipant($query, $participantId)
    {
        return $query->where('participant_id', $participantId)
                     ->where('attempt_type', 'company_participant');
    }
    
    public function scopeForPublicUser($query, $userId)
    {
        return $query->where('user_id', $userId)
                     ->where('attempt_type', 'direct_public');
    }
    
    public function scopeCompanyAttempts($query, $companyId)
    {
        return $query->where('company_id', $companyId)
                     ->whereIn('attempt_type', ['company_participant', 'company_public']);
    }

     // ============================================
    // **HELPER METHODS**
    // ============================================
    
    public function getAttemptOwner()
    {
        return match($this->attempt_type) {
            'company_participant' => $this->participant,
            'direct_public', 'company_public' => $this->user,
            default => null,
        };
    }
    
    public function getOwnerName()
    {
        $owner = $this->getAttemptOwner();
        
        if ($owner instanceof Participant) {
            return $owner->name . ' (Participant)';
        }
        
        if ($owner instanceof User && $owner->userable_type === 'App\Models\PublicUser') {
            return $owner->userable->name . ' (Public User)';
        }
        
        return 'Unknown Owner';
    }
}
