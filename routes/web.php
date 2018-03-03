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

//URL Used for authentication users
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('logout', 'Auth\LoginController@logout');
Route::get('location', function () {
    return \App\Municipality::orWhere('name', 'like', '%'.request('name').'%')->get();
});

/* URLS FOR PUBLIC/HOMEPAGE SIDE **/
Route::get('/', function () {
    $details = \App\PackageDetails::inRandomOrder()->uniquePackage()->take(4)->get();

    return view('home', compact('details'));
});
Route::get('/contact', function () {
    return view('contact');
});
Route::post('/contact', 'ContactUsController@store');

Route::get('/services', 'ServiceController@index');
Route::get('/checkout-order', 'ServiceController@index');
Route::get('remove-cart/{id}', 'CartController@destory');
Route::get('/checkout-order', 'CheckoutOrder@index');
Route::post('checkout-order', 'CheckoutOrder@store');

Route::post('/add-cart', 'CartController@store');
Route::get('/about-us', function () {
    return view('about');
});

Route::get('new-book/{id}', 'BookController@create');
Route::post('new-book/{id}', 'BookController@store');

Route::get('/business/signup', 'BusinessController@create')->name('business-register');
Route::post('/business/signup', 'BusinessController@store');

Route::get('/destinations-new', 'HomeDestinationsController@index');
Route::get('/package/{id}', 'HomeDestinationsController@show');

Route::get('/destinations', 'HomeDestinationsController@index');
Route::get('/review/{id}', 'ReviewController@create');
Route::post('/review/{id}', 'ReviewController@store');

Route::get('/review-service/{id}', 'ServiceReviewController@create');
Route::post('/review-service/{id}', 'ServiceReviewController@store');
 Route::get('terms', function(){
            return view('term');
    });
/* END OF URL **/

/* URL FOR ADMIN SIDE **/
Route::middleware('auth')->prefix('admin')->group(function () {
    //Link for your admin homepage
    Route::get('/home', 'HomeController@index');

    //Links for users functionalities
    Route::resource('/users', 'UsersController');
    Route::get('/get-users', 'UsersController@all'); //get-all users returned as json format

    //Links for business functionalities
    Route::get('/business-account', 'BusinessController@index');
    Route::get('/business-active/{id}', 'BusinessController@activate');
    Route::get('/get-business', 'BusinessController@all'); //get-all users returned as json format

    //Links for destinations functionalities
    Route::resource('/destinations', 'DestinationsController');
    Route::get('/get-destinations', 'DestinationsController@all'); //get-all destinations returned as json format

    //Links for packages functionalities
    Route::resource('/packages', 'PackagesController');
    Route::get('/get-packages', 'PackagesController@all'); //get-all packages returned as json format

    //Links for customers functionalities
    Route::resource('/customers', 'CustomersController');
    Route::get('/get-customers', 'CustomersController@all'); //get-all customers returned as json format

    Route::get('/get-transcations', 'AdminBookController@all');
    Route::get('/transactions', 'AdminBookController@index');

    Route::post('/reservation-confirm/{id}', 'AdminBookController@confirm');
    Route::post('reservation-reject/{id}', 'AdminBookController@reject');
});

/* END OF URL **/

/* URL FOR Business SIDE **/
Route::middleware('auth')->prefix('business')->group(function () {
    //Link for your Business homepage
    Route::get('/home', 'HomeController@index');

    //Links for destinations functionalities
    Route::resource('/destinations', 'DestinationsController');
    Route::get('/get-destinations', 'DestinationsController@all'); //get-all destinations returned as json format

    //Links for packages functionalities
    Route::resource('/packages', 'PackagesController');
    Route::get('/get-packages', 'PackagesController@all'); //get-all packages returned as json format

    //Links for customers functionalities
    Route::resource('/customers', 'CustomersController');
    Route::get('/get-customers', 'CustomersController@all'); //get-all customers returned as json format
    Route::get('/get-transcations', 'AdminBookController@all');
    Route::get('/transactions', 'AdminBookController@index');

    Route::get('/card', 'BusinessCardController@index');
    Route::post('/card', 'BusinessCardController@store');
});

/* END OF URL **/
