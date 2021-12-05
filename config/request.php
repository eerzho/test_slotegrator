<?php

/**
 * @return \App\Components\Dto
 */
function request()
{
    $body = file_get_contents('php://input');

    if (strlen($body) == 0) {
        $body = [];
    } else {
        $body = json_decode($body, true);
    }

    $query = [];
    if (isset($_SERVER['QUERY_STRING'])) {
        parse_str($_SERVER['QUERY_STRING'], $query);
    }

    return new \App\Components\Dto([
        'body'  => $body,
        'query' => $query,
    ]);
}