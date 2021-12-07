<?php

namespace App\Consts\Messages;

class ErrorMessage
{
    const FIND               = 'Не удалось найти запись';
    const CREATE             = 'Не удалось создать запись';
    const UPDATE             = 'Не удалось обновить запись';
    const DELETE             = 'Не удалось удалить запись';
    const NOT_FOUND          = 'Не удалось найти';
    const VALIDATOR_REQUIRED = 'Поле :field обязательное';
    const VALIDATOR_STRING   = 'Поле :field должно быть string';
    const VALIDATOR_EMAIL    = 'Поле :field должно быть email';
    const VALIDATOR_MIN      = 'Поле :field должно быть больше :example';
    const VALIDATOR_MAX      = 'Поле :field должно быть меньше :example';
    const VALIDATOR_INT      = 'Поле :field должно быть int';
    const VALIDATION_ARRAY   = 'Поле :field должен равен :example';
    const PASSWORD           = 'Не правильный пароль';
    const EMAIL              = 'Не правильный email';
    const UNAUTHORIZED       = 'Нужно авторизоваться';
    const INVALID_TOKEN      = 'Не действительный токен';
    const PRIZE_CONVERT      = 'Нельзя конвертировать приз';
    const MONETARY_TYPE      = 'Не правильный тип';
    const PRIZE_RECEIVE      = 'Приз получен';
}