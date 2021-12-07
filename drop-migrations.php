<?php

use Illuminate\Database\Capsule\Manager;

require 'config/bootstrap.php';

$app = new \App\Components\App();
$app->runInConsole();

Manager::schema()->dropAllTables();

echo "ALL DONE! \n";