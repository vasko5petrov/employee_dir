<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

// Department routes
Route::get('/department', 'DepartmentController@index');
Route::get('/department/add', 'DepartmentController@addForm')->middleware('auth');
Route::post('department/add', 'DepartmentController@add')->middleware('auth');
Route::get('department/edit/{id}', 'DepartmentController@editForm')->middleware('auth');
Route::post('department/edit/{id}', 'DepartmentController@edit')->middleware('auth');

// Employee routes
Route::get('/employee', 'EmployeeController@index');

// Admin routes
Route::get('/change-password', 'UserController@changePasswordForm')->middleware('auth');
Route::post('/change-password', 'UserController@changePassword')->middleware('auth');
