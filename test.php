<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    $p = App\Models\Province::first();
    echo "Province: " . $p->name . " (code: " . $p->code . ")\n";

    $count = App\Models\Province::count();
    echo "Total provinces: " . $count . "\n";

    // Test eager loading
    echo "\nTesting eager loading...\n";
    $provinceWithRegencies = App\Models\Province::with('regencies')->first();
    echo "Province with regencies: " . $provinceWithRegencies->name . " has " . $provinceWithRegencies->regencies->count() . " regencies\n";

    echo "Success! Province model and relationships work correctly.\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
