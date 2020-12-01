<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\GoodsModel;
use App\Model\SeckillModel;
use DB;
use Illuminate\Support\Facades\Redis;
class SeckillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=SeckillModel::select('sh_seckill.*','sh_goods.goods_name','sh_goods.goods_img')->leftjoin('sh_goods','sh_seckill.goods_id','=','sh_goods.goods_id')->get();
       
              
        return view('seckill/list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $goods = GoodsModel::get();
        // dd($goods);
        return view('seckill/create',['goods'=>$goods]);
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
        $res=SeckillModel::create($data);
        if($res){
            for($i=0;$i<$data['seckill_number'];$i++){
                redis::lpush('seckill_'.$data['goods_id'],1);
            }
            
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
        //
    }
}
