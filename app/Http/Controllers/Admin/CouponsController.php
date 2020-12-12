<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AdminModel;
use App\Model\RoleModel;
use App\Model\MenuModel;
use App\Model\Admin_RoleModel;
use App\Model\GoodsModel;
use App\Model\CouponsModel;


class CouponsController extends Controller
{
	//添加
	public function create(){
		$data=GoodsModel::all();
		return view('Coupons.create',['data'=>$data]);
	}

	//执行添加
	public function store(Request $request){
		$res=$request->except('_token');
		// dump($res);
		if (empty($res['coupons_name']) || empty($res['coupons_meet']) || empty($res['coupons_price'])) {
            return redirect('/coupons/create')->with('msg', '必填项不能为空');
            die;
        }
        $coupons_name=CouponsModel::where('coupons_name',$res['coupons_name'])->first();
        $coupons_price=CouponsModel::where('coupons_price',$res['coupons_price'])->first();
        $coupons_meet=CouponsModel::where('coupons_meet',$res['coupons_meet'])->first();
        if ($coupons_name) {
            return redirect('/coupons/create')->with('msg', '此优惠券名称已存在，请重新添加');
            die;
        } else if ($coupons_meet) {
            return redirect('/coupons/create')->with('msg', '此满足条件已存在');
            die;
        } else if ($coupons_price) {
            return redirect('/coupons/create')->with('msg', '此优惠券价格已存在');
            die;
        }
        $data=CouponsModel::create($res);
         if ($data) {
            //添加成功
            echo '<script>alert("添加成功");location.href="/coupons/list"</script>';
            die;
        } else {
            //添加失败
            return redirect('/coupons/create')->with('msg', '您输入信息有误');
            die;
        }
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

  //列表展示
    public function list(){
        $coupons_name=Request()->input('coupons_name');

    	$where=[];
        if($coupons_name){
            $where[]=['coupons_name','like',"%$coupons_name%"];
        }
        $couponsModel = new CouponsModel();
        $query = $couponsModel->where($where)->paginate(3);
        $query1=$query->toArray();
        $data=CouponsModel::get();
        if(empty($ata)){
            foreach($data as $v){}
        
        $goods_data=GoodsModel::first();
        if(request()->ajax()){
              return view('coupons.listajax',['query'=>$query,'data'=>$data,'data1'=>$goods_data]);
        }
        return view('coupons.list',['data'=>$data,'data1'=>$goods_data,'query'=>$query]);
        
    }else{
        $goods_data=GoodsModel::where('goods_id',$v->goods_id)->first();

        if(request()->ajax()){
              return view('Coupons.listajax',['query'=>$query,'data'=>$data,'data1'=>$goods_data]);
        }
        return view('coupons.list',['data'=>$data,'data1'=>$goods_data,'query'=>$query]);
    }
        


    //删除
    public function destroy()
    {        
        
        $id = Request()->all();

        if(!$id){
            return json_encode(['code'=>11,'msg'=>'请选择要删除的数据']);
        }
        foreach ($id as $k=>$v){
            // print_r($v);die;
            $isdel = CouponsModel::destroy($v);
        }
        if($isdel){
            return json_encode(['code'=>0,'msg'=>'OK']);
        }else{
            return json_encode(['code'=>1,'msg'=>'删除失败']);
        }
    }

    // 修改
    public function edit($id){
    	$res=CouponsModel::where('coupons_id',$id)->first();
		$data=GoodsModel::all();

    	return view('coupons.edit',['data'=>$res,'data1'=>$data]);
    }
    //执行修改
    public function update($id){
    	$data=Request()->except('_token');

    	// dump($data);die;
    	if(Request()->hasFile('coupons_img')){
            $data['coupons_img']=$this->upload('coupons_img');
        }
    	$res=CouponsModel::where('coupons_id',$id)->update($data);
    	if($res){
    		return redirect('/coupons/list');
    	}else{
    		return redirect('/coupons/edit');
    	}
    }

    //即点即该
    public function updated(Request $request){
        $coupons_id = $request->input('coupons_id');
        $coupons_name = $request->input('coupons_name');
//        dd($brand_names);
        if(!$coupons_id || !$coupons_name){
            return json_encode(['code'=>3,'msg'=>'不能为空']);
        }
        $ret = CouponsModel::where('coupons_id',$coupons_id)->update(['coupons_name'=>$coupons_name]);
//        dd($ret);
        if($ret==1){
           return json_encode(['code'=>0,'msg'=>'修改成功']);
        }else{
            return json_encode(['code'=>4,'msg'=>'修改失败']);
        }

    }


}