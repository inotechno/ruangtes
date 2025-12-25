<?php

namespace App\Repositories;

use App\Models\CompanySubscription;
use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

class CompanySubscriptionRepository extends BaseRepository
{
    public function __construct(CompanySubscription $companySubscription)
    {
        parent::__construct($companySubscription);
    }

    /**
     * Get active subscription for company
     */
    public function getActiveSubscription(string $companyId): ?CompanySubscription
    {
        return $this->model->where('company_id', $companyId)
            ->where('status', 'active')
            ->where('end_date', '>', now())
            ->first();
    }

    /**
     * Get all subscriptions for company
     */
    public function getCompanySubscriptions(string $companyId): Collection
    {
        return $this->model->where('company_id', $companyId)
            ->with('plan')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get expired subscriptions
     */
    public function getExpiredSubscriptions(): Collection
    {
        return $this->model->where('end_date', '<', now())
            ->where('status', 'active')
            ->get();
    }

    /**
     * Get subscriptions expiring soon
     */
    public function getSubscriptionsExpiringSoon(int $days = 30): Collection
    {
        return $this->model->where('end_date', '<=', now()->addDays($days))
            ->where('end_date', '>', now())
            ->where('status', 'active')
            ->get();
    }

    /**
     * Create subscription
     */
    public function createSubscription(array $data): CompanySubscription
    {
        return $this->create($data);
    }

    /**
     * Renew subscription
     */
    public function renewSubscription(CompanySubscription $subscription, int $months): bool
    {
        $newEndDate = $subscription->end_date->addMonths($months);

        return $subscription->update([
            'end_date' => $newEndDate,
            'status' => 'active',
        ]);
    }

    /**
     * Cancel subscription
     */
    public function cancelSubscription(CompanySubscription $subscription, string $reason = null): bool
    {
        return $subscription->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
            'cancellation_reason' => $reason,
            'cancelled_by' => 'admin', // or current user
        ]);
    }

    /**
     * Check if company can add users
     */
    public function canAddUsers(Company $company, int $additionalUsers = 1): bool
    {
        $subscription = $this->getActiveSubscription($company->id);

        if (!$subscription) {
            return false;
        }

        $currentUsers = $company->participants()->count();
        return ($currentUsers + $additionalUsers) <= $subscription->total_users;
    }

    /**
     * Get subscription usage statistics
     */
    public function getSubscriptionUsage(CompanySubscription $subscription): array
    {
        $company = $subscription->company;
        $usedUsers = $company->participants()->count();

        return [
            'total_users' => $subscription->total_users,
            'used_users' => $usedUsers,
            'remaining_users' => max(0, $subscription->total_users - $usedUsers),
            'usage_percentage' => $subscription->total_users > 0
                ? round(($usedUsers / $subscription->total_users) * 100, 2)
                : 0,
        ];
    }
}
