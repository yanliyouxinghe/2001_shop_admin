<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\BrandModel;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

         $brand_name = $request->input('brand_name');
          //print_r($brand_name);exit;
        $where = [];
        if($brand_name){
            $where[]=['brand_name','like',"%$brand_name%"];
        }
         $brandModel = new BrandModel();
        $data = $brandModel::where($where)->paginate(3);
        if (Request()->ajax()){
            return view('brand.ajaxpage', ['data' => $data]);
        }

    //    dd($data);
        return view('brand.list', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $request->except('_token');
        // dd($post);
         if (empty($post['brand_name']) || empty($post['brand_url']) || empty($post['brand_logo'])) {
            return redirect('/brand/create')->with('msg', '必填项不能为空');
            die;
        }
         $brandModel = new BrandModel();
        //唯一性验证
        $jname = $brandModel::where('brand_name', $post)->first();
        $jurl = $brandModel::where('brand_url', $post)->first();

        if ($jname) {
            return redirect('/brand/create')->with('msg', '此品牌名称已存在，请重新添加');
            die;
        } else if ($jurl) {
            return redirect('/brand/create')->with('msg', '此品牌网址已存在，请添加不存在的品牌网址');
            die;
        }
        //执行添加
        $res = $brandModel->create($post);
        if ($res) {
            //添加成功
            echo '<script>alert("添加成功");location.href="/brand/list"</script>';
            die;
        } else {
            //添加失败
            return redirect('/brand/create')->with('msg', '您输入信息有误');
            die;
        }

    }
     //文件上传

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
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $brandModel = new BrandModel();
        $data = $brandModel->where('brand_id',$id)->first();
//        dd($data);
        return view('brand.update',['data'=>$data]);
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
     public function destroy()
    {
        $ids = Request()->all();
        if(!$ids){
            return json_encode(['code'=>11,'msg'=>'请选择要删除的数据']);
        }
        foreach ($ids as $k=>$v){
            $isdel = BrandModel::destroy($v);
        }
//        dd($isdel);
        if($isdel){
            return json_encode(['code'=>0,'msg'=>'OK']);
        }else{
            return json_encode(['code'=>1,'msg'=>'删除失败']);
        }
    }

    //即点即该
    public function updated(Request $request){
        $brand_id = $request->input('brand_id');
        $brand_name = $request->input('brand_name');
//        dd($brand_names);
        if(!$brand_id || !$brand_name){
            return json_encode(['code'=>3,'msg'=>'不能为空']);
        }
        $ret = BrandModel::where('brand_id',$brand_id)->update(['brand_name'=>$brand_name]);
//        dd($ret);
        if($ret==1){
           return json_encode(['code'=>0,'msg'=>'修改成功']);
            // return $this->JsonResponse('0','修改成功');
        }else{
            return json_encode(['code'=>4,'msg'=>'修改失败']);
        }

    }
}
