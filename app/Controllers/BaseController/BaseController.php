<?php

namespace App\Controllers\BaseController;

use App\Consts\Messages\ErrorMessage;
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
        self::sendError(ErrorMessage::NOT_FOUND, 404);
    }
}