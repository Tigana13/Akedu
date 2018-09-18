<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/', 'College\CollegeController@index')->name('home');

Route::get('/colleges', 'College\CollegeController@index')->name('colleges');
Route::get('/colleges/{id}', 'College\CollegeController@show')->name('college.show');
Route::post('/search', 'College\CollegeController@search')->name('search');
