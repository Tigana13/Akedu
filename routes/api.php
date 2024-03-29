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
//A comment to enable pushing
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

//
//Give info about a course forum :  'course,'threads ,'topics'
Route::get('/courses/forum/{id}', 'API\Courses\CoursesController@showForum')->name('api.course.forum.show');
//Comment on a course: comment: comment_body
Route::post('/courses/comment/{course_id}', 'API\Courses\CoursesController@addCourseComment')->name('api.course.comment');
//show a course thread
Route::get('/courses/thread/{course_id}/{thread_id}', 'API\Courses\CoursesController@showCourseThread')->name('api.course.thread.show');
//Create a thread for the course: thread: thread_subject, thread_title, course_id
Route::post('/courses/thread/create', 'API\Courses\CoursesController@createCourseThread')->name('api.thread.store');
//Comment on a course thread: comment
Route::post('/courses/thread/comment/{thread_id}', 'API\Courses\CoursesController@addThreadComment')->name('api.course.thread.comment');
//Search for a course thread: Collection(_threads_), course, search_hits
Route::post('/courses/thread/search', 'API\Courses\CoursesController@searchThreads')->name('api.course.threads.search');



Route::post('/comments/comment/{comment_id}', 'API\Courses\CoursesController@addCommentComment')->name('api.comment.comment');
