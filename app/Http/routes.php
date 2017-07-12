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
    return view('/welcome');
});

//Welcome routes
Route::get('/', 'WelcomeController@index');

Route::auth();
Route::post('/login', 'Auth\AuthController@postLogin');
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
Route::get('/employee/{id}/detail', 'EmployeeController@show');
Route::get('/employee/add', 'EmployeeController@addForm')->middleware('auth');
Route::post('/employee/add', 'EmployeeController@add')->middleware('auth');
Route::get('/employee/{id}/edit', 'EmployeeController@editForm')->middleware('auth');
Route::post('/employee/{id}/edit', 'EmployeeController@edit')->middleware('auth');
Route::delete('employee/{id}/delete', 'EmployeeController@delete')->middleware('auth');

// Posts routes
Route::get('/posts', 'PostsController@index');
Route::get('/post/{id}', 'PostsController@show');
Route::get('/posts/add', 'PostsController@addForm')->middleware('auth');
Route::post('/posts/add', 'PostsController@add')->middleware('auth');
Route::get('/post/{id}/edit', 'PostsController@editForm')->middleware('auth');
Route::post('/post/{id}/edit', 'PostsController@edit')->middleware('auth');
Route::delete('post/{id}/delete', 'PostsController@delete')->middleware('auth');

	//Posts Categories
	Route::get('/posts/categories', 'PostsCategoriesController@index')->middleware('auth');
	Route::get('/posts/category/{id}', 'PostsCategoriesController@show');
	Route::post('/posts/category/add', 'PostsCategoriesController@add')->middleware('auth');
	Route::get('/posts/category/{id}/edit', 'PostsCategoriesController@editForm')->middleware('auth');
	Route::post('/posts/category/{id}/edit', 'PostsCategoriesController@edit')->middleware('auth');

//Events routes
Route::get('/events', 'EventController@index');
Route::get('/events/list', 'EventController@listEvents');
Route::get('/events/{id}', 'EventController@show');
Route::get('/event/add', 'EventController@addForm')->middleware('auth');
Route::post('/event/add', 'EventController@add')->middleware('auth');
Route::get('/event/{id}/edit', 'EventController@editForm')->middleware('auth');
Route::post('/event/{id}/edit', 'EventController@edit')->middleware('auth');
Route::delete('event/{id}/delete', 'EventController@delete')->middleware('auth');

// Admin routes
Route::get('/update/password', 'UserController@updatePasswordForm')->middleware('auth');
Route::post('/update/password', 'UserController@updatePassword')->middleware('auth');
Route::get('/login/first/{hashed_id}', 'Auth\AuthController@firstLoginForm');
Route::post('login/first', 'Auth\AuthController@firstLogin');

// Mail service
Route::get('/invite', 'MailController@showInvitationForm')->middleware('auth');
Route::post('/invite/send-invitation', 'MailController@sendInvitation')->middleware('auth');

Route::get('/api', function () {
	$events = DB::table('events')->select('id', 'name', 'title', 'start_time as start', 'end_time as end')->get();
	foreach($events as $event)
	{
		$event->title = $event->title . ' - ' .$event->name;
		$event->url = url('events/' . $event->id);
	}
	return $events;
});