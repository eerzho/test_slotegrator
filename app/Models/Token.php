<?php

namespace App\Models;

use App\Models\BaseModel\BaseModel;

/**
 * @property string    $first_part_token
 * @property int       $user_id
 * @property-read User $user
 */
class Token extends BaseModel
{
    protected $fillable = [
        'first_part_token',
        'user_id'
    ];

    protected $hidden = [
        'first_part_token'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}