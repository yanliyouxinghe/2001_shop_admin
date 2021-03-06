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
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**登录视图 */
    public function login(){
       return view('/login');
    }

    /**执行登录 */
    public function logindo(){
        $post = request()->except('_token');
        $admin = AdminModel::where('admin_name',$post['admin_name'])->first();
        // dd($admin);
        if(!$admin){
            return redirect('/login')->with('msg','用户名或密码错误');die;
        }


        if(password_verify($post['admin_pwd'],$admin->admin_pwd)){
              session(['admin_name'=>$admin->admin_name]);
              session(['admin_id'=>$admin->admin_id]);
              return redirect('/');
        }else{
            return redirect('/login')->with('msg','用户名或密码错误'); 
        }
    }

    /**退出登录 */
    public function logout(){
        session(['admin_name'=>null]);
        return redirect('/login');die;
    }



    //修改密码
    public function changepwd(){
        $admin_name = session('admin_name');
        return view('changepwd',['admin_name'=>$admin_name]);
    }

    //执行修改密码
    public function changpwdDo(Request $request){
        $admin_name = $request->input('admin_name');
        $old_pwd = $request->input('old_pwd');
        $admin_pwd = $request->input('admin_pwd');
    
        if(!$admin_name || !$old_pwd || !$admin_pwd){
            return redirect('/changepwd')->with('status','参数丢失...');
        }

        $admin = AdminModel::where('admin_name',$admin_name)->first();
    if($admin){
     if(password_verify($old_pwd,$admin->admin_pwd)){
        if(password_verify($admin_pwd,$admin->admin_pwd)){
              return redirect('/changepwd')->with('status','修改失败，原因：旧密码与新密码不能一致...');
        }else{
             $ret = AdminModel::where('admin_name',$admin_name)->update(['admin_pwd'=>password_hash($admin_pwd, PASSWORD_DEFAULT)]);
             if($ret){
                return redirect('/login');
             }else{
                 return redirect('/changepwd')->with('status','操作繁忙...');
             }
        }
   
    }else{
        return redirect('/changepwd')->with('status','修改失败，原因：旧密码错误...');
    }
        
    }else{
          return redirect('/changepwd')->with('status','修改失败，原因：管理员不存在...');
    }


    }   


   
}
