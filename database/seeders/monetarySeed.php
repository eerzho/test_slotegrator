<?php

$types = \App\Consts\Monetary\MonetaryTypes::getArr();

foreach ($types as $type) {
    \App\Models\Monetary::query()->create([
        'type'          => $type,
        'interval_from' => 5000,
        'interval_to'   => 20000,
        'max_sum'       => $type == \App\Consts\Monetary\MonetaryTypes::BONUS ? null : 100000,
    ]);
}