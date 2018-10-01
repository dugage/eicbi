<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'users', 'namespace' => 'Modules\Users\Http\Controllers'], function()
{
    Route::get('/', 'UsersController@index')->name('users');
    Route::get('/create', 'UsersController@create')->name('users.create');
    Route::get('/edit/{id}', 'UsersController@edit')->name('users.edit')->where('id', '[0-9]+');
});

// Rutas que serán invocadas con axios
Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'api/users', 'namespace' => 'Modules\Users\Http\Controllers'], function()
{
    Route::get('/', 'UsersController@index');
    Route::post('/store', 'UsersController@store');
    Route::post('/update/{id}', 'UsersController@update')->where('id', '[0-9]+');
    Route::post('/disabled/{id}', 'UsersController@disabled')->where('id', '[0-9]+');
    Route::get('/search/{query}', 'UsersController@search');
});
//rutas para el final del registro
Route::group(['middleware' => 'web', 'prefix' => 'user', 'namespace' => 'Modules\Users\Http\Controllers'], function()
{
    Route::get('/end-register/{id}', 'UsersController@endRegister')->where('id', '[0-9]+');
});
