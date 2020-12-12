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
Route::view('/403','403');//403


Route::middleware('login')->group(function(){

Route::middleware('checkadmin')->group(function(){
Route::get('/','Admin\IndexController@index')->name('index');//403  
// Route::get('/', function(){
//     return view('layouts.layout');
// });


Route::get('/logout','Admin\LoginController@logout')->name('logout');//退出登录
Route::get('/changepwd','Admin\LoginController@changepwd')->name('changepwd');//修改密码
Route::post('/changpwdDo','Admin\LoginController@changpwdDo')->name('changpwdDo');//执行修改密码


//广告位置
Route::prefix('ad')->group(function(){
  Route::get('create','Admin\AdController@create')->name('ad.create');   //广告位添加
  Route::post('store','Admin\AdController@store')->name('ad.store');   //广告位置执行添加
  Route::any('/','Admin\AdController@index')->name('ad.index');   //广告位置列表
  Route::get('edit/{id}','Admin\AdController@edit')->name('ad.edit');   //广告位置修改
  Route::post('update/{id}','Admin\AdController@update')->name('ad.update');   //广告位置执行修改
  Route::post('/change','Admin\AdController@change')->name('ad.change');//广告位置即点即改
  Route::get('/destroy','Admin\AdController@destroy')->name('ad.destory');   //广告位置删除
  Route::any('upload','Admin\AdController@upload')->name('ad.upload');   //广告图片
  Route::any('/sh/{ad_id}','Admin\AdController@sh')->name('ad.sh');   //生成广告
  Route::any('/ch/{ad_id}','Admin\AdController@ch')->name('ad.ch');   //查看广告
  Route::any('/list','Admin\AdController@list')->name('ad.list');   //广告
});

//商家审核管理
Route::prefix('seuser')->group(function(){
    Route::get('/list','Admin\SeuserController@list')->name('seuser.list');  //商家审核展示
    Route::get('/won','Admin\SeuserController@won')->name('seuser.won');  //商家审核通过或失败  ajax
    Route::get('/morepass','Admin\SeuserController@morepass')->name('seuser.morepass');  //批量审核  ajax
});
//商家商品管理
Route::prefix('segoods')->group(function(){
    Route::get('/lists','Admin\SegoodsController@lists')->name('segoods.lists');  //商家商品审核展示
    Route::get('/won','Admin\SegoodsController@won')->name('segoods.won');  //商家商品审核通过或失败  ajax
    Route::get('/morepass','Admin\SegoodsController@morepass')->name('segoods.morepass');  //批量审核  ajax
});
//广告
Route::prefix('adv')->group(function(){
  Route::any('/create','Admin\AdvController@create')->name('adv.create');//广告添加
  Route::post('/store','Admin\AdvController@store')->name('adv.store');//广告执行添加

  Route::get('/','Admin\AdvController@index')->name('adv.index');//广告列表
  Route::any('/show/{id}','Admin\AdvController@show')->name('adv.show');;   ///预览
  Route::any('/destroy','Admin\AdvController@destroy')->name('adv.destroy');//广告删除
  Route::get('edit/{id}','Admin\AdvController@edit')->name('adv.edit');   //广告修改
  Route::any('/update/{id}','Admin\AdvController@update')->name('adv.update');  //执行修改
  Route::post('/change','Admin\AdvController@change')->name('adv.change');//广告位置即点即改

  Route::any('/upload','Admin\AdvController@upload')->name('adv.upload');   //上传文件

});

//分类
Route::prefix('/cartgory')->group(function(){

  Route::get('/create','Admin\CartgoryController@create')->name('cartgory.create');//分类添加
  Route::post('/store','Admin\CartgoryController@store')->name('cartgory.store');
  Route::get('/list','Admin\CartgoryController@index')->name('cartgory.list');//分类展示
  Route::post('/destroy','Admin\CartgoryController@destroy')->name('cartgory.destroy');//分类删除
  Route::get('/edit/{id}','Admin\CartgoryController@edit')->name('cartgory.edit');
  Route::post('/update','Admin\CartgoryController@update')->name('cartgory.update');//分类修改
  Route::post('/destrys','Admin\CartgoryController@destrys')->name('cartgory.destrys');//分类批量删除
  

});

//品牌
Route::prefix('/brand')->group(function(){
  Route::get('/create','Admin\BrandController@create')->name('brand.create');//品牌添加
  Route::any('/list','Admin\BrandController@index')->name('brand.index');//品牌展示
  Route::post('/store','Admin\BrandController@store')->name('brand.store');
  Route::any('/uploads','Admin\BrandController@uploads')->name('brand.uploads');
  Route::get('/destroy','Admin\BrandController@destroy')->name('brand.destroy');//品牌删除
  Route::get('/show/{id}','Admin\BrandController@show')->name('brand.show');
  Route::post('/edit/{id}','Admin\BrandController@edit')->name('brand.edit');
  Route::any('/updated','Admin\BrandController@updated')->name('brand.updated');//品牌修改
});

//公告
Route::prefix('/notice')->group(function(){
  Route::get('/create','Admin\NoticeController@create')->name('notice.create');//公告添加
  Route::get('/list','Admin\NoticeController@index')->name('notice.list');//公告展示
  Route::post('/store','Admin\NoticeController@store')->name('notice.store');
  Route::any('/uploads','Admin\NoticeController@uploads')->name('notice.uploads');
  Route::get('/destroy','Admin\NoticeController@destroy')->name('notice.destroy');//公告删除
  // Route::get('/show/{id}','Admin\NoticeController@show')->name('notice.show');
  Route::get('/edit/{id}','Admin\NoticeController@edit')->name('notice.edit');
 Route::post('/update/{id}','Admin\NoticeController@update')->name('notice.update');//公告执行修改
 
  Route::any('/updated','Admin\NoticeController@updated')->name('notice.updated');//公告修改

});

//管理员
Route::prefix('/admin')->group(function(){
  Route::get('/create','Admin\AdminController@create')->name('admin.create');//添加管理员
  Route::post('/store','Admin\AdminController@store')->name('admin.store');//执行添加
  Route::any('/uploads','Admin\AdminController@uploads')->name('admin.uploads');
  Route::any('/list','Admin\AdminController@index')->name('admin.list');//管理员列表
  Route::get('/admin/destroy/{admin_id?}','Admin\AdminController@destroy')->name('admin.destroy');//删除
  Route::get('/admin/addrole/{admin_id?}','Admin\AdminController@addrole')->name('admin.addrole');//添加角色
  Route::post('/addroledo','Admin\AdminController@addroledo')->name('role.addroledo');//执行添加角色
  Route::get('/edit/{id}','Admin\AdminController@edit')->name('admin.edit');//管理员修改
  Route::post('/update/{id}','Admin\AdminController@update')->name('admin.update');//执行修改

});
//角色管理
Route::prefix('/role')->group(function(){
  Route::get('/create','Admin\RoleController@create')->name('role.create');//添加角色
  Route::post('/store','Admin\RoleController@store')->name('role.store');//执行添加
  Route::any('/list','Admin\RoleController@index')->name('role.list');//角色列表
  Route::post('/destroy','Admin\RoleController@destroy')->name('role.destroy');//删除
  Route::get('/role/addpriv/{role_id?}','Admin\RoleController@addpriv')->name('role.addpriv');//角色添加权限
  Route::post('/addprivdo','Admin\RoleController@addprivdo')->name('role.addprivdo');//执行添加权限
});



//权限管理
Route::prefix('/menu')->group(function(){
  Route::get('/create','Admin\MenuController@create')->name('menu.create');//添加菜单
  Route::post('/store','Admin\MenuController@store')->name('menu.store');//执行添加
  Route::any('/list','Admin\MenuController@index')->name('menu.index');//菜单列表
  Route::post('/destroy','Admin\MenuController@destroy')->name('menu.destroy');//删除菜单
  Route::get('/edit/{id}','Admin\MenuController@edit')->name('menu.edit');//修改菜单
  Route::post('/update/{id}','Admin\MenuController@update')->name('menu.update');//执行修改菜单

});
//商品类型
Route::prefix('/goodstype')->group(function(){

  Route::get('/create','Admin\GoodsTypeController@create');//商品类型添加
  Route::post('/store','Admin\GoodsTypeController@store');//执行添加
  Route::get('/list','Admin\GoodsTypeController@index');//类型展示
  Route::get('/destroy','Admin\GoodsTypeController@destroy')->name('goodstype.destroy');
  Route::get('/addprop/{id}','Admin\GoodsTypeController@addprop');
  Route::post('/addpropdo','Admin\GoodsTypeController@addpropdo');
  Route::get('/proplist/{id}','Admin\GoodsTypeController@proplist');//商品属性列表
  Route::get('/delattr','Admin\GoodsTypeController@delattr');//删除属性
  Route::get('/addattr/{id}','Admin\GoodsTypeController@addattr');//添加属性
  Route::post('/storeattr','Admin\GoodsTypeController@storeattr');//执行添加属性


});
//商品
Route::prefix('/goods')->group(function(){
  Route::get('/create','Admin\GoodsController@create')->name('goods.create');//添加商品
  Route::any('/upload','Admin\GoodsController@upload')->name('goods.upload');
  Route::post('/uploads','Admin\GoodsController@uploads')->name('goods.uploads');
  Route::get('/getattr','Admin\GoodsController@getattr')->name('gooods.getattr');
  Route::post('/store','Admin\GoodsController@store')->name('goods.store');//执行添加
  Route::post('/pruct','Admin\GoodsController@pruct')->name('goods.pruct');
  Route::get('/list','Admin\GoodsController@list')->name('goods.list');//商品列表
  Route::get('/jyl/{id}','Admin\GoodsController@item')->name('goods.jyl');//查看商品
  Route::post('/destroy','Admin\GoodsController@destroy')->name('goods.destroy');//商品删除
  // Route::get('/edit/{id}','Admin\GoodsController@edit')->name('goods.edit');//商品修改
  // Route::post('/update/{id}','Admin\GoodsController@update')->name('goods.update');//商品执行修改
  


  });
//优惠券
Route::prefix('/coupons')->group(function(){
  Route::get('/create','Admin\CouponsController@create')->name('coupons.create');//添加
  Route::post('/store','Admin\CouponsController@store')->name('coupons.store');//执行添加
  Route::get('/list','Admin\CouponsController@list')->name('coupons.list');//列表展示
  Route::any('/uploads','Admin\CouponsController@uploads')->name('coupons.uploads');//图片上传
  Route::get('/destroy','Admin\CouponsController@destroy')->name('coupons.destroy');//删除
  Route::get('/edit/{id}','Admin\CouponsController@edit')->name('coupons.edit');//修改
  Route::post('/update/{id}','Admin\CouponsController@update')->name('coupons.update');//执行修改
  Route::any('/updated','Admin\CouponsController@updated')->name('coupons.updated');//即点即改

});

});
});






