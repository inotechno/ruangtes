<?php

namespace App\Repositories;

use App\Models\Test;
use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class TestRepository extends BaseRepository
{
    public function __construct(Test $test)
    {
        parent::__construct($test);
    }

    /**
     * Get published tests
     */
    public function getPublishedTests(): Collection
    {
        return $this->model->published()->get();
    }

    /**
     * Get active tests
     */
    public function getActiveTests(): Collection
    {
        return $this->model->active()->get();
    }

    /**
     * Get public tests
     */
    public function getPublicTests(): Collection
    {
        return $this->model->public()->active()->published()->get();
    }

    /**
     * Get company tests
     */
    public function getCompanyTests(): Collection
    {
        return $this->model->company()->active()->published()->get();
    }

    /**
     * Get tests by category
     */
    public function getTestsByCategory(int $categoryId): Collection
    {
        return $this->model->where('category_id', $categoryId)->active()->get();
    }

    /**
     * Find test by code
     */
    public function findByCode(string $code): ?Test
    {
        return $this->model->where('code', $code)->first();
    }

    /**
     * Find test by slug
     */
    public function findBySlug(string $slug): ?Test
    {
        return $this->model->where('slug', $slug)->first();
    }

    /**
     * Get test with handler
     */
    public function getTestWithHandler(string $code): ?Test
    {
        $test = $this->findByCode($code);
        return $test && $test->getTestHandler() ? $test : null;
    }

    /**
     * Get tests available for company
     */
    public function getAvailableForCompany(?Company $company = null): Collection
    {
        $query = $this->model->active()->published();

        if ($company) {
            $query->where(function($q) {
                $q->where('type', 'all')
                  ->orWhere('type', 'company');
            });
        } else {
            $query->where(function($q) {
                $q->where('type', 'all')
                  ->orWhere('type', 'public');
            });
        }

        return $query->get();
    }

    /**
     * Get effective price for test
     */
    public function getEffectivePrice(Test $test, ?Company $company = null): float
    {
        return $test->getEffectivePrice($company);
    }

    /**
     * Search tests by name or description
     */
    public function search(string $query): Collection
    {
        return $this->model->where(function($q) use ($query) {
            $q->where('name', 'like', "%{$query}%")
              ->orWhere('description', 'like', "%{$query}%")
              ->orWhere('short_description', 'like', "%{$query}%");
        })->active()->get();
    }

    /**
     * Get tests with categories
     */
    public function getTestsWithCategories(): Collection
    {
        return $this->model->with('category')->active()->get();
    }

    /**
     * Get featured tests
     */
    public function getFeaturedTests(int $limit = 10): Collection
    {
        return $this->model->active()->published()
            ->orderBy('total_attempts', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Update test statistics
     */
    public function updateStatistics(Test $test): bool
    {
        $stats = [
            'total_attempts' => $test->attempts()->count(),
            'average_score' => $test->attempts()->avg('raw_score'),
            'average_completion_time' => $test->attempts()
                ->whereNotNull('submitted_at')
                ->selectRaw('AVG(TIMESTAMPDIFF(MINUTE, test_started_at, submitted_at)) as avg_time')
                ->first()?->avg_time ?? 0,
        ];

        return $test->update($stats);
    }

    /**
     * Get tests with statistics
     */
    public function getTestsWithStats(): Collection
    {
        return $this->model->with(['category', 'attempts' => function($query) {
            $query->selectRaw('test_id, COUNT(*) as attempts_count, AVG(raw_score) as avg_score')
                  ->groupBy('test_id');
        }])->active()->get();
    }
}
