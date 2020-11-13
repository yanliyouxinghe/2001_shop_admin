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

Route::get('/', function () {
    return view('layouts.layout');
});



//分类
Route::prefix('/cartgory')->group(function(){
  Route::get('/create','Brand\BrandController@create');
});

//品牌

Route::prefix('/brand')->group(function(){
  Route::get('/create','Admin\BrandController@create');
  Route::get('/list','Admin\BrandController@index');
  Route::post('/store','Admin\BrandController@store');
  Route::any('/uploads','Admin\BrandController@uploads');
  Route::get('/destroy','Admin\BrandController@destroy');
  Route::get('/show/{id}','Admin\BrandController@show');
  Route::post('/edit/{id}','Admin\BrandController@edit');
  Route::any('/updated','Admin\BrandController@updated');
});
//公告
Route::prefix('/notice')->group(function(){
  Route::get('/create','Admin\NoticeController@create');
  Route::get('/list','Admin\NoticeController@index');
  Route::post('/store','Admin\NoticeController@store');
  Route::any('/uploads','Admin\NoticeController@uploads');
  Route::get('/destroy','Admin\NoticeController@destroy');
  Route::get('/show/{id}','Admin\NoticeController@show');
  Route::post('/edit/{id}','Admin\NoticeController@edit');
  Route::any('/updated','Admin\NoticeController@updated');
});