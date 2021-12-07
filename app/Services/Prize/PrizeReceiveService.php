<?php

namespace App\Services\Prize;

use App\Models\Prize;

/**
 * @property Prize $prize
 */
class PrizeReceiveService
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
        $this->prize->is_received = true;

        return $this->prize->save();
    }
}