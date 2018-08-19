<?php

Route::group(['middleware' => 'web', 'prefix' => 'videocategories', 'namespace' => 'Modules\VideoCategories\Http\Controllers'], function()
{
    Route::get('/', 'VideoCategoriesController@index')->name('videocategories');
});
// Rutas que serán invocadas con axios
Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'api/videocategories', 'namespace' => 'Modules\VideoCategories\Http\Controllers'], function()
{
    Route::get('/', 'VideoCategoriesController@index');
    Route::post('/store', 'VideoCategoriesController@store');
    Route::get('/search/{query}', 'VideoCategoriesController@search');
});