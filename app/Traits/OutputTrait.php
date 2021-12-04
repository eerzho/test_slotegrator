<?php

namespace App\Traits;

trait OutputTrait
{
    /**
     * @param array $data
     * @param int   $statusCode
     * @param array $httpHeaders
     */
    protected function sendOutput(array $data, int $statusCode = 200, array $httpHeaders = [])
    {
        $result = ['data' => $data];
        header_remove('Set-Cookie');
        header('Content-Type: application/json');
        header('HTTP/1.1 ' . $statusCode);

        foreach ($httpHeaders as $httpHeader) {
            header($httpHeader);
        }

        echo json_encode($result);
        exit();
    }
}