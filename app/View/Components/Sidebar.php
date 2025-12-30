<?php

namespace App\View\Components;

use App\Services\MenuService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public $menuTree = [];
    
    protected $menuService;

    public function boot(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function mount()
    {
        dd('sidebar');
        $this->loadMenus();
    }

    public function loadMenus()
    {
        $user = Auth::user();
        if ($user) {
            $this->menuTree = $this->menuService->getMenuTree($user);
        }

        dd($this->menuTree);
    }

    public function render()
    {
        return view('components.sidebar', [
            'menus' => $this->menuTree
        ]);
    }
}
