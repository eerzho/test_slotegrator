<?php

namespace App\Models\BaseModel;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $id
 * @property string $created_at
 * @property string $updated_at
 */
class BaseModel extends Model
{
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:Y-m-d H:i',
    ];
}