<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ImportBatch extends Model
{
    protected $fillable = [
        'user_id',
        'batch_number',
        'file_name',
        'file_path',
        'import_type',
        'status',
        'total_rows',
        'processed_rows',
        'successful_rows',
        'failed_rows',
        'errors',
        'error_message',
        'mapping_config',
        'validation_rules',
        'metadata',
    ];

    protected $casts = [
        'errors' => 'array',
        'mapping_config' => 'array',
        'validation_rules' => 'array',
        'metadata' => 'array',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    // Helper methods
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }

    public function getProgressPercentage(): float
    {
        if ($this->total_rows <= 0) {
            return 0;
        }
        return round(($this->processed_rows / $this->total_rows) * 100, 2);
    }

    public function getSuccessRate(): float
    {
        if ($this->processed_rows <= 0) {
            return 0;
        }
        return round(($this->successful_rows / $this->processed_rows) * 100, 2);
    }

    public function addError(int $rowNumber, string $message, array $data = [])
    {
        $errors = $this->errors ?? [];
        $errors[] = [
            'row' => $rowNumber,
            'message' => $message,
            'data' => $data,
            'timestamp' => now(),
        ];
        $this->errors = $errors;
        $this->failed_rows++;
        $this->save();
    }

    public function incrementProcessed(bool $successful = true)
    {
        $this->processed_rows++;
        if ($successful) {
            $this->successful_rows++;
        }
        $this->save();
    }

    public function markCompleted()
    {
        $this->status = 'completed';
        $this->save();
    }

    public function markFailed(string $errorMessage = null)
    {
        $this->status = 'failed';
        $this->error_message = $errorMessage;
        $this->save();
    }

    // Scopes
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    public function scopeProcessing($query)
    {
        return $query->where('status', 'processing');
    }

    public function scopeByType($query, string $type)
    {
        return $query->where('import_type', $type);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($batch) {
            if (empty($batch->batch_number)) {
                $batch->batch_number = 'IMP-' . date('Ymd') . '-' . strtoupper(Str::random(6));
            }
        });
    }
}
