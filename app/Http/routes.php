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
Route::get('/department/{id}/employee', 'DepartmentController@employeeList');
Route::get('/department/add', 'DepartmentController@addForm')->middleware('auth');
Route::post('department/add', 'DepartmentController@add')->middleware('auth');
Route::get('department/{id}/edit', 'DepartmentController@editForm')->middleware('auth');
Route::post('department/{id}/edit', 'DepartmentController@edit')->middleware('auth');
Route::delete('department/{id}/delete', 'DepartmentController@delete')->middleware('auth');
Route::get('/department/{id}/detail', 'DepartmentController@show');

// Employee routes
Route::get('/employee', 'EmployeeController@index');
Route::get('/employee/add', 'EmployeeController@addForm');
Route::post('/employee/add', ['as' => 'auth.employee.add', 'uses' => 'EmployeeController@add']);
Route::get('/employee/{id}/detail', 'EmployeeController@show');
Route::get('/employee/{id}/edit', 'EmployeeController@editForm')->middleware('auth');
Route::post('/employee/{id}/edit', 'EmployeeController@edit')->middleware('auth');

// Admin routes
Route::get('/update/password', 'UserController@updatePasswordForm')->middleware('auth');
Route::post('/update/password', 'UserController@updatePassword')->middleware('auth');
