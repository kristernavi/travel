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
	$destinations = \App\Destination::all();
    return view('destinations')->with('destinations', $destinations);
});

/** END OF URL **/

/** URL FOR ADMIN SIDE **/
Route::middleware('auth')->prefix('admin')->group(function () {
	
	//Link for your admin homepage
	Route::get('/home', 'HomeController@index');

	//Links for users functionalities
	Route::resource('/users', 'UsersController');
	Route::get('/get-users', 'UsersController@all'); //get-all users returned as json format
	

	//Links for destinations functionalities
	Route::resource('/destinations', 'DestinationsController');
	Route::get('/get-destinations', 'DestinationsController@all'); //get-all destinations returned as json format

	//Links for packages functionalities
	Route::resource('/packages', 'PackagesController');
	Route::get('/get-packages', 'PackagesController@all'); //get-all packages returned as json format

	//Links for customers functionalities
	Route::resource('/customers', 'CustomersController');
	Route::get('/get-customers', 'CustomersController@all'); //get-all customers returned as json format
	
});

/** END OF URL **/
