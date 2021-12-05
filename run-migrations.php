<?php

require 'vendor/autoload.php';
require 'config/bootstrap.php';

$app = new \App\Components\App();
$app->runInConsole();

$migrationsPath = __DIR__ . '/database/migrations';
$files = scandir($migrationsPath);
foreach ($files as $file) {
    if (is_file($requirePath = $migrationsPath . '/' . $file)) {
        echo "RUN: " . $file . "\n";
        require $requirePath;
    }
}

echo "FINISH \n";
