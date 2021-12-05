<?php

namespace App\Components;

use App\Consts\Messages\ErrorMessage;
use App\Traits\OutputTrait;
use Illuminate\Database\Capsule\Manager;

class App
{
    use OutputTrait;

    private array $routes;

    /**
     * @return void
     */
    public function run()
    {
        $this->runORM();
        $this->runController();
    }

    /**
     * @return void
     */
    public function runInConsole()
    {
        $this->runORM();
    }

    /**
     * @return void
     */
    protected function runController()
    {
        $this->routes = match (strtoupper($_SERVER['REQUEST_METHOD'])) {
            "GET" => Route::getGetRoutes(),
            "POST" => Route::getPostRoutes(),
            "PUT" => Route::getPutRoutes(),
            "PATCH" => Route::getPatchRoutes(),
            "DELETE" => Route::getDeleteRoutes(),
            default => [],
        };

        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $this->findController($url);
    }

    /**
     * @return void
     */
    protected function runORM()
    {
        $capsule = new Manager();

        $capsule->addConnection([
            'driver'   => 'mysql',
            'host'     => DB_HOST,
            'database' => DB_DATABASE_NAME,
            'username' => DB_USERNAME,
            'password' => DB_PASSWORD,
        ]);

        $capsule->setAsGlobal();

        $capsule->bootEloquent();
    }

    /**
     * @param $url
     */
    protected function findController($url)
    {
        foreach ($this->routes as $route) {
            if ($this->compareUrl($route['url'], $url)) {
                try {
                    $controllerObject = new $route['controller']();
                    $controllerObject->{$route['method']}();
                } catch (\Exception $exception) {
                    $this->sendOutput([
                        'message' => $exception->getMessage()
                    ], 500);
                }
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
    protected function compareUrl(string $url, string $requestUrl): bool
    {
        if ($url == $requestUrl) {
            return true;
        }

        return false;
    }
}