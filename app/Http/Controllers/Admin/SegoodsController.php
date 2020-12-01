<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\SegoodsModel;
class SegoodsController extends Controller
{
    /**商家审核展示 */
    public function lists(){
        $seuserInfo = SegoodsModel::paginate(2);
        return view('segoods.lists',['seuserInfo'=>$seuserInfo]);
    }

    /**审核 */
    public function won(){
        $goods_id = request()->goods_id;
        // print_r($goods_id);
        $_val = request()->_val;
        
       // dd($user_id);
         //判断用户是否为待审核

        if($_val=='审核通过'){
           SegoodsModel::where('goods_id',$goods_id)->update(['is_static'=>1]);  
           return json_encode(['code'=>5,'msg'=>'审核通过']);
        }else{
            SegoodsModel::where('goods_id',$goods_id)->update(['is_static'=>2]);
            return json_encode(['code'=>6,'msg'=>'审核失败']);
        }
    }

    //批量审核
    public function morepass(){
        $goods_id = request()->goods_id;
        $_val = request()->_val;

        if($_val=='批量通过'){
            SegoodsModel::whereIn('goods_id',$goods_id)->update(['is_static'=>1]);  
            return json_encode(['code'=>7,'msg'=>'批量审核通过']);
         }else{
             SegoodsModel::whereIn('goods_id',$goods_id)->update(['is_static'=>2]); 
             return json_encode(['code'=>8,'msg'=>'批量审核失败']);
         }
    }
}
