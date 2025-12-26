<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Test extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'code',
        'name',
        'slug',
        'description',
        'short_description',
        'price',
        'company_price',
        'is_free',
        'has_discount',
        'discount_price',
        'discount_ends_at',
        'duration_minutes',
        'total_questions',
        'passing_score',
        'max_attempts',
        'randomize_questions',
        'show_results_immediately',
        'requires_profile',
        'type',
        'is_active',
        'published_at',
        'instruction_route',
        'test_route',
        'result_route',
        'meta',
        'enable_webcam',
        'enable_screen_capture',
        'disable_copy_paste',
        'disable_right_click',
        'fullscreen_required',
        'generate_certificate',
        'certificate_template',
        'generate_pdf_report',
        'report_settings',
        'total_attempts',
        'average_score',
        'average_completion_time',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'company_price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'discount_ends_at' => 'datetime',
        'published_at' => 'datetime',
        'meta' => 'array',
        'report_settings' => 'array',
        'average_score' => 'decimal:2',
        'is_free' => 'boolean',
        'has_discount' => 'boolean',
        'randomize_questions' => 'boolean',
        'show_results_immediately' => 'boolean',
        'requires_profile' => 'boolean',
        'is_active' => 'boolean',
        'enable_webcam' => 'boolean',
        'enable_screen_capture' => 'boolean',
        'disable_copy_paste' => 'boolean',
        'disable_right_click' => 'boolean',
        'fullscreen_required' => 'boolean',
        'generate_certificate' => 'boolean',
        'generate_pdf_report' => 'boolean',
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(TestCategory::class);
    }

    public function assignments()
    {
        return $this->hasMany(ParticipantTestAssignment::class);
    }

    public function attempts()
    {
        return $this->hasMany(TestAttempt::class);
    }

    // Helper methods
    public function getTestHandler()
    {
        $handlerClass = config("tests.handlers.{$this->code}");
        return $handlerClass ? app($handlerClass) : null;
    }

    public function isPublished(): bool
    {
        return $this->is_active && $this->published_at && $this->published_at->isPast();
    }

    public function isAvailableFor(string $type): bool
    {
        return $this->type === 'all' || $this->type === $type;
    }

    public function getEffectivePrice(?Company $company = null): float
    {
        if ($company && $this->company_price) {
            return $this->company_price;
        }

        if ($this->has_discount && $this->discount_price && $this->discount_ends_at?->isFuture()) {
            return $this->discount_price;
        }

        return $this->price;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePublished($query)
    {
        return $query->where('is_active', true)
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }

    public function scopePublic($query)
    {
        return $query->where(function($q) {
            $q->where('type', 'public')
              ->orWhere('type', 'all');
        });
    }

    public function scopeCompany($query)
    {
        return $query->where(function($q) {
            $q->where('type', 'company')
              ->orWhere('type', 'all');
        });
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($test) {
            if (empty($test->slug)) {
                $test->slug = Str::slug($test->name);
            }
        });

        static::updating(function ($test) {
            if ($test->isDirty('name') && empty($test->slug)) {
                $test->slug = Str::slug($test->name);
            }
        });
    }

    // Helper Methods
    public function getProgressPercentage()
    {
        if ($this->total_assigned_tests === 0) {
            return 0;
        }
        
        return ($this->completed_tests / $this->total_assigned_tests) * 100;
    }
    
    public function updateSummary()
    {
        $total = $this->assignments()->count();
        $completed = $this->assignments()->where('status', 'completed')->count();
        $inProgress = $this->assignments()->whereIn('status', ['instructions', 'in_progress', 'paused'])->count();
        $pending = $this->assignments()->where('status', 'available')->count();
        
        $this->update([
            'total_assigned_tests' => $total,
            'completed_tests' => $completed,
            'in_progress_tests' => $inProgress,
            'pending_tests' => $pending,
            'status' => $this->determineOverallStatus($total, $completed),
        ]);
    }
    
    private function determineOverallStatus($total, $completed)
    {
        if ($total === 0) return 'pending';
        if ($completed === $total) return 'completed';
        if ($this->assignments()->whereIn('status', ['instructions', 'in_progress'])->exists()) return 'testing';
        return 'active';
    }
}
