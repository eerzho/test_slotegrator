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

    /**
     * @return array
     */
    public function post()
    {
        $data = file_get_contents('php://input');

        return json_decode($data, true);
    }

    /**
     * @return array
     */
    public function get()
    {
        $query = [];
        if (isset($_SERVER['QUERY_STRING'])) {
            parse_str($_SERVER['QUERY_STRING'], $query);
        }

        return $query;
    }
}