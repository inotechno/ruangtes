<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\MenuRepository;
use Illuminate\Support\Collection;

class MenuService
{
    protected $menuRepository;

    public function __construct(MenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    /**
     * Get menu tree for user
     */
    public function getMenuTree(User $user)
    {
        return $this->menuRepository->getMenuTreeForUser($user);
    }

    /**
     * Create new menu with validation
     */
    public function createMenu(array $data)
    {
        return $this->menuRepository->create($data);
    }

    /**
     * Update menu with validation
     */
    public function updateMenu(int $id, array $data): bool
    {
        return $this->menuRepository->update($id, $data);
    }

    /**
     * Reorder menus with validation
     */
    public function reorderMenus(array $order): bool
    {
        return $this->menuRepository->reorder($order);
    }

    /**
     * Get menu for admin management
     */
    public function getMenuForManagement(): Collection
    {
        return $this->menuRepository->getAllActive();
    }

    /**
     * Check if user has access to specific route
     */
    public function userHasAccessToRoute(User $user, string $route): bool
    {
        $menus = $this->menuRepository->getMenusForUser($user);
        
        return $menus->contains(function ($menu) use ($route) {
            return $menu->route === $route;
        });
    }
}
