<?php

Route::group(['middleware' => 'web', 'prefix' => 'webminar', 'namespace' => 'Modules\Webminar\Http\Controllers'], function()
{
    Route::get('/', 'WebminarController@index')->name('webminar');
});
