<?php

namespace App\Services\User;

use App\Components\Dto;
use App\Models\User;

class UserStoreService
{
    private User $user;
    private Dto $data;

    /**
     * @param User $user
     * @param Dto  $data
     */
    public function __construct(User $user, Dto $data)
    {
        $this->user = $user;
        $this->data = $data;
    }

    /**
     * @return bool
     */
    public function run()
    {
        $this->user->name = $this->data->get('name');
        $this->user->email = $this->data->get('email');
        $this->user->password = password_hash($this->data->get('password'), PASSWORD_BCRYPT);

        return $this->user->save();
    }
}