<?php

namespace App\Repositories;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Eloquent\Collection;

class SubscriptionPlanRepository extends BaseRepository
{
    public function __construct(SubscriptionPlan $subscriptionPlan)
    {
        parent::__construct($subscriptionPlan);
    }

    /**
     * Get active plans
     */
    public function getActivePlans(): Collection
    {
        return $this->model->where('is_active', true)->orderBy('display_order')->get();
    }

    /**
     * Get featured plans
     */
    public function getFeaturedPlans(): Collection
    {
        return $this->model->where('is_featured', true)
            ->where('is_active', true)
            ->orderBy('display_order')
            ->get();
    }

    /**
     * Find plan by code
     */
    public function findByCode(string $code): ?SubscriptionPlan
    {
        return $this->model->where('code', $code)->first();
    }

    /**
     * Get plans by billing cycle
     */
    public function getPlansByBillingCycle(string $cycle): Collection
    {
        return $this->model->where('billing_cycle', $cycle)
            ->where('is_active', true)
            ->get();
    }

    /**
     * Calculate plan price
     */
    public function calculatePrice(SubscriptionPlan $plan, int $userCount): float
    {
        $config = $plan->price_configuration ?? [];

        // Implementation depends on your pricing logic
        // This is a basic example
        $basePrice = $config['base_price'] ?? 0;
        $perUserPrice = $config['per_user_price'] ?? 0;

        return $basePrice + ($perUserPrice * $userCount);
    }
}
