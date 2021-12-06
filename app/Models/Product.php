<?php

namespace App\Models;

use App\Models\BaseModel\BaseModel;

/**
 * @property string $name
 * @property string $description
 * @property int    $count
 */
class Product extends BaseModel
{
    protected $fillable = [
        'name',
        'description',
        'count',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}