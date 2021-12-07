<?php

namespace App\Models;

use App\Models\BaseModel\BaseModel;

/**
 * @property int $type
 * @property int $interval_from
 * @property int $interval_to
 * @property int $max_sum
 */
class Monetary extends BaseModel
{
    protected $fillable = [
        'type',
        'interval_from',
        'interval_to',
        'max_sum'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function prizes()
    {
        return $this->morphMany(Prize::class, 'prizeable', 'target_class', 'target_id');
    }

    /**
     * @param int $type
     *
     * @return Monetary
     */
    public static function getByType(int $type)
    {
        return self::query()->where('type', $type)->first();
    }
}