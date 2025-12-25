<?php

namespace App\Repositories;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class AuditLogRepository extends BaseRepository
{
    public function __construct(AuditLog $auditLog)
    {
        parent::__construct($auditLog);
    }

    /**
     * Log user action
     */
    public function logAction(
        string $event,
        $model = null,
        $user = null,
        string $description = null,
        array $oldValues = [],
        array $newValues = [],
        array $metadata = []
    ): AuditLog {
        return AuditLog::log($event, $model, $user, $description, $oldValues, $newValues, $metadata);
    }

    /**
     * Get logs by event type
     */
    public function getLogsByEvent(string $event): Collection
    {
        return $this->model->where('event', $event)->orderBy('created_at', 'desc')->get();
    }

    /**
     * Get logs by user
     */
    public function getLogsByUser(int $userId): Collection
    {
        return $this->model->where('user_id', $userId)->orderBy('created_at', 'desc')->get();
    }

    /**
     * Get logs by model
     */
    public function getLogsByModel(string $modelType, $modelId = null): Collection
    {
        $query = $this->model->where('model_type', $modelType);

        if ($modelId) {
            $query->where('model_id', $modelId);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    /**
     * Get recent logs
     */
    public function getRecentLogs(int $days = 7): Collection
    {
        return $this->model->recent($days)->orderBy('created_at', 'desc')->get();
    }

    /**
     * Search logs by description
     */
    public function searchLogs(string $query): Collection
    {
        return $this->model->where('description', 'like', "%{$query}%")
            ->orWhere('event', 'like', "%{$query}%")
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get logs with user information
     */
    public function getLogsWithUsers(): Collection
    {
        return $this->model->with('user.userable')->orderBy('created_at', 'desc')->get();
    }

    /**
     * Get activity summary
     */
    public function getActivitySummary(int $days = 30): array
    {
        $startDate = now()->subDays($days);

        $summary = $this->model->where('created_at', '>=', $startDate)
            ->selectRaw('event, COUNT(*) as count')
            ->groupBy('event')
            ->orderBy('count', 'desc')
            ->get();

        return $summary->pluck('count', 'event')->toArray();
    }

    /**
     * Get user activity summary
     */
    public function getUserActivitySummary(int $days = 30): Collection
    {
        $startDate = now()->subDays($days);

        return $this->model->where('created_at', '>=', $startDate)
            ->with('user.userable')
            ->selectRaw('user_id, COUNT(*) as activity_count')
            ->groupBy('user_id')
            ->orderBy('activity_count', 'desc')
            ->get();
    }

    /**
     * Clean old logs (for maintenance)
     */
    public function cleanOldLogs(int $daysToKeep = 365): int
    {
        return $this->model->where('created_at', '<', now()->subDays($daysToKeep))->delete();
    }

    /**
     * Get logs by date range
     */
    public function getLogsByDateRange(string $startDate, string $endDate): Collection
    {
        return $this->model->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get suspicious activities
     */
    public function getSuspiciousActivities(): Collection
    {
        return $this->model->whereIn('event', [
            'user_suspended',
            'attempt_flagged',
            'security_breach',
            'unauthorized_access',
        ])->orderBy('created_at', 'desc')->get();
    }
}
