<?php

namespace App\Livewire\SuperAdmin\Dashboard;

use Livewire\Component;

class DashboardIndex extends Component
{
    public function render()
    {
        return view('livewire.super-admin.dashboard.dashboard-index')->layout('components.layouts.app');
    }
}
