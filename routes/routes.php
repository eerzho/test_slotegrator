<?php

use App\Components\Route;

Route::get('/user', 'Controllers/Api/UserController@index', true);
Route::post('/user', 'Controllers/Api/UserController@store');
Route::get('/user/:id', 'Controllers/Api/UserController@show', true);
Route::put('/user/:id', 'Controllers/Api/UserController@update', true);
Route::delete('/user/:id', 'Controllers/Api/UserController@destroy', true);
Route::post('/auth/login', 'Controllers/Api/AuthController@login');
Route::get('/auth/me', 'Controllers/Api/AuthController@me', true);
Route::get('/product', 'Controllers/Api/ProductController@index', true);
Route::post('/product', 'Controllers/Api/ProductController@store', true);
Route::get('/product/:id', 'Controllers/Api/ProductController@show', true);