<?php

use Illuminate\Support\Facades\Route;

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


// @todo create all email notifications on assignment and completion of tasks
// @todo create all email notifications for teachers when a task has passed its overdue date
// @todo create all validation of form inputs in PHP
// @todo create all valudation of form inputs in JS
// @todo facility to add comments to each questions or each task
// @todo the ability for teacher to respond
// @todo add all notifications for new tasks, messages etc
// @todo add ability to view how a class has performed within a certain task
// @todo design, create and implement all reporting structures
// @todo add ability to assign tasks to only a certain subset of students
// @todo add ability to select each individual student from a graph in order to assign specific tasks to them
// @todo create full suite of unittests
// @todo style all login and registration pages (Auth routes)

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/classgroups/create', [App\Http\Controllers\ClassGroupController::class, 'create'])->name('create_classgroup')->middleware('auth');
Route::post('/classgroups/{classgroup}/store_student', [App\Http\Controllers\OrganisationController::class, 'store_student'])->middleware('auth');
Route::get('/classgroups/{classgroup}/create_student', [App\Http\Controllers\OrganisationController::class, 'create_student'])->middleware('auth');
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');
Route::get('/organisations', [App\Http\Controllers\OrganisationController::class, 'index'])->name('organisations')->middleware('auth');
Route::get('/organisations/create', [App\Http\Controllers\OrganisationController::class, 'create'])->name('create_organisation')->middleware('auth');
Route::get('/organisations/{organisation}', [App\Http\Controllers\OrganisationController::class, 'show'])->name('teachers')->middleware('auth');
Route::get('teachers/create_teacher', [App\Http\Controllers\OrganisationController::class, 'create_teacher'])->name('create_teacher')->middleware('auth');
Route::post('/organisations/store', [App\Http\Controllers\OrganisationController::class, 'store'])->middleware('auth');
Route::post('/store_teacher', [App\Http\Controllers\OrganisationController::class, 'store_teacher'])->middleware('auth');
Route::get('/teachers/{user}', [App\Http\Controllers\UserController::class, 'show_teacher'])->middleware('auth');
Route::get('/classgroups/{classgroup}', [App\Http\Controllers\ClassGroupController::class, 'show'])->middleware('auth');
Route::get('/students/{user}/', [App\Http\Controllers\UserController::class, 'show_student'])->middleware('auth');
Route::get('/classgroups', [App\Http\Controllers\ClassGroupController::class, 'index'])->name('classgroups')->middleware('auth');
Route::post('/classgroups/store', [App\Http\Controllers\ClassGroupController::class, 'store'])->middleware('auth');


Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks')->middleware('auth');
Route::get('/tasks/create', [App\Http\Controllers\TaskController::class, 'create'])->name('create_task')->middleware('auth');
Route::post('/tasks/store', [App\Http\Controllers\TaskController::class, 'store'])->middleware('auth');
Route::get('/classgroups/{classgroup}/set_task/', [App\Http\Controllers\TaskController::class, 'set_task'])->middleware('auth');
Route::post('/classgroups/{classgroup}/assign_task/', [App\Http\Controllers\TaskController::class, 'assign_task'])->middleware('auth');
Route::get('/tasks/{task}/complete_task', [App\Http\Controllers\TaskController::class, 'complete_task'])->middleware('auth');
Route::post('/tasks/{task}/submit_task', [App\Http\Controllers\TaskController::class, 'submit_task'])->middleware('auth');
// /tasks/{task} -> edit, make a route to edit questions on an existing resource

Route::group(['middleware' => 'auth'], function () {
		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'App\Http\Controllers\PageController@icons']);
		Route::get('maps', ['as' => 'pages.maps', 'uses' => 'App\Http\Controllers\PageController@maps']);
		Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'App\Http\Controllers\PageController@notifications']);
		Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'App\Http\Controllers\PageController@rtl']);
		Route::get('tables', ['as' => 'pages.tables', 'uses' => 'App\Http\Controllers\PageController@tables']);
		Route::get('typography', ['as' => 'pages.typography', 'uses' => 'App\Http\Controllers\PageController@typography']);
		Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'App\Http\Controllers\PageController@upgrade']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

