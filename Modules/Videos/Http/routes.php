<?php

Route::group(['middleware' => 'web', 'prefix' => 'videos', 'namespace' => 'Modules\Videos\Http\Controllers'], function()
{
    Route::get('/', 'VideosController@index')->name('videos');
    Route::get('/create', 'VideosController@create')->name('videos.create');
    Route::get('/edit/{id}', 'VideosController@edit')->name('videos.edit')->where('id', '[0-9]+');
});
// Rutas que serán invocadas con axios
Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'api/videos', 'namespace' => 'Modules\Videos\Http\Controllers'], function()
{
    Route::get('/', 'VideosController@index');
    Route::post('/store', 'VideosController@store');
    Route::post('/update/{id}', 'VideosController@update')->where('id', '[0-9]+');
    Route::get('/search/{query}', 'VideosController@search');
});
