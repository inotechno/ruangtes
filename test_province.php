<?php

require 'vendor/autoload.php';

echo "Testing Province model...\n";

try {
    $provinces = App\Models\Province::with(['regencies'])->take(3)->get();
    echo "Success! Found " . $provinces->count() . " provinces with relationships loaded.\n";

    foreach ($provinces as $province) {
        echo "- {$province->name} ({$province->code}) has {$province->regencies->count()} regencies\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
