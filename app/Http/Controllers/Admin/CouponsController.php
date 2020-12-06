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
		// dump($data);die;
		return view('coupons.create',['data'=>$data]);
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
// dump($res);die;

        if($request->hasFile('coupons_img')){
            $res['coupons_img']=$this->upload('coupons_img');
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

	//图片上传
	function upload($filename){
        if(request()->file($filename)->isValid()){
            $photo=request()->file($filename);
            $store_result=$photo->store('upload');
            return $store_result;
        }
        exit('未获取到上传文件或上传文件中出错');
    }

    //列表展示
    public function list(){
    	$data=CouponsModel::all();
    	// $data1=$data->toArray();
    	foreach ($data as $v) {
    		
    	}

    	$goods_data=GoodsModel::where('goods_id',$v->goods_id)->first();
    	// dump($goods_data);die;
    	return view('coupons.list',['data'=>$data,'data1'=>$goods_data]);
    }

    //删除
    public function destroy($id)
    {
        
        // dump($id);die;
        $res=CouponsModel::destroy($id);
        // dump($res);die;
        if($res){
        	echo '<script>alert("删除成功");location.href="/coupons/list"</script>';
            die;
            // return json_encode(['code'=>0,'msg'=>'OK']);
        }else{
            // return json_encode(['code'=>1,'msg'=>'删除失败']);
            
        }
    }

    // 修改
    public function edit($id){
    	$res=CouponsModel::where('coupons_id',$id)->first();
		$data=GoodsModel::all();

    	return view('coupons.edit',['data'=>$res,'data1'=>$data]);
    }

    public function update($id){
    	$data=Request()->except('_token');

    	// dump($data);die;
    	if(Request()->hasFile('coupons_img')){
            $data['coupons_img']=$this->upload('coupons_img');
        }
    	$res=CouponsModel::where('coupons_id',$id)->update($data);
    	if($res){
    		return redirect('coupons/list');
    	}else{
    		return redirect('coupons/edit');
    	}
    }


}