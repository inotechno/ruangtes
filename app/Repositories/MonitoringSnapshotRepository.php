<?php

namespace App\Repositories;

use App\Models\MonitoringSnapshot;
use Illuminate\Database\Eloquent\Collection;

class MonitoringSnapshotRepository extends BaseRepository
{
    public function __construct(MonitoringSnapshot $monitoringSnapshot)
    {
        parent::__construct($monitoringSnapshot);
    }

    /**
     * Get snapshots for attempt
     */
    public function getSnapshotsForAttempt(int $attemptId): Collection
    {
        return $this->model->where('attempt_id', $attemptId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get flagged snapshots
     */
    public function getFlaggedSnapshots(): Collection
    {
        return $this->model->flagged()->get();
    }

    /**
     * Get snapshots by trigger type
     */
    public function getSnapshotsByTriggerType(string $triggerType): Collection
    {
        return $this->model->where('trigger_type', $triggerType)->get();
    }

    /**
     * Get suspicious snapshots
     */
    public function getSuspiciousSnapshots(): Collection
    {
        return $this->model->suspicious()->get();
    }

    /**
     * Flag snapshot
     */
    public function flagSnapshot(MonitoringSnapshot $snapshot): bool
    {
        return $snapshot->flag();
    }

    /**
     * Clean old snapshots
     */
    public function cleanOldSnapshots(int $daysToKeep = 30): int
    {
        return $this->model->where('created_at', '<', now()->subDays($daysToKeep))->delete();
    }
}
