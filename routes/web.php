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
//管理员
Route::prefix('/admin')->group(function(){
  Route::get('/create','Admin\AdminController@create');//添加管理员
  Route::post('/store','Admin\AdminController@store');//执行添加
  Route::any('/list','Admin\AdminController@index');//管理员列表
  Route::get('/admin/destroy/{admin_id?}','Admin\AdminController@destroy');//删除
});
//角色管理
Route::prefix('/role')->group(function(){
  Route::get('/create','Admin\RoleController@create');//添加角色
  Route::post('/store','Admin\RoleController@store');//执行添加
  Route::any('/list','Admin\RoleController@index');//角色列表
  Route::get('/role/destroy/{role_id?}','Admin\RoleController@destroy');//删除
  Route::get('/role/addmenu/{menu_id?}','Admin\RoleController@addmenu');//角色添加权限
});
//权限管理
Route::prefix('/menu')->group(function(){
  Route::get('/create','Admin\MenuController@create');//添加菜单
  Route::post('/store','Admin\MenuController@store');//执行添加
  Route::any('/list','Admin\MenuController@index');//菜单列表
  Route::get('/menu/destroy/{menu_id?}','Admin\MenuController@destroy');//删除
 
});

