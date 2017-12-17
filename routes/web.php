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

Auth::routes(); //URL Used for authentication users

/** URLS FOR PUBLIC/HOMEPAGE SIDE **/
Route::get('/', function () {
    return view('home');
});

Route::get('/destinations', function () {
    return view('destinations');
});

/** END OF URL **/

/** URL FOR ADMIN SIDE **/
Route::middleware('auth')->prefix('admin')->group(function () {
	Route::get('/home', 'HomeController@index');
	Route::resource('/users', 'UsersController');
	Route::resource('/destinations', 'DestinationsController');
	Route::resource('/customers', 'CustomersController');
	
});

/** END OF URL **/
