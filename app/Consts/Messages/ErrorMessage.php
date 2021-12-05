<?php

namespace App\Consts\Messages;

class ErrorMessage
{
    const FIND               = 'Не удалось найти запись';
    const CREATE             = 'Не удалось создать запись';
    const UPDATE             = 'Не удалось обновить запись';
    const DELETE             = 'Не удалось удалить запись';
    const ERR_FIELDS         = 'Нельзя выбрать поле';
    const NOT_FOUND          = 'Не удалось найти';
    const VALIDATOR_REQUIRED = 'Поле :field обязательное';
    const VALIDATOR_STRING   = 'Поле :field должно быть string';
    const VALIDATOR_EMAIL    = 'Поле :field должно быть email';
    const VALIDATOR_MIN      = 'Поле :field должно быть больше :count';
    const VALIDATOR_MAX      = 'Поле :field должно быть меньше :count';
    const VALIDATOR_INT      = 'Поле :field должно быть int';
    const SEARCH_CONDITIONS  = 'Поле conditions не найден';
    const SEARCH_PARAMETERS  = 'Поле parameter не найден';
    const PASSWORD           = 'Не правильный пароль';
    const EMAIL              = 'Не правильный email';
    const UNAUTHORIZED       = 'Нужно авторизоваться';
    const INVALID_TOKEN      = 'Не действительный токен';
}