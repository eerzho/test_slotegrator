<?php

namespace App\Consts\BaseConst;

use ReflectionClass;

/**
 * @property array      $constants
 * @property array      $arr
 */
class BaseConst
{
    private static $contants;
    private static $arr;
    private static $arrDis;

    /**
     * @return array
     */
    protected static function getConstants()
    {
        $reflectionClass = new ReflectionClass(static::class);

        return self::$contants ?: self::$contants = $reflectionClass->getConstants();
    }

    /**
     * @return array
     */
    public static function getArr()
    {
        $res = [];
        foreach (self::getArrDis() as $key => $value) {
            $res[] = $value['value'];
        }

        return self::$arr ?: self::$arr = $res;
    }

    /**
     * @return array
     */
    public static function getArrDis()
    {
        $res = [];
        foreach (self::getConstants() as $key => $value) {
            $res[] = [
                'name'  => strtolower($key),
                'value' => $value
            ];
        }

        return self::$arrDis ?: self::$arrDis = $res;
    }
}
