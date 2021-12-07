<?php

namespace App\Services\User;

use App\Models\User;

/**
 * @property User $user
 * @property int  $bonus
 */
class UserAddBonusService
{
    private User $user;
    private int $bonus;

    /**
     * @param User $user
     * @param int  $bonus
     */
    public function __construct(User $user, int $bonus)
    {
        $this->user = $user;
        $this->bonus = $bonus;
    }

    public function run()
    {
        $this->user->bonus += $this->bonus;

        return $this->user->save();
    }
}