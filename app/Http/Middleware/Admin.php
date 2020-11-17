<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\AdminModel;
use App\Model\RoleModel;
use App\Model\MenuModel;
use App\Model\Admin_RoleModel;
use App\Model\Role_MenuModel;
// use Illuminate\Support\Facades\Route;
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        //查询权限
        $url=$request->route()->getAction();
    //    $url= $request->route()->getName();
        // $url=Route::currentRouteName();
       // dd($url);
        $admin_id = session('admin_id');
        if(!$admin_id){
            return redirect('/login');
        }
        // dd($admin_id);
        $admin_role=Admin_RoleModel::where('admin_id',$admin_id)->get();
        // dd($role_id);
        $arr=[];
        foreach ($admin_role as $v){
            $arr[] = $v['role_id'];
        }
        // dd($arr);
        $role_menu=Role_MenuModel::whereIn('role_id',$arr)->get();
        $arr2=[];
        foreach ($role_menu as $v){
            $arr2[] = $v['menu_id'];
        }
        // dd($arr2);
        $menu_url = Menumodel::whereIn('menu_id',$arr2)->get();
// dd($menu_url);
        $arr3=[];
        foreach ($menu_url as $v){
            $arr3[] = $v['menu_url'];
        }
        // dd($arr3);
        // dd($arr3);
        //dd($url);
        if(!in_array($url,$arr3)){
          return redirect('/403');
       }

          //查询左侧菜单
     if($admin_id == 1){
        $privmenu = \DB::select("select * from sh_menu where is_show = 1");
       // dd($privmenu);
    }else{
        $privmenu = \DB::select("select DISTINCT rm.menu_id,m.* from sh_role_menu as rm inner join sh_menu as m on rm.menu_id=m.menu_id inner join sh_admin_role as ar on ar.role_id = rm.role_id where m.is_show =1 and ar.admin_id='$admin_id'");
    }
      //控制左侧菜单的展示
        // dd($privmenu);
        $privmenu = $this->createsontree($privmenu);
       
       // dd($privmenu);
        view()->share('priv',$privmenu);
        return $next($request);
        return $next($request);
     
    }

    public function createsontree($data,$partent_id=0){
        if(!$data){
            return;
        }
        $newarray = [];
        foreach($data as $k=>$v){
            if($v->parent_id==$partent_id){
                $newarray[$k] = $v;
                $newarray[$k]->son = $this->createsontree($data,$v->menu_id);
            }
        }
        return $newarray;
    }
     
}
