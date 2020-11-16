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



Route::middleware('login')->group(function(){
  Route::middleware('checkadmin')->group(function(){
  
Route::get('/', function(){
    return view('layouts.layout');
});

Route::get('/logout','Admin\LoginController@logout');//退出登录
Route::get('/changepwd','Admin\LoginController@changepwd');//修改密码
Route::post('/changpwdDo','Admin\LoginController@changpwdDo');//执行修改密码


//广告位置
Route::prefix('ad')->group(function(){
  Route::get('create','Admin\AdController@create')->name('ad.create');   //广告位添加
  Route::post('store','Admin\AdController@store');   //广告位置执行添加
  Route::any('/','Admin\AdController@index')->name('ad.index');   //广告位置列表
  Route::get('destroy/{id}','Admin\AdController@destroy')->name('ad.destroy');   //广告位置删除
  Route::get('edit/{id}','Admin\AdController@edit');   //广告位置修改
  Route::post('update/{id}','Admin\AdController@update')->name('ad.update');   //广告位置执行修改
  Route::get('/destroy','Admin\AdController@destroy');   //广告位置删除
  Route::any('upload','Admin\AdController@upload');   //广告图片
  Route::any('/sh/{ad_id}','Admin\AdController@sh');   //生成广告
  Route::any('/ch/{ad_id}','Admin\AdController@ch');   //查看广告
});

//广告
Route::prefix('adv')->group(function(){
  Route::any('/create','Admin\AdvController@create')->name('adv.create');//广告添加
  Route::post('/store','Admin\AdvController@store');//广告执行添加
  Route::get('/index','Admin\AdvController@index')->name('adv.index');
  Route::get('/','Admin\AdvController@index');
  Route::any('/show/{id}','Admin\AdvController@show')->name('adv.show');;   ///预览
  Route::any('/destroy','Admin\AdvController@destroy')->name('adv.destroy');//广告删除
  Route::get('edit/{id}','Admin\AdvController@edit');   //广告修改
  Route::any('/update/{id}','Admin\AdvController@update')->name('adv.update');  //执行修改
  Route::any('/upload','Admin\AdvController@upload');   //上传文件
});

//分类
Route::prefix('/cartgory')->group(function(){

  Route::get('/create','Admin\CartgoryController@create')->name('cartgory.create');//分类添加
  Route::post('/store','Admin\CartgoryController@store');
  Route::get('/list','Admin\CartgoryController@index')->name('cartgory.list');//分类展示
  Route::post('/destroy','Admin\CartgoryController@destroy')->name('cartgory.destroy');//分类上删除
  Route::get('/edit/{id}','Admin\CartgoryController@edit');
  Route::post('/update','Admin\CartgoryController@update')->name('cartgory.update');//分类修改
  Route::post('/destrys','Admin\CartgoryController@destrys');//分类修改

  

});

//品牌
Route::prefix('/brand')->group(function(){
  Route::get('/create','Admin\BrandController@create')->name('brand.create');//品牌添加
  Route::get('/list','Admin\BrandController@index')->name('brand.index');//品牌展示
  Route::post('/store','Admin\BrandController@store');
  Route::any('/uploads','Admin\BrandController@uploads');
  Route::get('/destroy','Admin\BrandController@destroy')->name('brand.destroy');//品牌删除
  Route::get('/show/{id}','Admin\BrandController@show');
  Route::post('/edit/{id}','Admin\BrandController@edit');


  Route::any('/updated','Admin\BrandController@updated')->name('brand.updated');//品牌修改
});

//公告
Route::prefix('/notice')->group(function(){
  Route::get('/create','Admin\NoticeController@create')->name('notice.create');//公告添加
  Route::get('/list','Admin\NoticeController@index')->name('notice.list');//公告展示
  Route::post('/store','Admin\NoticeController@store');
  Route::any('/uploads','Admin\NoticeController@uploads');
  Route::get('/destroy','Admin\NoticeController@destroy')->name('notice.destroy');//公告删除
  Route::get('/show/{id}','Admin\NoticeController@show');
  Route::post('/edit/{id}','Admin\NoticeController@edit');
  Route::any('/updated','Admin\NoticeController@updated')->name('notice.updated');//公告修改

});

//管理员
Route::prefix('/admin')->group(function(){
  Route::get('/create','Admin\AdminController@create')->name('admin.create');//添加管理员
  Route::post('/store','Admin\AdminController@store');//执行添加
  Route::any('/list','Admin\AdminController@index')->name('admin.list');//管理员列表
  Route::get('/admin/destroy/{admin_id?}','Admin\AdminController@destroy')->name('admin.destroy');//删除
});
//角色管理
Route::prefix('/role')->group(function(){
  Route::get('/create','Admin\RoleController@create')->name('role.create');//添加角色
  Route::post('/store','Admin\RoleController@store');//执行添加
  Route::any('/list','Admin\RoleController@index')->name('role.list');//角色列表
  Route::get('/role/destroy/{role_id?}','Admin\RoleController@destroy')->name('role.destroy');//删除
  Route::get('/role/addpriv/{role_id?}','Admin\RoleController@addpriv')->name('role.addpriv');//角色添加权限
  Route::post('/addprivdo','Admin\RoleController@addprivdo');//执行添加权限
});

//权限管理
Route::prefix('/menu')->group(function(){
  Route::get('/create','Admin\MenuController@create')->name('menu.create');//添加菜单
  Route::post('/store','Admin\MenuController@store');//执行添加
  Route::any('/list','Admin\MenuController@index')->name('menu.index');//菜单列表
  Route::get('/menu/destroy/{menu_id?}','Admin\MenuController@destroy')->name('menu.destroy');//删除

});
//商品类型
Route::prefix('/goodstype')->group(function(){
  Route::get('/create','Admin\GoodsTypeController@create');//商品类型添加
  Route::post('/store','Admin\GoodsTypeController@store');//执行添加
  Route::get('/list','Admin\GoodsTypeController@index');//类型展示
  Route::get('/destroy','Admin\GoodsTypeController@destroy')->name('/goodstype/destroy');
  Route::get('/addprop/{id}','Admin\GoodsTypeController@addprop');
  Route::post('/addpropdo','Admin\GoodsTypeController@addpropdo');
  Route::get('/proplist/{id}','Admin\GoodsTypeController@proplist');//商品属性列表
  Route::get('/delattr','Admin\GoodsTypeController@delattr');//删除属性
  Route::get('/addattr/{id}','Admin\GoodsTypeController@addattr');//添加属性
  Route::post('/storeattr','Admin\GoodsTypeController@storeattr');//执行添加属性

});
});
});