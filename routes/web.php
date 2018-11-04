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
//User
Route::get('/user/profile', 'User\UserController@profile')->name('user.profile');
Route::post('/user/profile/update', 'User\UserController@updateBio')->name('user.bio.update');
Route::post('/user/interests/add', 'User\UserController@addInterests')->name('user.interests.add');

//Internship && exit survey
Route::get('/internship/exit_survey/show', 'User\UserController@showExitSurveyForm')->name('exit_survey.show');
Route::post('/internship/exit_survey/submit', 'User\UserController@addExitSurvey')->name('exit_survey.submit');

Route::get('/colleges', 'College\CollegeController@index')->name('colleges');
Route::get('/colleges/{id}', 'College\CollegeController@show')->name('college.show');
Route::post('/search', 'College\CollegeController@search')->name('search');


Route::get('/courses/{id}', 'Courses\CoursesController@show')->name('course.show');
Route::get('/courses/forum/{id}', 'Courses\CoursesController@showForum')->name('course.forum.show');
Route::post('/courses/comment/{course_id}', 'Courses\CoursesController@addCourseComment')->name('course.comment');
Route::get('/courses/thread/{course_id}/{thread_id}', 'Courses\CoursesController@showCourseThread')->name('course.thread.show');
Route::post('/courses/thread/create', 'Courses\CoursesController@createCourseThread')->name('thread.store');
Route::post('/courses/thread/comment/{thread_id}', 'Courses\CoursesController@addThreadComment')->name('course.thread.comment');
Route::post('/courses/thread/search', 'Courses\CoursesController@searchThreads')->name('course.threads.search');



Route::post('/comments/comment/{comment_id}', 'Comments\CommentsController@addCommentComment')->name('comment.comment');

Route::view('/{path?}', 'app');
