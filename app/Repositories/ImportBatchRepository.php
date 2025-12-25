<?php

namespace App\Repositories;

use App\Models\ImportBatch;
use Illuminate\Database\Eloquent\Collection;

class ImportBatchRepository extends BaseRepository
{
    public function __construct(ImportBatch $importBatch)
    {
        parent::__construct($importBatch);
    }

    /**
     * Get user's import batches
     */
    public function getUserImportBatches(int $userId): Collection
    {
        return $this->model->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get processing batches
     */
    public function getProcessingBatches(): Collection
    {
        return $this->model->where('status', 'processing')->get();
    }

    /**
     * Get failed batches
     */
    public function getFailedBatches(): Collection
    {
        return $this->model->where('status', 'failed')->get();
    }

    /**
     * Create import batch
     */
    public function createImportBatch(array $data): ImportBatch
    {
        return $this->create($data);
    }

    /**
     * Update batch progress
     */
    public function updateProgress(ImportBatch $batch, int $processed, int $successful, int $failed): bool
    {
        return $batch->update([
            'processed_rows' => $processed,
            'successful_rows' => $successful,
            'failed_rows' => $failed,
        ]);
    }

    /**
     * Mark batch as completed
     */
    public function markAsCompleted(ImportBatch $batch): bool
    {
        return $batch->markCompleted();
    }

    /**
     * Mark batch as failed
     */
    public function markAsFailed(ImportBatch $batch, string $errorMessage = null): bool
    {
        return $batch->markFailed($errorMessage);
    }

    /**
     * Add error to batch
     */
    public function addError(ImportBatch $batch, int $rowNumber, string $message, array $data = []): void
    {
        $batch->addError($rowNumber, $message, $data);
    }

    /**
     * Get batch statistics
     */
    public function getBatchStatistics(ImportBatch $batch): array
    {
        return [
            'total_rows' => $batch->total_rows,
            'processed_rows' => $batch->processed_rows,
            'successful_rows' => $batch->successful_rows,
            'failed_rows' => $batch->failed_rows,
            'progress_percentage' => $batch->getProgressPercentage(),
            'success_rate' => $batch->getSuccessRate(),
        ];
    }

    /**
     * Clean old batches
     */
    public function cleanOldBatches(int $daysToKeep = 90): int
    {
        return $this->model->where('created_at', '<', now()->subDays($daysToKeep))->delete();
    }
}
