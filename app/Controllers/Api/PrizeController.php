<?php

namespace App\Controllers\Api;

use App\Components\Dto;
use App\Consts\Messages\ErrorMessage;
use App\Controllers\BaseController\BaseController;
use App\Models\Prize;
use App\Searches\Prize\PrizeSearch;
use App\Services\Prize\PrizeStoreService;

class PrizeController extends BaseController
{
    public function index()
    {
        $builder = (new PrizeSearch(new Dto(request()->get('query'))))
            ->getQuery()
            ->with('prizeable');

        self::sendOutput($builder->get()->toArray());
    }

    public function store()
    {
        $prize = new Prize();
        $isSave = (new PrizeStoreService($prize, new Dto(['user_id' => auth()->id])))->run();

        if ($isSave) {
            self::sendOutput($prize->refresh()->toArray());
        } else {
            self::sendError(ErrorMessage::CREATE, 400);
        }
    }

    public function show(array $attributes)
    {
        $prize = Prize::findOne($attributes['id']);

        self::sendOutput($prize->toArray());
    }
}