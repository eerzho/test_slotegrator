<?php

namespace App\Components;

use App\Consts\Messages\ErrorMessage;

class Validator
{
    /**
     * @param       $rules
     * @param array $data
     */
    public function __construct($rules, array &$data)
    {
        $result = [];
        foreach ($rules as $field => $methods) {
            foreach ($methods as $method) {

                if ($method == 'required') {
                    self::requiredArray([$field], $data);

                } elseif (array_key_exists($field, $data)) {

                    if (str_starts_with($method, 'min') ||
                        str_starts_with($method, 'max')) {

                        $method = explode(':', $method);
                        self::{$method[0]}($data[$field], $field, $method[1]);
                        $result[$field] = $data[$field];

                    } else {
                        $result[$field] = self::$method($data[$field], $field);
                    }
                }
            }
        }
        $data = $result;
    }

    /**
     * @param array $fields
     * @param array $data
     */
    public static function requiredArray(array $fields, array $data = [])
    {
        foreach ($fields as $field) {
            if (empty($data[$field])) {
                self::throwError(ErrorMessage::VALIDATOR_REQUIRED, $field);
            }
        }
    }

    /**
     * @param        $val
     * @param string $field
     * @param int    $minVal
     */
    public static function min($val, string $field, int $minVal)
    {
        if (is_string($val)) {
            $count = strlen($val);
        } elseif (is_array($val)) {
            $count = count($val);
        } elseif (is_int($val)) {
            $count = $val;
        }

        if (isset($count) && $count < $minVal) {
            self::throwError(ErrorMessage::VALIDATOR_MIN, $field, $minVal);
        }
    }

    /**
     * @param        $val
     * @param string $field
     * @param int    $maxVal
     */
    public static function max($val, string $field, int $maxVal)
    {
        if (is_string($val)) {
            $count = strlen($val);
        } elseif (is_array($val)) {
            $count = count($val);
        } elseif (is_int($val)) {
            $count = $val;
        }

        if (isset($count) && $count > $maxVal) {
            self::throwError(ErrorMessage::VALIDATOR_MAX, $field, $maxVal);
        }
    }

    /**
     * @param        $val
     * @param string $field
     *
     * @return false|mixed
     */
    public static function int($val, string $field)
    {
        $val = filter_var($val, FILTER_VALIDATE_INT);
        if ($val === false) {
            self::throwError(ErrorMessage::VALIDATOR_INT, $field);
        }

        return $val;
    }

    /**
     * @param        $val
     * @param string $field
     *
     * @return string
     */
    public static function str($val, string $field)
    {
        if (!is_string($val)) {
            self::throwError(ErrorMessage::VALIDATOR_STRING, $field);
        }

        return trim(htmlspecialchars($val));
    }

    /**
     * @param $val
     *
     * @return mixed
     */
    public static function bool($val)
    {
        return filter_var($val, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @param        $val
     * @param string $field
     *
     * @return false|mixed
     */
    public static function email($val, string $field)
    {
        $val = filter_var($val, FILTER_VALIDATE_EMAIL);
        if ($val === false) {
            self::throwError(ErrorMessage::VALIDATOR_EMAIL, $field);
        }

        return $val;
    }

    /**
     * @param string      $message
     * @param string|null $field
     * @param string|null $count
     */
    public static function throwError(string $message, string $field = null, string $count = null)
    {
        if (!is_null($field)) {
            $message = str_replace(':field', $field, $message);
        }

        if (!is_null($count)) {
            $message = str_replace(':count', $count, $message);
        }

        $result = ['data' => ['message' => $message]];
        header_remove('Set-Cookie');
        header('Content-Type: application/json');
        header('HTTP/1.1 400');

        echo json_encode($result);
        exit();
    }
}