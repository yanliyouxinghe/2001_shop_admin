<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AdminModel;
use App\Model\RoleModel;
use App\Model\MenuModel;
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $MenuModel =  new MenuModel();
        $data =  $MenuModel->list_data();
        $data = $this->Treecate($data);
        return view('menu.list',['data'=>$data]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $MenuModel=new MenuModel();
      $data= $MenuModel->p_list();
     //dd($data);
        return  view('menu.create',['data'=>$data]);
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
        $MenuModel =  new MenuModel();
        $data =  $MenuModel->create_data($data);
        if($data){
          echo "<script>
                  if(confirm('添加成功,是否继续添加')==true){
                      location.href='create';
                 }else{
                    location.href='list';
                 }
                 </script>";
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
        //无限极分类
        public function Treecate($data,$parent_id=0,$level=0){
            if(!$data){
                return;
            }
           static  $res = [];
            foreach ($data as $key => $value) {
              if($value['parent_id'] == $parent_id){
                  $value['level'] = $level;
                  $res[] = $value;
                  $this->Treecate($data,$value['menu_id'],$level+1);
              }
            }
            return $res;
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
        $MenuModel=new MenuModel();
        $data= $MenuModel->p_list();
        $data1=MenuModel::where('menu_id',$id)->first();
        // dump($data1);die;
        return view('menu.edit',['data'=>$data,'data1'=>$data1]);
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
        $data=$request->except('_token');
        $res=MenuModel::where('menu_id',$id)->update($data);
        if($res){
            echo '<script>alert("修改成功");location.href="/menu/list"</script>';
            die;
            // return json_encode(['code'=>0,'msg'=>'OK']);
        }else{
            return redirect('menu.edit');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $menu_id = $request->input('menu_id');
        // dd($menu_id);
        $MenuModel =  new MenuModel();
         $res=$MenuModel->destroy($menu_id);
        if($res){
            return json_encode(['code'=>0,'msg'=>'OK']);
      }
    }
}
