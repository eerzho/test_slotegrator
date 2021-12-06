<?php

namespace App\Components;

use App\Consts\Messages\ErrorMessage;
use App\Models\Token;
use App\Models\User;
use App\Traits\OutputTrait;
use Illuminate\Database\Capsule\Manager;

class App
{
    use OutputTrait;

    private array $routes;
    private array $attributes = [];

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
                    if ($route['auth']) {
                        $this->authentication();
                    }
                    $controllerObject = new $route['controller']();
                    $controllerObject->{$route['method']}($this->attributes);
                } catch (\Exception $exception) {
                    self::sendError($exception->getMessage(), 500);
                }
            }
        }

        self::sendError(ErrorMessage::NOT_FOUND, 404);
    }

    /**
     * @return void
     */
    private function authentication()
    {
        if (!array_key_exists('HTTP_AUTHORIZATION', $_SERVER)) {
            self::sendError(ErrorMessage::UNAUTHORIZED, 401);
        }

        $bearerToken = $_SERVER['HTTP_AUTHORIZATION'];
        $token = explode('Bearer ', $bearerToken)[1];

        $user = User::query()->get()->first(function (User $user) use ($token) {
            return $this->isValidToken($user, $token);
        });

        if (is_null($user)) {
            self::sendError(ErrorMessage::INVALID_TOKEN, 403);
        }

        setAuth($user);
    }

    /**
     * @param User   $user
     * @param string $secondPartToken
     *
     * @return bool
     */
    private function isValidToken(User $user, string $secondPartToken)
    {
        $res = false;
        $user->tokens()->each(function (Token $token) use (&$res, $user, $secondPartToken) {
            $fullToken = $token->first_part_token . $secondPartToken;
            $res = $res || password_verify($user->password . TOKEN_SECRECT_WORD, $fullToken);
        });

        return $res;
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

        $urlExploded = explode('/', $url);
        $urlRequestExploded = explode('/', $requestUrl);

        if (count($urlExploded) != count($urlRequestExploded)) {
            return false;
        }

        $res = true;
        foreach ($urlRequestExploded as $key => $segment) {
            if ($urlExploded[$key] != $segment) {
                if (str_starts_with($urlExploded[$key], ':')) {
                    $attributeName = explode(':', $urlExploded[$key]);
                    $this->attributes[$attributeName[1]] = $segment;
                } else {
                    $res = false;
                }
            }
        }

        return $res;
    }
}