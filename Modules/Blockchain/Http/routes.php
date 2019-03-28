<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'blockchain', 'namespace' => 'Modules\Blockchain\Http\Controllers'], function()
{
    Route::get('/', 'BlockchainController@index')->name('blockchain');
    Route::get('/create', 'BlockchainController@create')->name('blockchain.create');
    Route::post('/store', 'BlockchainController@store')->name('blockchain.store');
});
