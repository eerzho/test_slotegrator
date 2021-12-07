<?php

use App\Components\Route;

Route::post('/auth/login', 'Controllers/Api/AuthController@login');
Route::get('/auth/me', 'Controllers/Api/AuthController@me', true);

Route::get('/user', 'Controllers/Api/UserController@index', true);
Route::post('/user', 'Controllers/Api/UserController@store');
Route::get('/user/:id', 'Controllers/Api/UserController@show', true);
Route::put('/user/:id', 'Controllers/Api/UserController@update', true);
Route::delete('/user/:id', 'Controllers/Api/UserController@destroy', true);

Route::get('/product', 'Controllers/Api/ProductController@index', true);
Route::post('/product', 'Controllers/Api/ProductController@store', true);
Route::get('/product/:id', 'Controllers/Api/ProductController@show', true);
Route::put('/product/:id', 'Controllers/Api/ProductController@update', true);

Route::get('/monetary', 'Controllers/Api/MonetaryController@index', true);
Route::post('/monetary', 'Controllers/Api/MonetaryController@store', true);
Route::get('/monetary/:id', 'Controllers/Api/MonetaryController@show', true);
Route::put('/monetary/:id', 'Controllers/Api/MonetaryController@update', true);

Route::get('/prize', 'Controllers/Api/PrizeController@index', true);
Route::post('/prize', 'Controllers/Api/PrizeController@store', true);
Route::get('/prize/:id', 'Controllers/Api/PrizeController@show', true);
