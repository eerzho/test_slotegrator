<?php

namespace App\Components;

use App\Consts\Messages\ErrorMessage;
use App\Traits\OutputTrait;

class App
{
    use OutputTrait;

    private array $routes;

    /**
     * @param string $method
     * @param string $url
     */
    public function run(string $method, string $url)
    {
        $this->routes = match (strtoupper($method)) {
            "GET" => Route::getGetRoutes(),
            "POST" => Route::getPostRoutes(),
            "PUT" => Route::getPutRoutes(),
            "PATCH" => Route::getPatchRoutes(),
            "DELETE" => Route::getDeleteRoutes(),
            default => [],
        };

        $this->sendRequest($url);
    }

    /**
     * @param $url
     */
    public function sendRequest($url)
    {
        foreach ($this->routes as $route) {
            if ($this->compareUrl($route['url'], $url)) {
                $controllerObject = new $route['controller']();
                $controllerObject->{$route['method']}();
            }
        }

        $this->sendOutput([
            'message' => ErrorMessage::NOT_FOUND
        ], 404);
    }

    /**
     * @param string $url
     * @param string $requestUrl
     *
     * @return bool
     */
    public function compareUrl(string $url, string $requestUrl): bool
    {
        if ($url == $requestUrl) {
            return true;
        }

        return false;
    }
}