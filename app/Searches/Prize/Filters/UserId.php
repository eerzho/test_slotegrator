<?php

namespace App\Searches\Prize\Filters;

use App\Interfaces\Filter\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class UserId implements FilterInterface
{
    /**
     * @param Builder $builder
     * @param mixed   $value
     *
     * @return Builder
     */
    public static function apply(Builder $builder, $value): Builder
    {
        return $builder->where('user_id', $value);
    }
}