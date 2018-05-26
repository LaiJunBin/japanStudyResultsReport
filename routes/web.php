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

Route::get('/',"MainController@index");

Route::get('/login','MainController@login');
Route::post('/login','MainController@loginProcess');

Route::group(['prefix'=>'/user','middleware'=>['user.auth']],function(){
    Route::get('/logout','UserController@logout');
    Route::get('/updatePwd','UserController@updatePwd');
    Route::put('/updatePwd','UserController@updatePwdProcess');
});

Route::get('/photo/day/{day}','MainController@photo_day');
