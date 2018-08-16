<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'referrals', 'namespace' => 'Modules\Referrals\Http\Controllers'], function()
{
    Route::get('/', 'ReferralsController@index')->name('referrals');
});
// Rutas que serán invocadas con axios
Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'api/referrals', 'namespace' => 'Modules\Referrals\Http\Controllers'], function()
{
    Route::get('/', 'ReferralsController@index');
    Route::post('/store', 'ReferralsController@store');
    Route::get('/search/{query}', 'ReferralsController@search');
});