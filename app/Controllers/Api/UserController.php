<?php

namespace App\Controllers\Api;

use App\Components\Dto;
use App\Components\Validator;
use App\Consts\Messages\ErrorMessage;
use App\Models\User;
use App\Searches\User\UserSearch;
use App\Services\User\UserStoreService;

class UserController extends BaseController
{
    public function index()
    {
        $data = new Dto($this->get());

        $builder = (new UserSearch($data))->getQuery();

        $this->sendOutput($builder->get());
    }

    public function store()
    {
        $data = $this->post();

        new Validator([
            'first_name' => ['required', 'str', 'min:3', 'max:255'],
            'last_name'  => ['required', 'str', 'min:3', 'max:255'],
            'email'      => ['required', 'email'],
            'password'   => ['required', 'str', 'min:8', 'max:255']
        ], $data);

        $user = new User();
        $isSave = (new UserStoreService($user, new Dto($data)))->run();

        if ($isSave) {
            $this->sendOutput($user->refresh()->toArray());
        } else {
            $this->sendOutput([
                'message' => ErrorMessage::CREATE
            ], 400);
        }
    }

    public function show(array $attributes)
    {
        $user = User::findOne($attributes['id']);

        $this->sendOutput($user->toArray());
    }

    /**
     * @param array $attributes
     */
    public function update(array $attributes)
    {
        $data = $this->post();

        new Validator([
            'first_name' => ['required', 'str', 'min:3', 'max:255'],
            'last_name'  => ['required', 'str', 'min:3', 'max:255'],
            'email'      => ['required', 'email'],
            'password'   => ['required', 'str', 'min:8', 'max:255']
        ], $data);

        $user = User::findOne($attributes['id']);

        $isSave = (new UserStoreService($user, new Dto($data)))->run();

        if ($isSave) {
            $this->sendOutput($user->refresh()->toArray());
        } else {
            $this->sendOutput([
                'message' => ErrorMessage::CREATE
            ], 400);
        }
    }

    /**
     * @param array $attributes
     */
    public function destroy(array $attributes)
    {
        $user = User::findOne($attributes['id']);

        $user->delete();

        $this->sendOutput([]);
    }
}