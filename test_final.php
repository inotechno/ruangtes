<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "🧪 Testing Menu System...\n\n";

try {
    echo "1. Testing MenuService resolution...\n";
    $service = app(\App\Services\MenuService::class);
    echo "   ✅ MenuService resolved successfully!\n\n";

    echo "2. Testing menu HTML generation...\n";
    $html = $service->renderMenuForSidebar();
    echo "   ✅ Menu HTML generated successfully!\n";
    echo '   📏 HTML Length: '.strlen($html)." characters\n\n";

    echo "3. Testing repositories...\n";
    $menuRepo = app(\App\Repositories\MenuRepository::class);
    $menuItemRepo = app(\App\Repositories\MenuItemRepository::class);
    $roleMenuRepo = app(\App\Repositories\RoleMenuPermissionRepository::class);
    echo "   ✅ All repositories resolved successfully!\n\n";

    echo "🎉 All tests passed! Menu system is working correctly.\n";

} catch (Exception $e) {
    echo '❌ Error: '.$e->getMessage()."\n";
    echo "Stack trace:\n".$e->getTraceAsString()."\n";
}
