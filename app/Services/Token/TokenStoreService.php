<?php

namespace App\Services\Token;

use App\Models\Token;
use App\Models\User;

/**
 * @property User  $user
 * @property Token $token
 */
class TokenStoreService
{
    private User $user;
    private Token $token;
    private string $secondPartToken;

    /**
     * @param User  $user
     * @param Token $token
     */
    public function __construct(User $user, Token $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * @return bool
     */
    public function run()
    {
        $fullSecretWord = $this->user->password . TOKEN_SECRECT_WORD;
        $fullToken = password_hash($fullSecretWord, PASSWORD_BCRYPT);

        $middle = strlen($fullToken) / 2;
        $this->token->first_part_token = substr($fullToken, 0, $middle);
        $this->secondPartToken = substr($fullToken, $middle);

        $this->token->user_id = $this->user->id;

        return $this->token->save();
    }

    /**
     * @return string
     */
    public function getSecondPartToken()
    {
        return $this->secondPartToken;
    }
}