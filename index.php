<?php

require 'vendor/autoload.php';
require_once 'config/bootstrap.php';

$app = new \App\Components\App();
$app->run($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
