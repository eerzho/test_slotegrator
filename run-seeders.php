<?php

require 'config/bootstrap.php';

$app = new \App\Components\App();
$app->runInConsole();

$seedersPath = __DIR__ . '/database/seeders';

$files = [
    'userSeed',
    'productSeed',
    'monetarySeed',
    'prizeSeed',
];

foreach ($files as $file) {
    if (is_file($requirePath = $seedersPath . '/' . $file. '.php')) {
        echo "RUN: " . $file . "\n";
        require $requirePath;
        echo "FINISH: " . $file . "\n";
    }
}

echo "ALL DONE!\n";