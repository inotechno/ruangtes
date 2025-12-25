<?php

namespace App\Repositories;

use App\Models\Participant;
use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class ParticipantRepository extends BaseRepository
{
    public function __construct(Participant $participant)
    {
        parent::__construct($participant);
    }

    /**
     * Get active participants
     */
    public function getActiveParticipants(): Collection
    {
        return $this->model->active()->get();
    }

    /**
     * Get completed participants
     */
    public function getCompletedParticipants(): Collection
    {
        return $this->model->completed()->get();
    }

    /**
     * Get banned participants
     */
    public function getBannedParticipants(): Collection
    {
        return $this->model->where('status', 'banned')->get();
    }

    /**
     * Get participants by company
     */
    public function getParticipantsByCompany(string $companyId): Collection
    {
        return $this->model->where('company_id', $companyId)
            ->with(['assignments.test'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Find participant by unique code
     */
    public function findByUniqueCode(string $code): ?Participant
    {
        return $this->model->where('unique_code', $code)->first();
    }

    /**
     * Find participant by email
     */
    public function findByEmail(string $email): ?Participant
    {
        return $this->model->where('email', $email)->first();
    }

    /**
     * Create participant with unique code
     */
    public function createWithUniqueCode(array $attributes): Participant
    {
        if (!isset($attributes['unique_code'])) {
            $attributes['unique_code'] = $this->generateUniqueCode();
        }

        return $this->create($attributes);
    }

    /**
     * Generate unique code for participant
     */
    private function generateUniqueCode(): string
    {
        do {
            $code = strtoupper(Str::random(10));
        } while ($this->model->where('unique_code', $code)->exists());

        return $code;
    }

    /**
     * Update participant profile
     */
    public function updateProfile(Participant $participant, array $profileData): bool
    {
        $data = [
            'profile_data' => array_merge($participant->profile_data ?? [], $profileData),
            'profile_completed' => true,
            'profile_completed_at' => now(),
        ];

        return $participant->update($data);
    }

    /**
     * Generate access token
     */
    public function generateAccessToken(Participant $participant): string
    {
        return $participant->generateAccessToken();
    }

    /**
     * Validate access token
     */
    public function validateAccessToken(string $token): ?Participant
    {
        $participant = $this->model->where('access_token', hash('sha256', $token))
            ->where('token_expires_at', '>', now())
            ->first();

        if ($participant) {
            $participant->recordAccess();
        }

        return $participant;
    }

    /**
     * Record access for participant
     */
    public function recordAccess(Participant $participant): void
    {
        $participant->recordAccess();
    }

    /**
     * Invalidate access token
     */
    public function invalidateAccessToken(Participant $participant): void
    {
        $participant->invalidateAccessToken();
    }

    /**
     * Update participant status
     */
    public function updateStatus(Participant $participant, string $status, array $additionalData = []): bool
    {
        $data = ['status' => $status];

        if ($status === 'banned' && isset($additionalData['ban_reason'])) {
            $data['ban_reason'] = $additionalData['ban_reason'];
            $data['banned_at'] = now();
        }

        if ($status === 'completed') {
            $data['completed_at'] = now();
        }

        if ($status === 'active') {
            $data['started_test_at'] = $additionalData['started_at'] ?? now();
        }

        return $participant->update($data);
    }

    /**
     * Get participants with progress
     */
    public function getParticipantsWithProgress(string $companyId): Collection
    {
        return $this->model->where('company_id', $companyId)
            ->with(['assignments.test', 'assignments.attempts' => function($query) {
                $query->latest()->take(1);
            }])
            ->get()
            ->map(function($participant) {
                $participant->completion_percentage = $participant->getCompletionPercentage();
                return $participant;
            });
    }

    /**
     * Search participants by name or email
     */
    public function search(string $query, ?string $companyId = null): Collection
    {
        $queryBuilder = $this->model->where(function($q) use ($query) {
            $q->where('name', 'like', "%{$query}%")
              ->orWhere('email', 'like', "%{$query}%")
              ->orWhere('employee_id', 'like', "%{$query}%")
              ->orWhere('unique_code', 'like', "%{$query}%");
        });

        if ($companyId) {
            $queryBuilder->where('company_id', $companyId);
        }

        return $queryBuilder->get();
    }

    /**
     * Get participants by department
     */
    public function getParticipantsByDepartment(string $companyId, string $department): Collection
    {
        return $this->model->where('company_id', $companyId)
            ->where('department', $department)
            ->get();
    }

    /**
     * Get expired participants
     */
    public function getExpiredParticipants(): Collection
    {
        return $this->model->expired()->get();
    }

    /**
     * Get participants needing attention
     */
    public function getParticipantsNeedingAttention(string $companyId): Collection
    {
        return $this->model->where('company_id', $companyId)
            ->where(function($query) {
                $query->where('status', 'banned')
                      ->orWhere('test_period_end', '<', now())
                      ->orWhere(function($q) {
                          $q->where('status', 'active')
                            ->where('invited_at', '<', now()->subDays(7))
                            ->whereNull('first_accessed_at');
                      });
            })
            ->get();
    }

    /**
     * Bulk update participant status
     */
    public function bulkUpdateStatus(Collection $participants, string $status): bool
    {
        return $this->model->whereIn('id', $participants->pluck('id'))
            ->update(['status' => $status, 'updated_at' => now()]);
    }

    /**
     * Get participant statistics for company
     */
    public function getCompanyStatistics(string $companyId): array
    {
        $stats = $this->model->where('company_id', $companyId)
            ->selectRaw('
                COUNT(*) as total_participants,
                COUNT(CASE WHEN status = "active" THEN 1 END) as active_participants,
                COUNT(CASE WHEN status = "completed" THEN 1 END) as completed_participants,
                COUNT(CASE WHEN status = "banned" THEN 1 END) as banned_participants,
                COUNT(CASE WHEN profile_completed = true THEN 1 END) as profile_completed_count
            ')
            ->first();

        return [
            'total_participants' => $stats->total_participants ?? 0,
            'active_participants' => $stats->active_participants ?? 0,
            'completed_participants' => $stats->completed_participants ?? 0,
            'banned_participants' => $stats->banned_participants ?? 0,
            'profile_completed_count' => $stats->profile_completed_count ?? 0,
            'profile_completion_rate' => $stats->total_participants > 0
                ? round(($stats->profile_completed_count / $stats->total_participants) * 100, 2)
                : 0,
        ];
    }

    /**
     * Send invitation to participant
     */
    public function sendInvitation(Participant $participant): bool
    {
        // Logic untuk send email invitation
        // Implementation depends on your email service
        return $participant->update([
            'invited_at' => now(),
            'status' => 'active',
        ]);
    }

    /**
     * Bulk send invitations
     */
    public function bulkSendInvitations(Collection $participants): int
    {
        $count = 0;
        foreach ($participants as $participant) {
            if ($this->sendInvitation($participant)) {
                $count++;
            }
        }
        return $count;
    }
}
