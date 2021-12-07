<?php

namespace App\Models;

use App\Models\BaseModel\BaseModel;
use Illuminate\Database\Eloquent\Collection;

/**
 * @property string     $name
 * @property string     $description
 * @property int        $count
 * @property Collection $prizes
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function prizes()
    {
        return $this->morphMany(Prize::class, 'prizeable', 'target_class', 'target_id');
    }
}