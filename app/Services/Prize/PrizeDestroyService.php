<?php

namespace App\Services\Prize;

use App\Consts\Prize\PrizeTypes;
use App\Models\Monetary;
use App\Models\Prize;
use App\Models\Product;

class PrizeDestroyService
{
    private Prize $prize;

    /**
     * @param Prize $prize
     */
    public function __construct(Prize $prize)
    {
        $this->prize = $prize;
    }

    /**
     * @return bool
     */
    public function run()
    {
        $res = false;

        if ($this->prize->type == PrizeTypes::PRODUCT['value']) {
            $res = $this->rollbackProduct($this->prize->prizeable);
        } elseif ($this->prize->type == PrizeTypes::MONETARY['value']) {
            $res = $this->rollbackMonetary($this->prize->prizeable);
        }

        return $res && $this->prize->delete();
    }

    /**
     * @param Product $product
     * @return bool
     */
    private function rollbackProduct(Product $product)
    {
        $product->count++;

        return $product->save();
    }

    /**
     * @param Monetary $monetary
     * @return bool
     */
    private function rollbackMonetary(Monetary $monetary)
    {
        if (!is_null($monetary->max_sum)) {
            $monetary->max_sum += $this->prize->count;
        }

        return $monetary->save();
    }
}