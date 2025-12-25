<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonitoringSnapshot extends Model
{
    protected $fillable = [
        'attempt_id',
        'screenshot_url',
        'trigger_type',
        'is_flagged',
        'metadata',
        'ai_analysis',
    ];

    protected $casts = [
        'is_flagged' => 'boolean',
        'metadata' => 'array',
        'ai_analysis' => 'array',
    ];

    // Relationships
    public function attempt()
    {
        return $this->belongsTo(TestAttempt::class);
    }

    // Helper methods
    public function isSuspicious(): bool
    {
        return in_array($this->trigger_type, [
            'suspicious_activity',
            'tab_change',
            'copy_attempt',
            'right_click',
            'devtool_open',
            'fullscreen_exit',
            'face_not_detected',
            'multiple_faces'
        ]);
    }

    public function flag()
    {
        $this->is_flagged = true;
        $this->save();
    }

    public function unflag()
    {
        $this->is_flagged = false;
        $this->save();
    }

    // Scopes
    public function scopeFlagged($query)
    {
        return $query->where('is_flagged', true);
    }

    public function scopeByTriggerType($query, string $type)
    {
        return $query->where('trigger_type', $type);
    }

    public function scopeSuspicious($query)
    {
        return $query->whereIn('trigger_type', [
            'suspicious_activity',
            'tab_change',
            'copy_attempt',
            'right_click',
            'devtool_open',
            'fullscreen_exit',
            'face_not_detected',
            'multiple_faces'
        ]);
    }
}
