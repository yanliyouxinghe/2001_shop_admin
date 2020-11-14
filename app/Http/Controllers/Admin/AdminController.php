<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AdminModel;
use App\Model\RoleModel;
use App\Model\MenuModel;
use App\Model\Admin_RoleModel;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $AdminModel =  new AdminModel();
        $data =  $AdminModel->list_data();
        return view('admin.list',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $RoleModel=new RoleModel();
        $role=$RoleModel->roleinfo();
        // dd($data);
       return  view('admin.create',['role'=>$role]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data=$request->except('_token','role');
       
        $AdminModel =  new AdminModel();
        $data['admin_pwd']=password_hash($data['admin_pwd'],PASSWORD_DEFAULT);
        $reg=  $AdminModel->create($data);
         
        if($reg){
            $role=$request->role;
            $datas=[];
            foreach($role as $k=>$v){
                $datas['admin_id']=$reg->admin_id;
                $datas['role_id']=$v;
                $admin_role=Admin_RoleModel::insert($datas);
            }
          if($admin_role){
            return redirect('admin/list');
          }
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
        $admin_id=$id; 
        $AdminModel =  new AdminModel();
         $res=$AdminModel->destroy_date($admin_id);
        if($res){
            return redirect('admin/list');
        }
           
        
        

    }
}
