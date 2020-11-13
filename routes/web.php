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

//分类
Route::prefix('/cartgory')->group(function(){
<<<<<<< HEAD
  Route::get('/create','Admin\CartgoryController@create');
  Route::post('/store','Admin\CartgoryController@store');
  Route::get('/list','Admin\CartgoryController@index');
  Route::post('/destroy','Admin\CartgoryController@destroy');
  Route::get('/edit/{id}','Admin\CartgoryController@edit');
  Route::post('/update','Admin\CartgoryController@update');
=======
  Route::get('/create','Brand\BrandController@create');
});

<<<<<<< HEAD
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
>>>>>>> jyl
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
=======
});
>>>>>>> ce83fae33b1225758cc9a4f1f1dc7fa617410ca1
