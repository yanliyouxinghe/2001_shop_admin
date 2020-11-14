<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AdminModel;
use App\Model\RoleModel;
use App\Model\MenuModel;
use App\Model\Role_MenuModel;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $RoleModel =  new RoleModel();
        $data =  $RoleModel->list_data();
        return view('role.list',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->except('_token');
        $RoleModel =  new RoleModel();
        $data =  $RoleModel->create_data($data);
        if($data){
            return redirect('role/list');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role_id=$id; 
        $RoleModel =  new RoleModel();
         $res=$RoleModel->destroy_date($role_id);
        if($res){
            return redirect('role/list');
        }
    }
    public function addpriv($role_id){
        // dump($role_id);
        $MenuModel=new MenuModel();
        $Menu = $MenuModel::get();
        // dd($Menu);
        $role_menu = Role_MenuModel::where('role_id',$role_id)->pluck('menu_id');
        
        $role_menu = count($role_menu)?$role_menu->toArray():[];
        // dd($role_menu);
        // $Menu = menuTree($Menu);
        return view('role/addpriv',['menu'=>$Menu,'role_id'=>$role_id,'role_menu'=>$role_menu]);
    }

     //角色权限添加
     public function addprivdo(Request $request){
        $post = $request->except('_token');
        // dd($post);
        if(isset($post['menucheck'])){
            Role_MenuModel::where('role_id',$post['role_id'])->delete();
            $data = [];
            foreach($post['menucheck'] as $v){
                $data[]=[
                    'role_id' => $post['role_id'],
                    'menu_id' => $v
                ];
                
            }
            // dump($data);
            Role_MenuModel::insert($data);
        }
        return redirect('role/list');
    }
}
