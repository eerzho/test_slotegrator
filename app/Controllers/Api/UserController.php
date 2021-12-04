<?php

namespace App\Controllers\Api;

use App\Components\Validator;
use App\Models\User;

class UserController extends BaseController
{
    public function index()
    {
        $result = (new User())->search($this->get());
        $this->sendOutput($result);
    }

    public function store()
    {
        $data = $this->post();
//        $hash = password_hash($data['password'], PASSWORD_BCRYPT);
//        $res = password_verify('password', $hash);
//
//        exit();

        new Validator([
            'first_name' => ['required', 'str', 'min:3', 'max:255'],
            'last_name'  => ['required', 'str', 'min:3', 'max:255'],
            'username'   => ['required', 'str', 'min:3', 'max:255'],
            'email'      => ['required', 'email'],
            'password'   => ['required', 'str', 'min:8', 'max:255']
        ], $data);

        $user = (new User())->create([
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'username'   => $data['username'],
            'email'      => $data['email'],
            'password'   => $data['password'],
        ]);

        $this->sendOutput($user);
    }

    public function show()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}