<?php

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'courses', 'namespace' => 'Modules\Courses\Http\Controllers'], function()
{
    Route::get('/', 'CoursesController@index')->name('courses');
    Route::get('/create', 'CoursesController@create')->name('courses.create');
    Route::get('/edit/{id}', 'CoursesController@edit')->name('courses.edit')->where('id', '[0-9]+');
    Route::get('/my-courses', 'CoursesController@getCoursesByUser')->name('courses.mycourses');
    Route::get('/show-course', 'CoursesController@show')->name('courses.showcourse');
});
// Rutas que serán invocadas con axios
Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'api/courses', 'namespace' => 'Modules\Courses\Http\Controllers'], function()
{
    Route::get('/', 'CoursesController@index');
    Route::post('/store', 'CoursesController@store');
    Route::post('/update/{id}', 'CoursesController@update')->where('id', '[0-9]+');
    Route::get('/search/{query}', 'CoursesController@search');
    Route::get('/chapters/{id}', 'ChapterController@index')->where('id', '[0-9]+');
    Route::get('chapter/edit/{id}', 'ChapterController@edit')->where('id', '[0-9]+');
    Route::post('chapter/store/{id}', 'ChapterController@store')->where('id', '[0-9]+');
    Route::post('chapter/update/{id}', 'ChapterController@update')->where('id', '[0-9]+');
    Route::post('chapter/set_file/{id}', 'ChapterController@setFile')->where('id', '[0-9]+');
    Route::delete('chapter/delete/{id}', 'ChapterController@destroy')->where('id', '[0-9]+');
});
