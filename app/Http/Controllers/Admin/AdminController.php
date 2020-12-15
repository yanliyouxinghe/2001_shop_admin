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
        
        $data=$request->except('_token','role','true_pwd');
    //    dd($data['admin_name']);
        $AdminModel =  new AdminModel();
        $data['admin_pwd']=password_hash($data['admin_pwd'],PASSWORD_DEFAULT);
        $reg=  $AdminModel->create($data);
         
        if($reg){
            $role=$request->role;
            $datas=[];
            foreach($role as $k=>$v){
                $datas['admin_id']=$reg->admin_id;
                // dd($datas['admin_id']);
                $datas['role_id']=$v;
                // dd($datas);
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
        $RoleModel=new RoleModel();
        $role=$RoleModel->roleinfo();
        // dd($role);
        $data=AdminModel::where('admin_id',$id)->first();
        return view('admin.edit',['data'=>$data,'role'=>$role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data=$request->except('_token','role');
        $data['admin_pwd']=password_hash($data['admin_pwd'],PASSWORD_DEFAULT);
        // dd($data['admin_id']);
        $res=AdminModel::where('admin_id',$data['admin_id'])->update($data);
        if($res){
            Admin_RoleModel::where('admin_id',$data['admin_id'])->delete();
            $role=$request->except('_token','admin_name','admin_pwd','admin_tel','admin_logo','admin_id');
            // dd($role);
            // dd($data['admin_id']);
            $datas=[];
            
                // dd($datas['admin_id']);
            foreach($role['role'] as $k=>$v){
                $datas['admin_id']=$data['admin_id'];
                $datas['role_id']=$v;
                // dump($datas);
                $admin_role=Admin_RoleModel::insert($datas);
            }
            // dump($datas);
            // die;
            
            // $datas=json_encode($datas);
            // $datas=explode(",",$datas);
            // dd($datas);
            
            //dd($datas);
           
            if($admin_role){
                echo '<script>alert("修改成功");location.href="/admin/list"</script>';
                die;
            }
            
            // return json_encode(['code'=>0,'msg'=>'OK']);
        }else{
            return redirect('admin.edit');

        }
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

    public function addrole($admin_id){
        $RoleModel=new RoleModel();
        $Role = $RoleModel::get();
        // dd($Menu);
        $Admin_role = Admin_RoleModel::where('admin_id',$admin_id)->pluck('role_id');
        
        $admin_role = count($Admin_role)?$Admin_role->toArray():[];
        // dd($admin_role);
        // $Menu = menuTree($Menu);
        return view('admin/addrole',['role'=>$Role,'admin_id'=>$admin_id,'admin_role'=>$admin_role]);
    }
    public function addroledo(Request $request){
        $post = $request->except('_token');
        // dd($post);
        if(isset($post['menucheck'])){
            Role_MenuModel::where('admin_id',$post['admin_id'])->delete();
            $data = [];
            foreach($post['menucheck'] as $v){
                $data[]=[
                    'admin_id' => $post['admin_id'],
                    'role_id' => $v
                ];
                
            }
            // dump($data);
            Admin_RoleModel::insert($data);
        }
        return redirect('admin/list');
    }


    public function uploads(Request $request)
    {
        //接收文件上传的值
        $photo = $request->file();
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
        $photo = $request->file('file');
        //文件上传
        $store_result = $photo->store("upload");
            $store_results = '/'.$store_result;
            return json_encode(['code'=>0,'msg'=>'上传成功','data'=>$store_results]);
        }
        return json_encode(['code'=>1,'msg'=>'文件上传失败']);

    }
}
