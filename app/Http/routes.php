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

/*
Route::get('/', function () {
    return view('home');
});
*/

//backend session ------------
 Route::group(array('prefix' => 'admin'), function() {

     Route::get('/','BackendController@index');
     Route::get('/overview','OverviewController@editOneRecord');
     Route::post('/overview/update','OverviewController@updateOneRecord');

     //Route::resource('/overview','OverviewController');

 });


//Route::resource('/overview', 'OverviewController');

//Route::get('/overview', 'OverviewController@index');
//Route::post('/overview/{$id}', 'OverviewController@update');


Route::controllers([
    'auth'=>'Auth\AuthController',
    'password'=>'Auth\PasswordController'
]);
Route::auth();
