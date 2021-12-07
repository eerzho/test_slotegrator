<?php

namespace App\Services\Monetary;

use App\Models\Prize;

class MonetaryConvertService
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
        $this->prize->user->bonus += ($this->prize->count * 2);
        $this->prize->is_received = true;

        return $this->prize->user->save() && $this->prize->save();
    }
}