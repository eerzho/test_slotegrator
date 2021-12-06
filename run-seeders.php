<?php

require 'vendor/autoload.php';
require 'config/bootstrap.php';

$app = new \App\Components\App();
$app->runInConsole();

$seedersPath = __DIR__ . '/database/seeders';
$files = scandir($seedersPath);
foreach ($files as $file) {
    if (is_file($requirePath = $seedersPath . '/' . $file)) {
        echo "RUN: " . $file . "\n";
        require $requirePath;
        echo "FINISH: " . $file . "\n";
    }
}

echo "ALL DONE!";