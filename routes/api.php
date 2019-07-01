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

Route::middleware('auth:api')->prefix('movie')->group(function () {
    Route::get('/{id}', 'Api\TMDBController@show')->where('id', '[0-9]+');
    Route::get('/search', 'Api\TMDBController@search');
    Route::get('/popular', 'Api\TMDBController@popular');
});
