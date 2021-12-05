<?php

namespace App\Models;

use App\Models\BaseModel\BaseModel;

/**
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 */
class User extends BaseModel
{
    protected $fillable = [
        'fist_name',
        'last_name',
        'email',
        'password'
    ];
}