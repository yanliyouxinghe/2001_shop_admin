<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AdminModel;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**登录视图 */
    public function login(){
<<<<<<< HEAD
    //    if(Hash::check('plain-text', $hashedPassword)) { 
    //        // 密码匹配... 
    //}
=======
    //    echo encrypt(123);
>>>>>>> main
       return view('/login');
    }

    /**执行登录 */
    public function logindo(){
        $post = request()->except('_token');
        $admin = AdminModel::where('admin_name',$post['admin_name'])->first();
  
        if(!$admin){
            return redirect('/login')->with('msg','用户名或密码错误');
        }

        if(password_verify($admin->admin_pwd,$post['admin_pwd'])){
            return redirect('/login')->with('msg','用户名或密码错误');
        }

        session(['admin_name'=>$admin->admin_name]);
        return redirect('/');
    }

    /**退出登录 */
    public function logout(){

    }

}
