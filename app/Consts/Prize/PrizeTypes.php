<?php

namespace App\Consts\Prize;

use App\Consts\BaseConst\BaseConst;
use App\Models\Monetary;
use App\Models\Product;

class PrizeTypes extends BaseConst
{
    const PRODUCT = [
        'class' => Product::class,
        'value' => 1
    ];

    const MONETARY = [
        'class' => Monetary::class,
        'value' => 2,
    ];
}