<?php

use App\Components\App;
use App\Consts\Monetary\MonetaryTypes;
use App\Consts\Prize\PrizeTypes;
use App\Models\Prize;
use App\Services\Prize\PrizeReceiveService;
use App\Services\User\UserAddBonusService;

require 'vendor/autoload.php';
require 'config/bootstrap.php';

$app = new App();
$app->runInConsole();

$prizes = Prize::query()
    ->where('is_received', false)
    ->where('target_class', PrizeTypes::MONETARY['class'])
    ->with('prizeable')->each(function (Prize $prize) {
        if ($prize->prizeable->type == MonetaryTypes::BONUS) {
            echo "SEND-TO: " . $prize->user->email . "\n";
            (new UserAddBonusService($prize->user, $prize->count))->run();
            (new PrizeReceiveService($prize))->run();
        }
    });

echo "ALL DONE!\n";