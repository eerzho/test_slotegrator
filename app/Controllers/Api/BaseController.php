<?php

namespace App\Controllers\Api;

use App\Traits\OutputTrait;

class BaseController
{
    use OutputTrait;

    /**
     * @param string $name
     * @param array  $arguments
     */
    public function __call(string $name, array $arguments)
    {
        $this->sendOutput([
            'message' => 'Not fount'
        ], 404);
    }
}