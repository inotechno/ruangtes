<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\RoleMenuPermission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'is_title' => true,
                'name' => 'Dashboard',
                'icon' => 'bx bx-home-circle',
                'route' => null,
                'url' => '#',
                'parent_id' => null,
                'order' => 1,
                'is_active' => true,
                'roles' => ['SUPER_ADMIN'],
                'children' => [
                    [
                        'name' => 'Analytics',
                        'icon' => 'bx bx-chart',
                        'route' => 'dashboard.analytics',
                        'url' => '#',
                        'parent_id' => 1,
                        'order' => 2,
                        'is_active' => true,
                        'roles' => ['SUPER_ADMIN'],
                    ],
                    [
                        'name' => 'System',
                        'icon' => 'bx bx-cog',
                        'route' => 'dashboard.system',
                        'url' => '#',
                        'parent_id' => 1,
                        'order' => 3,
                        'is_active' => true,
                        'roles' => ['SUPER_ADMIN'],
                    ],
                    [
                        'name' => 'Users',
                        'icon' => 'bx bx-user',
                        'route' => 'dashboard.users',
                        'url' => '#',
                        'parent_id' => 1,
                        'order' => 4,
                        'is_active' => true,
                        'roles' => ['SUPER_ADMIN'],
                    ],
                    [
                        'name' => 'Companies',
                        'icon' => 'bx bx-building-house',
                        'route' => 'dashboard.companies',
                        'url' => '#',
                        'parent_id' => 1,
                        'order' => 5,
                        'is_active' => true,
                        'roles' => ['SUPER_ADMIN'],
                    ]
                ]
            ],
            [
                'is_title' => true,
                'name' => 'Master Data',
                'icon' => 'bx bx-database',
                'route' => null,
                'url' => '#',
                'parent_id' => null,
                'order' => 2,
                'is_active' => true,
                'roles' => ['SUPER_ADMIN'],
                'children' => [
                    [
                        'name' => 'Users',
                        'icon' => 'bx bx-user',
                        'route' => 'master-data.users',
                        'url' => '#',
                        'parent_id' => 2,
                        'order' => 1,
                        'is_active' => true,
                        'roles' => ['SUPER_ADMIN'],
                    ],
                    [
                        'name' => 'Companies',
                        'icon' => 'bx bx-building-house',
                        'route' => 'master-data.companies',
                        'url' => '#',
                        'parent_id' => 2,
                        'order' => 2,
                        'is_active' => true,
                        'roles' => ['SUPER_ADMIN'],
                    ],
                    [
                        'name' => 'Test Categories',
                        'icon' => 'bx bx-category',
                        'route' => 'master-data.test-categories',
                        'url' => '#',
                        'parent_id' => 2,
                        'order' => 3,
                        'is_active' => true,
                        'roles' => ['SUPER_ADMIN'],
                    ],
                    [
                        'name' => 'Tests',
                        'icon' => 'bx bx-book-open',
                        'route' => 'master-data.tests',
                        'url' => '#',
                        'parent_id' => 2,
                        'order' => 4,
                        'is_active' => true,
                        'roles' => ['SUPER_ADMIN'],
                    ],
                    [
                        'name' => 'Questions',
                        'icon' => 'bx bx-question-mark',
                        'route' => 'master-data.questions',
                        'url' => '#',
                        'parent_id' => 2,
                        'order' => 5,
                        'is_active' => true,
                        'roles' => ['SUPER_ADMIN'],
                    ],
                    [
                        'name' => 'Email Templates',
                        'icon' => 'bx bx-envelope',
                        'route' => 'master-data.email-templates',
                        'url' => '#',
                        'parent_id' => 2,
                        'order' => 6,
                        'is_active' => true,
                        'roles' => ['SUPER_ADMIN'],
                    ],
                    [
                        'name' => 'Subscription Plans',
                        'icon' => 'bx bx-package',
                        'route' => 'master-data.subscription-plans',
                        'url' => '#',
                        'parent_id' => 2,
                        'order' => 7,
                        'is_active' => true,
                        'roles' => ['SUPER_ADMIN'],
                    ]
                ],
            ],
            [
                'is_title' => true,
                'name' => 'Settings',
                'icon' => 'bx bx-cog',
                'route' => 'settings.index',
                'url' => '#',
                'parent_id' => null,
                'order' => 3,
                'is_active' => true,
                'roles' => ['SUPER_ADMIN'],
                'children' => [
                    [
                        'name' => 'General',
                        'icon' => 'bx bx-cog',
                        'route' => 'settings.general',
                        'url' => '#',
                        'parent_id' => 3,
                        'order' => 1,
                        'is_active' => true,
                        'roles' => ['SUPER_ADMIN'],
                    ],
                ]
            ]
        ];

        foreach ($menus as $menuData) {

            $children = $menuData['children'] ?? [];
            unset($menuData['children']); // ⬅️ WAJIB
        
            $menu = Menu::create($menuData);
        
            foreach ($children as $childData) {
                $childData['parent_id'] = $menu->id;
                Menu::create($childData);
            }
        }
    }
}
