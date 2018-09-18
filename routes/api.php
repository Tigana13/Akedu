<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/colleges', 'API\Colleges\CollegesController@index');
Route::get('/colleges/{id}', 'API\Colleges\CollegesController@show');
Route::post('/colleges', 'API\Colleges\CollegesController@store');
Route::post('/colleges/search', 'API\Colleges\CollegesController@search');
Route::put('/colleges/{id}', 'API\Colleges\CollegesController@update');
Route::delete('/colleges/{id}', 'API\Colleges\CollegesController@destroy');
Route::get('/colleges/related/{relation}', 'API\Colleges\CollegesController@relation');


Route::get('/courses', 'API\Courses\CoursesController@index');
Route::get('/courses/{id}', 'API\Courses\CoursesController@show');
Route::post('/courses', 'API\Courses\CoursesController@store');
Route::put('/courses/{id}', 'API\Courses\CoursesController@update');
Route::delete('/courses/{id}', 'API\Courses\CoursesController@destroy');
