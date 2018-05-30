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

Route::get('/search','MainController@search');
Route::post('/search','MainController@searchProcess');


Route::group(['prefix'=>'/user','middleware'=>['user.auth']],function(){
    Route::get('/logout','UserController@logout');
    Route::get('/updatePwd','UserController@updatePwd');
    Route::put('/updatePwd','UserController@updatePwdProcess');
});

Route::group(['prefix'=>'/article','middleware'=>['user.auth']],function(){
    Route::get('/add','ArticleController@add');
    Route::post('/add','ArticleController@addProcess');
    Route::get('/update/{id}','ArticleController@update');
    Route::put('/update/{id}','ArticleController@updateProcess');
    Route::delete('/delete/{id}','ArticleController@delete');

});

Route::get('/photo/category/{category}/{file}','MainController@photo_category');
Route::get('/{id}','ArticleController@viewArticle');

