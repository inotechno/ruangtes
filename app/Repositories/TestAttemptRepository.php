<?php

namespace App\Repositories;

use App\Models\TestAttempt;
use App\Models\Participant;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

class TestAttemptRepository extends BaseRepository
{
    public function __construct(TestAttempt $testAttempt)
    {
        parent::__construct($testAttempt);
    }

    /**
     * Get active attempts
     */
    public function getActiveAttempts(): Collection
    {
        return $this->model->active()->get();
    }

    /**
     * Get completed attempts
     */
    public function getCompletedAttempts(): Collection
    {
        return $this->model->completed()->get();
    }

    /**
     * Get flagged attempts
     */
    public function getFlaggedAttempts(): Collection
    {
        return $this->model->flagged()->get();
    }

    /**
     * Get attempts by participant
     */
    public function getAttemptsByParticipant(int $participantId): Collection
    {
        return $this->model->where('participant_id', $participantId)
            ->with(['test', 'assignment'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get attempts by company
     */
    public function getAttemptsByCompany(string $companyId): Collection
    {
        return $this->model->where('company_id', $companyId)
            ->with(['participant', 'test'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get attempts by test
     */
    public function getAttemptsByTest(string $testId): Collection
    {
        return $this->model->where('test_id', $testId)
            ->with(['participant', 'assignment'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Find attempt by code
     */
    public function findByCode(string $code): ?TestAttempt
    {
        return $this->model->where('attempt_code', $code)->first();
    }

    /**
     * Start test attempt
     */
    public function startAttempt(TestAttempt $attempt): bool
    {
        return $attempt->update([
            'status' => 'in_progress',
            'test_started_at' => now(),
            'instructions_started_at' => $attempt->instructions_started_at ?? now(),
        ]);
    }

    /**
     * Submit test attempt
     */
    public function submitAttempt(TestAttempt $attempt, array $answers): bool
    {
        return $this->transaction(function() use ($attempt, $answers) {
            $attempt->update([
                'status' => 'submitted',
                'submitted_at' => now(),
                'answers' => $answers,
                'last_activity_at' => now(),
            ]);

            // Calculate scores if test has handler
            if ($testHandler = $attempt->test->getTestHandler()) {
                $results = $testHandler->calculateResults($attempt->id);
                $attempt->update([
                    'raw_score' => $results['raw_score'] ?? null,
                    'normalized_score' => $results['normalized_score'] ?? null,
                    'percentile' => $results['percentile'] ?? null,
                    'detailed_results' => $results,
                ]);
            }

            return true;
        });
    }

    /**
     * Auto-submit expired attempt
     */
    public function autoSubmitExpired(TestAttempt $attempt): bool
    {
        return $attempt->update([
            'status' => 'auto_submitted',
            'submitted_at' => now(),
        ]);
    }

    /**
     * Record security event
     */
    public function recordSecurityEvent(TestAttempt $attempt, string $event, array $data = []): void
    {
        $attempt->recordSecurityEvent($event, $data);
    }

    /**
     * Flag attempt for review
     */
    public function flagAttempt(TestAttempt $attempt, string $reason, array $data = []): void
    {
        $attempt->flagForReview($reason, $data);
    }

    /**
     * Update time tracking
     */
    public function updateTimeTracking(TestAttempt $attempt, array $timeData): bool
    {
        return $attempt->update([
            'instruction_time' => $timeData['instruction_time'] ?? $attempt->instruction_time,
            'test_time' => $timeData['test_time'] ?? $attempt->test_time,
            'idle_time' => $timeData['idle_time'] ?? $attempt->idle_time,
            'total_time' => $timeData['total_time'] ?? $attempt->total_time,
            'last_activity_at' => now(),
        ]);
    }

    /**
     * Get attempts needing attention (flagged, suspicious, expired)
     */
    public function getAttemptsNeedingAttention(): Collection
    {
        return $this->model->where(function($query) {
            $query->where('is_flagged', true)
                  ->orWhere('cheating_score', '>', 50)
                  ->orWhere('expires_at', '<', now());
        })->with(['participant', 'test'])->get();
    }

    /**
     * Get attempt statistics for company
     */
    public function getCompanyStatistics(string $companyId): array
    {
        $stats = $this->model->where('company_id', $companyId)
            ->selectRaw('
                COUNT(*) as total_attempts,
                COUNT(CASE WHEN status = "completed" THEN 1 END) as completed_attempts,
                COUNT(CASE WHEN is_flagged = true THEN 1 END) as flagged_attempts,
                AVG(cheating_score) as avg_cheating_score,
                AVG(raw_score) as avg_score
            ')
            ->first();

        return [
            'total_attempts' => $stats->total_attempts ?? 0,
            'completed_attempts' => $stats->completed_attempts ?? 0,
            'flagged_attempts' => $stats->flagged_attempts ?? 0,
            'avg_cheating_score' => $stats->avg_cheating_score ?? 0,
            'avg_score' => $stats->avg_score ?? 0,
        ];
    }

    /**
     * Get expired attempts that need auto-submission
     */
    public function getExpiredAttempts(): Collection
    {
        return $this->model->where('status', 'in_progress')
            ->where('expires_at', '<', now())
            ->get();
    }

    /**
     * Bulk update attempt status
     */
    public function bulkUpdateStatus(Collection $attempts, string $status): bool
    {
        return $this->model->whereIn('id', $attempts->pluck('id'))
            ->update(['status' => $status, 'updated_at' => now()]);
    }

    /**
     * Search attempts by various criteria
     */
    public function search(array $criteria): Collection
    {
        $query = $this->model->query();

        if (isset($criteria['participant_name'])) {
            $query->whereHas('participant', function($q) use ($criteria) {
                $q->where('name', 'like', "%{$criteria['participant_name']}%");
            });
        }

        if (isset($criteria['test_code'])) {
            $query->whereHas('test', function($q) use ($criteria) {
                $q->where('code', $criteria['test_code']);
            });
        }

        if (isset($criteria['status'])) {
            $query->where('status', $criteria['status']);
        }

        if (isset($criteria['company_id'])) {
            $query->where('company_id', $criteria['company_id']);
        }

        if (isset($criteria['date_from'])) {
            $query->where('created_at', '>=', $criteria['date_from']);
        }

        if (isset($criteria['date_to'])) {
            $query->where('created_at', '<=', $criteria['date_to']);
        }

        return $query->with(['participant', 'test'])->get();
    }

    /**
     * Get attempts with detailed information
     */
    public function getDetailedAttempts(): Collection
    {
        return $this->model->with([
            'participant',
            'test',
            'assignment',
            'company',
            'user'
        ])->get();
    }
}
