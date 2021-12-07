<?php

namespace App\Controllers\Api;

use App\Components\Dto;
use App\Consts\Messages\ErrorMessage;
use App\Consts\Monetary\MonetaryTypes;
use App\Controllers\BaseController\BaseController;
use App\Models\Prize;
use App\Searches\Prize\PrizeSearch;
use App\Services\Monetary\MonetaryConvertService;
use App\Services\Prize\PrizeDestroyService;
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
        }

        self::sendError(ErrorMessage::CREATE, 400);
    }

    public function show(array $attributes)
    {
        $prize = Prize::findOne($attributes['id']);

        self::sendOutput($prize->toArray());
    }

    public function destroy(array $attributes)
    {
        $prize = Prize::findOne($attributes['id']);

        if ($prize->is_received) {
            self::sendError(ErrorMessage::PRIZE_RECEIVE, 400);
        }

        $isSave = (new PrizeDestroyService($prize))->run();

        if ($isSave) {
            self::sendOutput([]);
        }

        self::sendError(ErrorMessage::DELETE, 400);
    }

    public function convert(array $attributes)
    {
        /** @var null|Prize $prize */
        $prize = Prize::getMonetary()->where('id', $attributes['id'])->first();

        if (is_null($prize)) {
            self::sendError(ErrorMessage::PRIZE_CONVERT, 400);
        }

        if ($prize->prizeable->type == MonetaryTypes::REALLY_MONEY) {

            $isSave = (new MonetaryConvertService($prize))->run();

            if ($isSave) {
                self::sendOutput($prize->user->toArray());
            }

            self::sendError(ErrorMessage::CREATE, 400);
        }

        self::sendError(ErrorMessage::MONETARY_TYPE, 400);
    }
}