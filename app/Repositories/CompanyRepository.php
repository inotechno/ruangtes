<?php

namespace App\Repositories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CompanyRepository extends BaseRepository
{
    public function __construct(Company $company)
    {
        parent::__construct($company);
    }

    /**
     * Get active companies
     */
    public function getActiveCompanies(): Collection
    {
        return $this->model->where('status', 'active')->get();
    }

    /**
     * Get verified companies
     */
    public function getVerifiedCompanies(): Collection
    {
        return $this->model->where('is_verified', true)->get();
    }

    /**
     * Get pending companies
     */
    public function getPendingCompanies(): Collection
    {
        return $this->model->where('status', 'pending')->get();
    }

    /**
     * Find company by code
     */
    public function findByCode(string $code): ?Company
    {
        return $this->model->where('code', $code)->first();
    }

    /**
     * Get companies with subscription info
     */
    public function getCompaniesWithSubscriptions(): Collection
    {
        return $this->model->with(['subscriptions' => function($query) {
            $query->latest()->take(1);
        }, 'admins'])->get();
    }

    /**
     * Get companies expiring soon
     */
    public function getCompaniesExpiringSoon(int $days = 30): Collection
    {
        return $this->model->where('subscription_end', '<=', now()->addDays($days))
            ->where('subscription_end', '>', now())
            ->get();
    }

    /**
     * Get expired companies
     */
    public function getExpiredCompanies(): Collection
    {
        return $this->model->where('subscription_end', '<', now())
            ->where('status', 'active')
            ->get();
    }

    /**
     * Update company status
     */
    public function updateStatus(Company $company, string $status, array $additionalData = []): bool
    {
        $data = ['status' => $status];

        if ($status === 'active' && isset($additionalData['verified_at'])) {
            $data['is_verified'] = true;
            $data['verified_at'] = $additionalData['verified_at'];
        }

        return $company->update($data);
    }

    /**
     * Update subscription info
     */
    public function updateSubscription(Company $company, array $subscriptionData): bool
    {
        return $company->update([
            'subscription_type' => $subscriptionData['type'] ?? $company->subscription_type,
            'subscription_start' => $subscriptionData['start'] ?? $company->subscription_start,
            'subscription_end' => $subscriptionData['end'] ?? $company->subscription_end,
            'max_participants' => $subscriptionData['max_participants'] ?? $company->max_participants,
        ]);
    }

    /**
     * Get company statistics
     */
    public function getCompanyStatistics(Company $company): array
    {
        $stats = [
            'total_participants' => $company->participants()->count(),
            'active_participants' => $company->participants()->where('status', 'active')->count(),
            'completed_participants' => $company->participants()->where('status', 'completed')->count(),
            'total_attempts' => $company->testAttempts()->count(),
            'completed_attempts' => $company->testAttempts()->whereIn('status', ['submitted', 'auto_submitted'])->count(),
            'flagged_attempts' => $company->testAttempts()->where('is_flagged', true)->count(),
        ];

        $stats['completion_rate'] = $stats['total_attempts'] > 0
            ? round(($stats['completed_attempts'] / $stats['total_attempts']) * 100, 2)
            : 0;

        return $stats;
    }

    /**
     * Search companies by name or email
     */
    public function search(string $query): Collection
    {
        return $this->model->where(function($q) use ($query) {
            $q->where('name', 'like', "%{$query}%")
              ->orWhere('email', 'like', "%{$query}%")
              ->orWhere('code', 'like', "%{$query}%");
        })->get();
    }

    /**
     * Get companies by subscription type
     */
    public function getCompaniesBySubscriptionType(string $type): Collection
    {
        return $this->model->where('subscription_type', $type)->get();
    }

    /**
     * Verify company
     */
    public function verifyCompany(Company $company): bool
    {
        return $company->update([
            'is_verified' => true,
            'verified_at' => now(),
            'status' => 'active',
        ]);
    }

    /**
     * Suspend company
     */
    public function suspendCompany(Company $company, string $reason = null): bool
    {
        return $company->update([
            'status' => 'suspended',
            'settings' => array_merge($company->settings ?? [], [
                'suspension_reason' => $reason,
                'suspended_at' => now(),
            ]),
        ]);
    }

    /**
     * Reactivate company
     */
    public function reactivateCompany(Company $company): bool
    {
        return $company->update([
            'status' => 'active',
            'settings' => array_merge($company->settings ?? [], [
                'reactivated_at' => now(),
            ]),
        ]);
    }

    /**
     * Update company branding
     */
    public function updateBranding(Company $company, array $brandingData): bool
    {
        $data = [];

        if (isset($brandingData['logo'])) {
            $data['logo'] = $brandingData['logo'];
        }

        if (isset($brandingData['favicon'])) {
            $data['favicon'] = $brandingData['favicon'];
        }

        if (isset($brandingData['primary_color'])) {
            $data['primary_color'] = $brandingData['primary_color'];
        }

        if (isset($brandingData['secondary_color'])) {
            $data['secondary_color'] = $brandingData['secondary_color'];
        }

        return $company->update($data);
    }

    /**
     * Update company settings
     */
    public function updateSettings(Company $company, array $settings): bool
    {
        return $company->update([
            'settings' => array_merge($company->settings ?? [], $settings),
        ]);
    }

    /**
     * Get companies needing attention
     */
    public function getCompaniesNeedingAttention(): Collection
    {
        return $this->model->where(function($query) {
            $query->where('status', 'pending')
                  ->orWhere('subscription_end', '<=', now()->addDays(7))
                  ->orWhere('is_verified', false);
        })->get();
    }
}
