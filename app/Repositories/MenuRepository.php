<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;

class MenuRepository
{
    protected $model;

    public function __construct(Menu $menu)
    {
        $this->model = $menu;
    }

    /**
     * Get all active menus
     */
    public function getAllActive(): Collection
    {
        return Cache::remember('menus.all.active', 3600, function () {
            return $this->model->active()->orderBy('order')->with('roles')->get();
        });
    }

    /**
     * Get menus for specific user based on permissions
     */
    public function getMenusForUser(User $user): Collection
    {
        $cacheKey = 'menus.user.' . $user->id;

        return Cache::remember($cacheKey, 300, function () use ($user) {
            $allMenus = $this->getAllActive();

            // Filter menus berdasarkan permission user
            return $allMenus->filter(function ($menu) use ($user) {
                return in_array($user->roles->pluck('name')->toArray(), $menu->roles ?? []);
            });
        });
    }

    /**
     * Get parent menus
     */
    public function getParentMenus(): Collection
    {
        return $this->model->active()->parent()->orderBy('order')->with('roles')->get();
    }

    /**
     * Get child menus by parent ID
     */
    public function getChildMenus(int $parentId): Collection
    {
        return $this->model->active()
            ->where('parent_id', $parentId)
            ->orderBy('order')
            ->with('roles')
            ->get();
    }

    /**
     * Create new menu
     */
    public function create(array $data)
    {
        $menu = $this->model->create($data);
        $this->clearCache();
        return $menu;
    }

    /**
     * Update menu
     */
    public function update(int $id, array $data): bool
    {
        $menu = $this->find($id);
        if (!$menu) {
            return false;
        }

        $result = $menu->update($data);
        $this->clearCache();
        return $result;
    }

    /**
     * Delete menu
     */
    public function delete(int $id): bool
    {
        $menu = $this->find($id);
        if (!$menu) {
            return false;
        }

        // Delete all children first
        $this->model->where('parent_id', $id)->delete();

        $result = $menu->delete();
        $this->clearCache();
        return $result;
    }

    /**
     * Find menu by ID
     */
    public function find(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * Reorder menus
     */
    public function reorder(array $order): bool
    {
        foreach ($order as $item) {
            $this->model->where('id', $item['id'])->update(['order' => $item['order']]);
        }

        $this->clearCache();
        return true;
    }

    /**
     * Get menu tree for user
     */
    public function getMenuTreeForUser(User $user)
    {
        $roles = $user->roles->pluck('name');

        return Menu::active()
            ->where(function ($q) use ($roles) {
                $q->whereNull('roles')
                    ->orWhereJsonContains('roles', $roles);
            })
            ->with([
                'children' => function ($q) use ($roles) {
                    $q->active()
                        ->where(function ($q) use ($roles) {
                            $q->whereNull('roles')
                                ->orWhereJsonContains('roles', $roles);
                        })
                        ->orderBy('order');
                }
            ])
            ->parent()
            ->orderBy('order')
            ->get();
    }


    /**
     * Check if user can access menu
     */
    private function userCanAccessMenu(Menu $menu, User $user): bool
    {
        // Jika menu tidak ada permission requirement
        if (empty($menu->permissions)) {
            return true;
        }

        // Check jika user punya salah satu permission yang dibutuhkan
        foreach ($menu->permissions as $permission) {
            if ($user->can($permission)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Clear all menu caches
     */
    private function clearCache(): void
    {
        Cache::forget('menus.all.active');

        // Clear user-specific caches
        $keys = Cache::getStore()->getPrefix() . 'menus.user.*';
        // Note: Untuk production, gunakan cache tag atau Redis scan
    }
}
