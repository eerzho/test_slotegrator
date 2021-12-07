<?php

namespace App\Models;

use App\Models\BaseModel\BaseModel;
use Illuminate\Database\Eloquent\Collection;

/**
 * @property string     $name
 * @property string     $email
 * @property string     $password
 * @property int        $bonus
 * @property Collection $tokens
 * @property Collection $prizes
 */
class User extends BaseModel
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'bonus'
    ];

    protected $hidden = [
        'password',
        'updated_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tokens()
    {
        return $this->hasMany(Token::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prizes()
    {
        return $this->hasMany(Prize::class, 'prize_id');
    }
}