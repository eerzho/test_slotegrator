<?php

namespace App\Models;

use App\Consts\Prize\PrizeTypes;
use App\Models\BaseModel\BaseModel;

/**
 * @property int    $user_id
 * @property int    $target_id
 * @property string $target_class
 * @property int    $count
 */
class Prize extends BaseModel
{
    protected $fillable = [
        'user_id',
        'target_id',
        'target_class',
        'count',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'target_class',
    ];

    protected $appends = [
        'type'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function prizeable()
    {
        return $this->morphTo(null, 'target_class', 'target_id', 'id');
    }

    /**
     * @return int
     */
    public function getTypeAttribute()
    {
        $types = PrizeTypes::getArr();

        $key = array_search($this->target_class, array_column($types, 'class'));

        return $types[$key]['value'];
    }
}