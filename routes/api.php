<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register',  'Api\AuthController@register');

Route::prefix('movie')->group(function () {
    Route::get('/{id}', 'Api\TMDBController@show')->where('id', '[0-9]+')->middleware('auth:api');
    Route::get('/search', 'Api\TMDBController@search')->middleware('auth:api');
    Route::get('/popular', 'Api\TMDBController@popular')->middleware('auth:api');
});

Route::prefix('user')->group(function () {
    Route::get('/favorites', 'Api\UserController@favorites')->middleware('auth:api');
    Route::post('/favorites/{id}', 'Api\UserController@addFavourite')->where('id', '[0-9]+')->middleware('auth:api');
    Route::delete('/favorites/{id}', 'Api\UserController@removeFavourite')->where('id', '[0-9]+')->middleware('auth:api');
});

