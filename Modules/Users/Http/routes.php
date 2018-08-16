<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'users', 'namespace' => 'Modules\Users\Http\Controllers'], function()
{
    Route::get('/', 'UsersController@index')->name('users');
});

// Rutas que serán invocadas con axios
Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'api/users', 'namespace' => 'Modules\Users\Http\Controllers'], function()
{
    Route::get('/', 'UsersController@index');
    Route::post('/store', 'UsersController@store');
    Route::get('/search/{query}', 'UsersController@search');
});
