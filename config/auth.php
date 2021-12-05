<?php

$auth = null;

/**
 * @return \App\Models\User
 */
function auth() {
    return $GLOBALS['auth'];
}

function setAuth(\App\Models\User $user) {
    $GLOBALS['auth'] = $user;
}