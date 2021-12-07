<?php

namespace App\Services\Prize;

use App\Components\Dto;
use App\Consts\Monetary\MonetaryTypes;
use App\Models\Monetary;
use App\Models\Prize;
use App\Models\Product;

/**
 * @property Prize $prize
 * @property Dto   $dto
 */
class PrizeStoreService
{
    private Prize $prize;
    private Dto $dto;

    /**
     * @param Prize $prize
     * @param Dto   $dto
     */
    public function __construct(Prize $prize, Dto $dto)
    {
        $this->prize = $prize;
        $this->dto = $dto;
    }

    public function run()
    {
        $this->prize->user_id = $this->dto->get('user_id');

        return rand(0, 1) ? $this->saveProduct() : $this->saveMonetary();
    }

    /**
     * @return bool
     */
    private function saveProduct()
    {
        /** @var Product $product */
        $product = Product::query()
            ->where('count', '>', 0)
            ->inRandomOrder()
            ->first();

        $this->prize->target_id = $product->getKey();
        $this->prize->target_class = $product->getMorphClass();

        $product->count--;

        return $this->prize->save() && $product->save();
    }

    /**
     * @return bool
     */
    private function saveMonetary()
    {
        /** @var Monetary $monetary */
        $monetary = Monetary::query()
            ->where('max_sum', '>', 0)
            ->orWhereNull('max_sum')
            ->inRandomOrder()
            ->first();

        $this->prize->target_id = $monetary->getKey();
        $this->prize->target_class = $monetary->getMorphClass();

        $randCount = rand($monetary->interval_from, $monetary->interval_to);

        if (!is_null($monetary->max_sum)) {
            $randCount = $randCount > $monetary->max_sum ? $monetary->max_sum : $randCount;
            $monetary->max_sum -= $randCount;
        }

        $this->prize->count = $randCount;

        return $this->prize->save() && $monetary->save();
    }
}