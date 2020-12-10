<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AdModel;
use App\Model\AdvModel;
use App\Http\Requests\StoreAdPost;
class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ad_name = request()->ad_name;
        $where = [];
        if($ad_name){
            $where[] = ['ad_name','like',"%$ad_name%"];
        }

        
        $ad = AdModel::where('is_del',1)->where($where)->orderBy('ad_id','desc')->paginate(3);

        if(request()->ajax()){
            return view('ad.ajaxindex',['ad'=>$ad]);
        }
        
        return view('ad.index',['ad'=>$ad,'ad_name'=>$ad_name]);
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
    public function store(StoreAdPost $request)
    {
        $post = $request->except('_token');
        $res = AdModel::create($post);
        if($res){
            return redirect('/ad');
        }
    }

    /**查看广告 */
    public function ch($id){
        //判断广告位下有无广告
            if(!$id){
               return;
            }

            $adv = AdvModel::where('ad_id',$id)->first();
            if(!isset($adv)){
                return "<script>alert('该广告位还没广告,请添加广告');location.href='/adv/create'; </script>";
            }else{
                $advModel = new AdvModel();
                $advs = $advModel->leftjoin('sh_ad','sh_adv.ad_id','=','sh_ad.ad_id')->where('sh_adv.ad_id',$id)->get();
                return view('ad.list',['advs'=>$advs]);
            }

            
        }

    /**生成广告 */
    public function sh($ad_id){
        //根据广告位ID查询广告位信息
        $res = AdModel::where('ad_id',$ad_id)->orderBy('ad_id','desc')->first();
        if($res->template==1){
            $ads = AdvModel::where('ad_id',$ad_id)->value('adv_img');
            $template='onepic';
            }else if($res->template==2){
            $ads = AdvModel::where('ad_id',$ad_id)->pluck('adv_img');
            $template='morepic';
        }
        $content = view('ad.ads.'.$template,['ads'=>$ads,'height'=>$res->ad_height,'width'=>$res->ad_width])->render();
        $content = 'document.write(\''.$content.'\')';
        $filename = public_path('../../2001_shop_index/public/static/ads/'.$ad_id.".js");
        $red = file_put_contents($filename,$content);
        if($red){
            echo "<script>alert('生成成功');history.go(-1);</script>";
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
    public function update(StoreAdPost $request, $id)
    {
        $post = $request->except('_token');
        $res = AdModel::where('ad_id',$id)->update($post);
        if($res!==false){
            return redirect('/ad');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $id = request()->ad_id;

        if(!$id){
            return json_encode(['code'=>1,'msg'=>'参数丢失']);
        }
        if(is_array($id)){
            foreach($id as $key=>$val){
            $res = AdModel::where(['ad_id'=>$val])->update(['is_del'=>2]);
            }
        }else{
            $res = AdModel::where(['ad_id'=>$id])->update(['is_del'=>2]);
        }

        if($res){
            return json_encode(['code'=>0,'msg'=>'删除成功']);
        }else{
            return json_encode(['code'=>2,'msg'=>'操作繁忙']);
        }

    }

    /**即点即改 */
    public function change(Request $request){
        $id = $request->id;
        $ad_name =  $request->ad_name;
        if(!$id || !$ad_name){
            return json_encode(['code'=>1,'msg'=>'参数丢失。。。。']);
        }
        $res = AdModel::where('ad_id',$id)->update(['ad_name'=>$ad_name]);
        if($res==1){
            return json_encode(['code'=>0,'msg'=>'修改成功']);
        }else{
            return json_encode(['code'=>4,'msg'=>'修改失败']);
        }
    }
}
