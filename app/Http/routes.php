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


Route::get('/','IndexController@index');
Route::get('/about','AboutController@index');
Route::resource('/news','NewsController');
Route::resource('/review','ReviewController');



//backend session ------------

 Route::group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function($router)
 {
     Route::get('/','OverviewController@editOneRecord');
     Route::get('/overview','OverviewController@editOneRecord');
     Route::post('/overview/update','OverviewController@updateOneRecord');

     Route::post('/cyclepics/updateorder','CyclepicsController@updateOrder');
     Route::resource('/cyclepics','CyclepicsController');

     Route::resource('/about','AboutController');
     Route::resource('news','NewsController');
     Route::resource('/product','ProductController');
     Route::post('/productEditFiles','ProductController@editFiles');
     Route::resource('/productcate','ProductcateController');
     Route::resource('/review','ReviewController');
     Route::resource('/media','MediaController');


     //Route::post('/indexinfo','IndexinfoController@create');
     //Route::resource('/overview','OverviewController');

 });


Route::controllers([
    'auth'=>'Auth\AuthController',
    'password'=>'Auth\PasswordController'
]);
Route::auth();
