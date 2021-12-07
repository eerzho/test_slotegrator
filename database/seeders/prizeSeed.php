<?php

use App\Components\Dto;
use App\Models\Prize;
use App\Models\User;
use App\Services\Prize\PrizeStoreService;

User::query()->each(function (User $user) {
    (new PrizeStoreService(new Prize(), new Dto(['user_id' => $user->id])))->run();
});