<?php

Route::group(['middleware' => 'web', 'prefix' => 'videos', 'namespace' => 'Modules\Videos\Http\Controllers'], function()
{
    Route::get('/', 'VideosController@index')->name('videos');
});
// Rutas que serán invocadas con axios
Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'api/videos', 'namespace' => 'Modules\Videos\Http\Controllers'], function()
{
    Route::get('/', 'VideosController@index');
    Route::post('/store', 'VideosController@store');
    Route::get('/search/{query}', 'VideosController@search');
});
