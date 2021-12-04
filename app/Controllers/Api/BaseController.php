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
//    /**
//     * Get URI elements.
//     *
//     * @return array
//     */
//    protected function getUriSegments()
//    {
//        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//        $uri = explode('/', $uri);
//
//        return $uri;
//    }
//
//    /**
//     * Get querystring params.
//     *
//     * @return void
//     */
//    protected function getQueryStringParams()
//    {
//        return parse_str($_SERVER['QUERY_STRING'], $query);
//    }

    //    /**
    //     * Send API output.
    //     *
    //     * @param mixed $data
    //     * @param array $httpHeaders
    //     */
    //    protected function sendOutput($data, array $httpHeaders = [])
    //    {
    //        header_remove('Set-Cookie');
    //
    //        if (is_array($httpHeaders) && count($httpHeaders)) {
    //            foreach ($httpHeaders as $httpHeader) {
    //                header($httpHeader);
    //            }
    //        }
    //
    //        echo $data;
    //        exit;
    //    }
}