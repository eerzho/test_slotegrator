<?php

namespace App\Components;

class Route
{
    private static array $methodGet = [];
    private static array $methodPost = [];
    private static array $methodPut = [];
    private static array $methodPatch = [];
    private static array $methodDelete = [];

    /**
     * @param string $url
     * @param string $controller
     */
    public static function get(string $url, string $controller)
    {
        self::$methodGet[] = self::transformController($url, $controller);
    }

    /**
     * @param string $url
     * @param string $controller
     */
    public static function post(string $url, string $controller)
    {
        self::$methodPost = self::transformController($url, $controller);
    }

    /**
     * @param string $url
     * @param string $controller
     */
    public static function put(string $url, string $controller)
    {
        self::$methodPut = self::transformController($url, $controller);
    }

    /**
     * @param string $url
     * @param string $controller
     */
    public static function patch(string $url, string $controller)
    {
        self::$methodPatch = self::transformController($url, $controller);
    }

    /**
     * @param string $url
     * @param string $controller
     */
    public static function delete(string $url, string $controller)
    {
        self::$methodDelete = self::transformController($url, $controller);
    }

    /**
     * @return array
     */
    public static function getGetRoutes()
    {
        return self::$methodGet;
    }

    /**
     * @return array
     */
    public static function getPostRoutes()
    {
        return self::$methodPost;
    }

    /**
     * @return array
     */
    public static function getPutRoutes()
    {
        return self::$methodPut;
    }

    /**
     * @return array
     */
    public static function getPatchRoutes()
    {
        return self::$methodPatch;
    }

    /**
     * @return array
     */
    public static function getDeleteRoutes()
    {
        return self::$methodDelete;
    }

    /**
     * @param string $url
     * @param string $controller
     *
     * @return array
     */
    private static function transformController(string $url, string $controller)
    {
        $controller = explode('@', $controller);

        return [
            'url'        => $url,
            'controller' => str_replace('/', '\\', 'App/' . $controller[0]),
            'method'     => $controller[1],
        ];
    }
}