<?php

use App\Components\Route;

Route::get('/user', 'Controllers/Api/UserController@index');
Route::post('/user', 'Controllers/Api/UserController@store');
Route::get('/user/:id', 'Controllers/Api/UserController@show', true);
Route::put('/user/:id', 'Controllers/Api/UserController@update');
Route::delete('/user/:id', 'Controllers/Api/UserController@destroy');
Route::post('/auth/login', 'Controllers/Api/AuthController@login');
Route::get('/auth/me', 'Controllers/Api/AuthController@me', true);