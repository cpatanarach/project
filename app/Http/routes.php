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



Route::group(['middleware' => 'web'], function () {
    Route::get('/', function () {
    return view('welcome');
	});
	Route::auth();
	Route::get('/system', 'HomeController@index');
	Route::get('/department', 'DepartmentController@index');
	Route::get('/division', 'DivisionController@index');
	Route::get('/accept/{id}', 'AdminController@listAlluser');
	Route::get('/profile/{id}', 'ProfileController@show');
	Route::post('/add_department', 'DepartmentController@store');
	Route::post('/guest/{id}', 'HomeController@guest');
	Route::post('/add_division', 'DivisionController@store');
	Route::post('/del_division/{id}', 'DivisionController@destroy');
	Route::post('/edit_division/{id}', 'DivisionController@edit');
	Route::post('/update_division/{id}', 'DivisionController@update');
	Route::post('/del_department/{id}', 'DepartmentController@destroy');
	Route::post('/edit_department/{id}', 'DepartmentController@edit');
	Route::post('/update_department/{id}', 'DepartmentController@update');
	Route::post('/update_profile/{id}', 'ProfileController@update');
});