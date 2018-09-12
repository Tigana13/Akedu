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


Route::get('/colleges', 'Colleges\CollegesController@index');
Route::get('/colleges/{id}', 'Colleges\CollegesController@show');
Route::post('/colleges', 'Colleges\CollegesController@store');
Route::put('/colleges/{id}', 'Colleges\CollegesController@update');
Route::delete('/colleges/{id}', 'Colleges\CollegesController@destroy');
