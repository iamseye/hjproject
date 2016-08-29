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
Route::get('/review/showAllReviews/{id}','ReviewController@showAllReviews');
Route::resource('/media','MediaController');
Route::get('/media/showAllMedia/{id}','MediaController@showAllMedia');
Route::resource('/product','ProductController');
Route::resource('/contact','ContactController');




//backend session ------------

 Route::group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function($router)
 {
     Route::get('/','OverviewController@editOneRecord');
     Route::get('/overview','OverviewController@editOneRecord');
     Route::post('/overview/update','OverviewController@updateOneRecord');

     Route::post('/cyclepics/updateorder','CyclepicsController@updateOrder');
     Route::resource('/cyclepics','CyclepicsController');

     Route::resource('/about','AboutController');
     Route::post('/about/saveSummerPic','AboutController@saveSummerPic');
     Route::resource('news','NewsController');
     Route::post('/news/saveSummerPic','NewsController@saveSummerPic');


     //Product -------
     Route::resource('/product','ProductController');
     Route::get('/productPics/{id}','ProductController@productPics');
     Route::post('/productPicsAdd','ProductController@productPicsAdd');
     Route::delete('/productPicsDel/{id}','ProductController@productPicsDel');
     Route::post('/updatePicsOrder','ProductController@updatePicsOrder');

     Route::post('/product/saveSummerPic','ProductController@saveSummerPic');

     //end Product ------

     Route::resource('/productcate','ProductcateController');
     Route::resource('/review','ReviewController');
     Route::post('/review/saveSummerPic','ReviewController@saveSummerPic');

     Route::resource('/media','MediaController');
     Route::resource('/contact','ContactController');


     //Route::post('/indexinfo','IndexinfoController@create');
     //Route::resource('/overview','OverviewController');

 });


Route::controllers([
    'auth'=>'Auth\AuthController',
    'password'=>'Auth\PasswordController'
]);
Route::auth();
