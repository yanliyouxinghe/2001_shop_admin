<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\CartgoryModel;
use App\Model\GoodsModel;
class CartgoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartgory = new CartgoryModel();
        $cart_data = $cartgory->cart_datas();
        foreach ($cart_data as $k => $v) {
            if($v->parent_id > 0){
              $v['parent_name'] = $cartgory->select('cat_name')->where(['is_show'=>1,'cat_id'=>$v->parent_id])->get()->toArray();
            }
        }
        if(request()->ajax()){
              return view('cartgory.listajax',['cart_data'=>$cart_data]);
        }
        // dd($cart_data);
        return view('cartgory.list',['cart_data'=>$cart_data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获取分类所有数据
        $cartgory = new CartgoryModel();
        $cart_data = $cartgory->cart_data();
        $cart = $this->Treecate($cart_data);
        // dd($cart);
        return view('cartgory.create',['cart'=>$cart]);
    }


    //无限极分类
    public function Treecate($cart_data,$parent_id=0,$level=0){
      if(!$cart_data){
          return;
      }
     static  $res = [];
      foreach ($cart_data as $key => $value) {
        if($value['parent_id'] == $parent_id){
            $value['level'] = $level;
            $res[] = $value;
            $this->Treecate($cart_data,$value['cat_id'],$level+1);
        }
      }
      return $res;
  }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cat_name = $request->input('cat_name');
        $parent_id = $request->input('parent_id');
        $is_show = $request->input('is_show');
        if(!$cat_name || !$parent_id || !$is_show){
            return redirect('/cartgory/create')->with('status','参数丢失...');
        }
        $data = [
          'cat_name'=>$cat_name,
          'parent_id'=>$parent_id,
          'is_show'=>$is_show,
        ];
        $cartgory = new CartgoryModel();
        $is_create = $cartgory->iscreate($data);
        if($is_create){
            return redirect('/cartgory/list');
        }else{
          return redirect('/cartgory/create')->with('status','Error...');
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
        $cartgory = new CartgoryModel();
        $cart_data = $cartgory->cart_data_update($id);
        // dd($cart_data);
        $cart_datas = $cartgory->cart_data();
        $cart = $this->Treecate($cart_datas);
        // dd($cart_data);
        return view('cartgory.edit',['cart_data'=>$cart_data,'cart'=>$cart]);
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
      $cat_id = $request->input('cat_id');
      $cat_name = $request->input('cat_name');
      $parent_id = $request->input('parent_id');
      $is_show = $request->input('is_show');
      if(!$cat_name || !$parent_id || !$is_show || !$cat_id){
          return redirect('/cartgory/edit/'.$cat_id)->with('status','参数丢失...');
      }
      $data = [
        'cat_name'=>$cat_name,
        'parent_id'=>$parent_id,
        'is_show'=>$is_show,
      ];
      $cartgory = new CartgoryModel();
      $isupdate = $cartgory->isupdate($data,$cat_id);
      if($isupdate){
          return redirect('/cartgory/list');
      }else{
        return redirect('/cartgory/edit/'.$cat_id)->with('status','Error...');
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
        $cat_ids = $request->input('cat_id');
        if(!$cat_ids){
            return json_encode(['code'=>1,'msg'=>'缺少参数...']);
        }
        $cartgory = new CartgoryModel();
        $is_del = $cartgory->is_del($cat_ids);
        if(count($is_del) == 0){
              $del = $cartgory->del($cat_ids);
              if($del){
                    return json_encode(['code'=>0,'msg'=>'OK']);
              }else{
                return json_encode(['code'=>2,'msg'=>'删除失败']);
              }
        }else{
          return json_encode(['code'=>3,'msg'=>'删除失败，原因：该分类下存在子分类']);
        }
    }

    public function destrys(Request $request){
        $cat_ids = $request->input('cat_ids');
        if($cat_ids[0] == 'on'){
            unset($cat_ids[0]);
        }

        foreach ($cat_ids as $k => $v) {
           $count =  CartgoryModel::where('parent_id',$v)->count();
           if(!$count){
              $goods = GoodsModel::where('cat_id',$v)->count();
              // dd($goods);
              if(!$goods){
                    $is_del = CartgoryModel::destroy($v);
                    if($is_del){
                        return json_encode(['code'=>0,'msg'=>'OK']);
                    }else{
                       return json_encode(['code'=>2,'msg'=>'删除失败']);
                    }
              }else{
                 return json_encode(['code'=>4,'msg'=>'删除失败，原因：您所选择的分类下存在商品']);
              }
           }else{
             return json_encode(['code'=>3,'msg'=>'删除失败，原因：您所选择的分类下存在子分类']);
           }

        }
    }
}
