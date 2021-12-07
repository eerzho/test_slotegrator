<?php

namespace App\Searches\Prize\Filters;

use App\Consts\Prize\PrizeTypes;
use App\Interfaces\Filter\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class Type implements FilterInterface
{
    /**
     * @param Builder $builder
     * @param mixed   $value
     *
     * @return Builder
     */
    public static function apply(Builder $builder, $value): Builder
    {

        $types = PrizeTypes::getArr();

        $key = array_search($value, array_column($types, 'value'));

        if ($key === false) {
            return $builder->where('id', 0);
        }

        return $builder->where('target_class', $types[$key]['class']);
    }
}