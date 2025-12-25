<?php

namespace App\Repositories;

use App\Models\TestCategory;
use Illuminate\Database\Eloquent\Collection;

class TestCategoryRepository extends BaseRepository
{
    public function __construct(TestCategory $testCategory)
    {
        parent::__construct($testCategory);
    }

    /**
     * Get all categories with tests count
     */
    public function getCategoriesWithTestsCount(): Collection
    {
        return $this->model->withCount('tests')->get();
    }

    /**
     * Get active categories
     */
    public function getActiveCategories(): Collection
    {
        return $this->model->whereHas('tests', function($query) {
            $query->where('is_active', true);
        })->get();
    }

    /**
     * Find category by slug
     */
    public function findBySlug(string $slug): ?TestCategory
    {
        return $this->model->where('slug', $slug)->first();
    }

    /**
     * Get category tree (if hierarchical)
     */
    public function getCategoryTree(): Collection
    {
        // If you have parent-child relationship, implement tree structure
        return $this->model->orderBy('name')->get();
    }

    /**
     * Get categories with their tests
     */
    public function getCategoriesWithTests(): Collection
    {
        return $this->model->with(['tests' => function($query) {
            $query->active()->published()->orderBy('name');
        }])->get();
    }
}
