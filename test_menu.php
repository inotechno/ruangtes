<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Testing MenuService...\n";

try {
    $service = app(\App\Services\MenuService::class);
    echo "MenuService resolved successfully!\n";

    $html = $service->renderMenuForSidebar();
    echo "Menu HTML generated successfully!\n";
    echo 'HTML Length: '.strlen($html)."\n";

    echo "✅ All tests passed!\n";
} catch (Exception $e) {
    echo '❌ Error: '.$e->getMessage()."\n";
    echo "Stack trace:\n".$e->getTraceAsString()."\n";
}
