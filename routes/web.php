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

//后台登录
Route::get('/login','Admin\LoginController@login');//登录
Route::post('/logindo','Admin\LoginController@logindo');//执行登录
Route::get('/logout','Admin\LoginController@logout');//退出登录

Route::middleware('login')->group(function(){
Route::get('/', function(){
    return view('layouts.layout');
});

//广告位置
Route::prefix('ad')->middleware('login')->group(function(){
  Route::get('create','Admin\AdController@create')->name('ad.create');   //广告位添加
  Route::post('store','Admin\AdController@store');   //广告位置执行添加
  Route::any('/','Admin\AdController@index');   //广告位置列表
  Route::get('destroy/{id}','Admin\AdController@destroy');   //广告位置删除
  Route::get('edit/{id}','Admin\AdController@edit');   //广告位置修改
  Route::post('update/{id}','Admin\AdController@update');   //广告位置执行修改
  Route::any('upload','Admin\AdController@upload');   //广告图片
});

//广告
Route::prefix('adv')->group(function(){
  Route::any('/create','Admin\AdvController@create')->name('adv.create');
  Route::post('/store','Admin\AdvController@store');
  Route::get('/index','Admin\AdvController@index');
  Route::any('/show/{id}','Admin\AdvController@show')->name('adv.show');;   ///预览
  Route::any('/edit/{id}','Admin\AdvController@edit');
  Route::any('/update/{id}','Admin\AdvController@update');
  Route::any('/upload','Admin\AdvController@upload');   //上传文件
});


});