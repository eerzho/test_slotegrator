<?php

namespace App\Controllers\Api;

use App\Components\Validator;
use App\Consts\Messages\ErrorMessage;
use App\Controllers\BaseController\BaseController;
use App\Models\Token;
use App\Models\User;
use App\Services\Token\TokenStoreService;

class AuthController extends BaseController
{
    public function me()
    {
        $this->sendOutput(auth()->toArray());
    }

    public function login()
    {
        $data = request()->get('body');

        new Validator([
            'email'    => ['required', 'email'],
            'password' => ['required', 'str', 'min:8', 'max:255'],
        ], $data);

        /** @var User|null $user */
        $user = User::query()->where('email', $data['email'])->first();

        if (is_null($user)) {
            self::sendError(ErrorMessage::EMAIL, 400);
        } else {
            if (password_verify($data['password'], $user->password)) {
                $service = new TokenStoreService($user, new Token());
                if ($service->run()) {
                    self::sendOutput([
                        'token' => $service->getSecondPartToken()
                    ]);
                } else {
                    self::sendError(ErrorMessage::CREATE, 400);
                }
            } else {
                self::sendError(ErrorMessage::PASSWORD, 400);
            }
        }
    }
}