<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AdminModel;
use App\Model\GoodsModel;
use App\Model\CartgoryModel;
use App\Model\BrandModel;
use App\Model\AdModel;
use App\Model\AdvModel;
use App\Model\NoticeModel;
use App\Model\MenuModel;
use App\Model\RoleModel;
class IndexController extends Controller
{

	public function index(){
		$data = $this->getData();
        return view('index',['data'=>$data]);
	}


	 //获取首页的各项数据
    public function getData(){
        $goods_count = GoodsModel::count();
        $cart_count = CartgoryModel::count();
        $brand_count = BrandModel::count();
        $admin_count = AdminModel::count();
        $ad_count = AdModel::count();
        $adv_count = AdvModel::count();
        $notice_count = NoticeModel::count();
        $menu_count = MenuModel::count();
        $role_count = RoleModel::count();

        $array_data = [
          'goods_count'=>$goods_count,
          'cart_count'=>$cart_count,
          'brand_count'=>$brand_count,
          'admin_count'=>$admin_count,
          'ad_count'=>$ad_count,
          'adv_count'=>$adv_count,
          'notice_count'=>$notice_count,
          'menu_count'=>$menu_count,
          'role_count'=>$role_count
        ];
        
        $data_arr = implode(',', $array_data);
        $daarr = '['.$data_arr.']';
        return $daarr;

    }
      






}