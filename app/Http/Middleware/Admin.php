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
    //     if(!in_array($url['as'],$arr3)){
    //         die('403');
    //    }
        return $next($request);
    }
}
