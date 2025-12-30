<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuItem extends Component
{
    public array $menu;
    /**
     * Create a new component instance.
     */
    public function __construct(array $menu)
    {
        $this->menu = $menu;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu-item', [
            'menu' => $this->menu
        ]);
    }
}
