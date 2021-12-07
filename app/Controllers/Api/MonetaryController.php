<?php

namespace App\Controllers\Api;

use App\Components\Dto;
use App\Components\Validator;
use App\Consts\Messages\ErrorMessage;
use App\Consts\Monetary\MonetaryTypes;
use App\Controllers\BaseController\BaseController;
use App\Models\Monetary;
use App\Searches\Monetary\MonetarySearch;
use App\Services\Monetary\MonetaryStoreService;
use App\Services\Monetary\MonetaryUpdateService;

class MonetaryController extends BaseController
{
    public function index()
    {
        $builder = (new MonetarySearch(new Dto(request()->get('query'))))->getQuery();

        self::sendOutput($builder->get()->toArray());
    }

    public function store()
    {
        $data = request()->get('body');

        new Validator([
            'type'          => ['required', 'int'],
            'max_sum'       => ['required', 'int', 'min:1'],
            'interval_from' => ['required', 'int', 'min:1'],
            'interval_to'   => ['required', 'int'],
        ], $data);

        Validator::inArray(MonetaryTypes::getArr(), 'type', $data['type']);
        Validator::max($data['interval_to'], 'interval_to', $data['max_sum']);
        Validator::min($data['interval_to'], 'interval_to', $data['interval_from']);
        Validator::max($data['interval_from'], 'interval_from', $data['interval_to']);

        $monetary = new Monetary();
        $isSave = (new MonetaryStoreService($monetary, new Dto($data)))->run();

        if ($isSave) {
            self::sendOutput($monetary->refresh()->toArray());
        } else {
            self::sendError(ErrorMessage::CREATE, 400);
        }
    }

    public function show(array $attributes)
    {
        $monetary = Monetary::findOne($attributes['id']);

        self::sendOutput($monetary->toArray());
    }

    public function update(array $attributes)
    {
        $data = request()->get('body');

        new Validator([
            'max_sum'       => ['required', 'int', 'min:1'],
            'interval_from' => ['required', 'int', 'min:1'],
            'interval_to'   => ['required', 'int'],
        ], $data);

        Validator::max($data['interval_to'], 'interval_to', $data['max_sum']);
        Validator::min($data['interval_to'], 'interval_to', $data['interval_from']);
        Validator::max($data['interval_from'], 'interval_from', $data['interval_to']);

        $monetary = Monetary::findOne($attributes['id']);
        $isSave = (new MonetaryUpdateService($monetary, new Dto($data)))->run();

        if ($isSave) {
            self::sendOutput($monetary->refresh()->toArray());
        } else {
            self::sendError(ErrorMessage::UPDATE, 400);
        }
    }
}