<?php

namespace App\Models\BaseModel;

use App\Components\DateFormatHelper;
use App\Consts\Messages\ErrorMessage;
use App\Traits\OutputTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $id
 * @property string $created_at
 * @property string $updated_at
 */
class BaseModel extends Model
{
    use OutputTrait;

    protected $casts = [
        'created_at' => DateFormatHelper::CAST_DATETIME_FORMAT,
        'updated_at' => DateFormatHelper::CAST_DATETIME_FORMAT,
    ];

    /**
     * @param int $id
     *
     * @return static
     */
    public static function findOne(int $id)
    {
        $user = static::query()->where('id', $id)->first();

        if (is_null($user)) {
            self::sendOutput([
                'message' => ErrorMessage::NOT_FOUND
            ], 404);
        }

        return $user;
    }
}