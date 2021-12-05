<?php

namespace App\Controllers\Api;

use App\Components\Dto;
use App\Components\Validator;
use App\Consts\Messages\ErrorMessage;
use App\Models\User;
use App\Services\User\UserStoreService;

class UserController extends BaseController
{
    public function index()
    {
        $data = new Dto($this->get());
        $builder = User::query();

        if ($value = $data->get('first_name')) {
            $builder->where('first_name', 'LIKE', '%' . $value . '%');
        }

        if ($value = $data->get('last_name')) {
            $builder->where('last_name', 'LIKE', '%' . $value . '%');
        }

        if ($value = $data->get('email')) {
            $builder->where('email', 'LIKE', '%' . $value . '%');
        }

        if ($value = $data->get('id')) {
            $builder->where('id', $value);
        }

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
        $user = User::query()->where('id', $attributes['id'])->first();

        if (is_null($user)) {
            $this->sendOutput([
                'message' => ErrorMessage::NOT_FOUND
            ], 404);
        } else {
            $this->sendOutput($user->toArray());
        }
    }

    public function update(array $attributes)
    {
        $data = $this->post();

        new Validator([
            'first_name' => ['required', 'str', 'min:3', 'max:255'],
            'last_name'  => ['required', 'str', 'min:3', 'max:255'],
            'email'      => ['required', 'email'],
            'password'   => ['required', 'str', 'min:8', 'max:255']
        ], $data);

        $user = User::query()->where('id', $attributes['id'])->first();

        if (is_null($user)) {
            $this->sendOutput([
                'message' => ErrorMessage::NOT_FOUND
            ], 404);
        } else {

            $isSave = (new UserStoreService($user, new Dto($data)))->run();

            if ($isSave) {
                $this->sendOutput($user->refresh()->toArray());
            } else {
                $this->sendOutput([
                    'message' => ErrorMessage::CREATE
                ], 400);
            }
        }
    }

    public function destroy(array $attributes)
    {
        $user = User::query()->where('id', $attributes['id'])->first();

        if (is_null($user)) {
            $this->sendOutput([
                'message' => ErrorMessage::NOT_FOUND
            ], 404);
        } else {
            $user->delete();

            $this->sendOutput([]);
        }
    }
}