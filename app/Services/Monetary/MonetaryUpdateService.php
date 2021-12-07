<?php

namespace App\Services\Monetary;

use App\Components\Dto;
use App\Models\Monetary;

/**
 * @property Monetary $monetary
 * @property Dto      $dto
 */
class MonetaryUpdateService
{
    private Monetary $monetary;
    private Dto $dto;

    /**
     * @param Monetary $monetary
     * @param Dto      $dto
     */
    public function __construct(Monetary $monetary, Dto $dto)
    {
        $this->monetary = $monetary;
        $this->dto = $dto;
    }

    /**
     * @return bool
     */
    public function run()
    {
        $this->monetary->max_sum = $this->dto->get('max_sum');
        $this->monetary->interval_from = $this->dto->get('interval_from');
        $this->monetary->interval_to = $this->dto->get('interval_to');

        return $this->monetary->save();
    }
}