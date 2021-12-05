<?php

namespace App\Controllers\Api;

use App\Components\Validator;
use App\Consts\Messages\ErrorMessage;
use App\Models\Token;
use App\Models\User;
use App\Services\Token\TokenStoreService;

class AuthController extends BaseController
{
    public function login()
    {
        $data = $this->post();

        new Validator([
            'email'    => ['required', 'email'],
            'password' => ['required', 'str', 'min:8', 'max:255'],
        ], $data);

        /** @var User|null $user */
        $user = User::query()->where('email', $data['email'])->first();

        if (is_null($user)) {
            $this->sendOutput([
                'message' => ErrorMessage::EMAIL
            ], 400);
        } else {
            if (password_verify($data['password'], $user->password)) {
                $service = new TokenStoreService($user, new Token());
                if ($service->run()) {
                    $this->sendOutput([
                        'token' => $service->getSecondPartToken()
                    ]);
                } else {
                    $this->sendOutput([
                        'message' => ErrorMessage::CREATE
                    ], 400);
                }
            } else {
                $this->sendOutput([
                    'message' => ErrorMessage::PASSWORD
                ], 400);
            }
        }
    }
}