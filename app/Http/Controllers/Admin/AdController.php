<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AdModel;
use App\Model\AdvModel;
class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ad = AdModel::where('is_del',1)->orderBy('ad_id','desc')->paginate(3);
        return view('ad.index',['ad'=>$ad]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ad.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $request->except('token');
        $res = AdModel::create($post);
        if($res){
            return redirect('/ad');
        }
    }

    

    /**查看广告 */
    public function ch($id){
        $adv = AdvModel::join('sh_ad','sh_adv.ad_id','=','sh_ad.ad_id')
                       ->where('sh_adv.ad_id',$id)
                       ->paginate(5);
        return view('admin.adv.index',['adv'=>$adv]);
    }


   
    /**生成广告 */
    public function createhtml($ad_id){
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ad = AdModel::where('ad_id',$id)->first();
        return view('ad.edit',['ad'=>$ad]);
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
        $post = $request->except('_token');
        $res = AdModel::where('ad_id',$id)->update($post);
        if($res){
            return redirect('/ad');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id=0)
    {
        $id = request()->ad_id;
       
        if(!$id){
            return json_encode(['code'=>1,'msg'=>'参数丢失。。。。']);
        }
        $res = AdModel::where('ad_id',$id)->update(["is_del"=>2]);
        if($res){
            return json_encode(['code'=>0,'msg'=>'OK']);
        }else{
            return json_encode(['code'=>2,'msg'=>'操作繁忙。。。']);
        }

    
    }
}
