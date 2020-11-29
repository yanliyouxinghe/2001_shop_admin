<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\SeuserModel;
class SeuserController extends Controller
{
    /**商家审核展示 */
    public function list(){
        $seuserInfo = SeuserModel::paginate(2);
        return view('seuser.list',['seuserInfo'=>$seuserInfo]);
    }

    /**审核 */
    public function won(){
        $user_id = request()->user_id;
        $_val = request()->_val;
        
       // dd($user_id);
         //判断用户是否为待审核

        if($_val=='审核通过'){
           SeuserModel::where('user_id',$user_id)->update(['seuser_start'=>1]);  
           return json_encode(['code'=>5,'msg'=>'审核通过']);
        }else{
            SeuserModel::where('user_id',$user_id)->update(['seuser_start'=>2]); 
            return json_encode(['code'=>6,'msg'=>'审核失败']);
        }
    }

    //批量审核
    public function morepass(){
        $user_id = request()->user_id;
        $_val = request()->_val;

        if($_val=='批量通过'){
            SeuserModel::whereIn('user_id',$user_id)->update(['seuser_start'=>1]);  
            return json_encode(['code'=>7,'msg'=>'批量审核通过']);
         }else{
             SeuserModel::whereIn('user_id',$user_id)->update(['seuser_start'=>2]); 
             return json_encode(['code'=>8,'msg'=>'批量审核失败']);
         }
       
    }
}
