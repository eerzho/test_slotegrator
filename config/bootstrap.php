<?php

require_once 'routes/routes.php';

$configPath = __DIR__;
$files = scandir($configPath);
foreach ($files as $file) {
    if (is_file($requirePath = $configPath . '/' . $file)) {
        require_once $requirePath;
    }
}