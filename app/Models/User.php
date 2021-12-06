<?php

namespace App\Models;

use App\Models\BaseModel\BaseModel;

/**
 * @property string $name
 * @property string $email
 * @property string $password
 */
class User extends BaseModel
{
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tokens()
    {
        return $this->hasMany(Token::class, 'user_id');
    }
}