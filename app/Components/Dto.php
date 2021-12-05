<?php

namespace App\Components;

class Dto
{
    private array $dto;

    /**
     * @param array $dto
     */
    public function __construct(array $dto)
    {
        $this->dto = $dto;
    }

    /**
     * @param string $key
     * @param null   $default
     *
     * @return mixed|null
     */
    public function get(string $key, $default = null)
    {
        if (array_key_exists($key, $this->dto)) {

            $val = filter_var($this->dto[$key], FILTER_VALIDATE_INT);

            if ($val != false) {
                return $val;
            }

            return $this->dto[$key];
        }

        return $default;
    }
}