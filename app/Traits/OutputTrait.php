<?php

namespace App\Traits;

trait OutputTrait
{
    /**
     * @param array $data
     * @param int   $statusCode
     * @param array $httpHeaders
     *
     * @return void
     */
    protected static function sendOutput(array $data, int $statusCode = 200, array $httpHeaders = [])
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

    /**
     * @param string $message
     * @param int    $statusCode
     */
    public static function sendError(string $message, int $statusCode)
    {
        self::sendOutput(['message' => $message], $statusCode);
    }
}