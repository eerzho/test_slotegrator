<?php

namespace App\Controllers\Api;

use App\Components\Dto;
use App\Components\Validator;
use App\Consts\Messages\ErrorMessage;
use App\Controllers\BaseController\BaseController;
use App\Models\User;
use App\Searches\User\UserSearch;
use App\Services\User\UserStoreService;

class UserController extends BaseController
{
    public function index()
    {
        $builder = (new UserSearch(new Dto(request()->get('query'))))->getQuery();

        self::sendOutput($builder->get()->toArray());
    }

    public function store()
    {
        $data = request()->get('body');

        new Validator([
            'name'     => ['required', 'str', 'min:3', 'max:255'],
            'email'    => ['required', 'email'],
            'password' => ['required', 'str', 'min:8', 'max:255']
        ], $data);

        $user = new User();
        $isSave = (new UserStoreService($user, new Dto($data)))->run();

        if ($isSave) {
            self::sendOutput($user->refresh()->toArray());
        }

        self::sendError(ErrorMessage::CREATE, 400);
    }

    public function show(array $attributes)
    {
        $user = User::findOne($attributes['id']);

        self::sendOutput($user->toArray());
    }

    /**
     * @param array $attributes
     */
    public function update(array $attributes)
    {
        $data = request()->get('body');

        new Validator([
            'name'     => ['required', 'str', 'min:3', 'max:255'],
            'email'    => ['required', 'email'],
            'password' => ['required', 'str', 'min:8', 'max:255']
        ], $data);

        $user = User::findOne($attributes['id']);

        $isSave = (new UserStoreService($user, new Dto($data)))->run();

        if ($isSave) {
            self::sendOutput($user->refresh()->toArray());
        }

        self::sendError(ErrorMessage::UPDATE, 400);
    }

    /**
     * @param array $attributes
     */
    public function destroy(array $attributes)
    {
        $user = User::findOne($attributes['id']);

        if ($user->delete()) {
            self::sendOutput([]);
        }

        self::sendError(ErrorMessage::DELETE, 400);
    }
}