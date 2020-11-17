<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AdvModel;    
use App\Model\AdModel;   //广告位置
use App\Http\Requests\StoreAdvPost;   
class AdvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adv = AdvModel::join('sh_ad','sh_adv.ad_id','=','sh_ad.ad_id')
                        ->orderBy('adv_id','desc')
                        ->where('sh_adv.is_del',1)
                        ->paginate(5);
        return view('adv.index',['adv'=>$adv]);                
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ad = AdModel::get();
        return view('adv.create',['ad'=>$ad]);
    }

    //单图片
    // public function upload(Request $request){
    //     if ($request->hasFile('file') && $request->file('file')->isValid()) {
    //         $photo = $request->file;
    //         $store_result = $photo->store('upload');
    //          return $this->success('上传成功',env('UPLOADS_URL').$store_result);
    //     }
    //       return $this->error('上传失败');
    // } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdvPost $request)
    {
        $post = $request->except('_token');
        $post['adv_img'] = 'http://2001.shop.admin.com'.$post['adv_img'];
        // dd($post);
        $res = AdvModel::create($post);
        // dd($res);
        if($res){
            return redirect('/adv');
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
        $ad = AdModel::get();
        $adv = AdvModel::where('adv_id',$id)->first();
        return view('adv.edit',['adv'=>$adv,'ad'=>$ad]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAdvPost $request, $id)
    {
        $post = $request->except('_token');
        $res = AdvModel::where('adv_id',$id)->update($post);
        if($res){
            return redirect('/adv');
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
        $id = request()->adv_id;

        if(!$id){
            return json_encode(['code'=>1,'msg'=>'参数丢失']);
        }
        if(is_array($id)){
            foreach($id as $key=>$val){
            $res = AdvModel::where(['adv_id'=>$val])->update(['is_del'=>2]);
            }
        }else{
            $res = AdvModel::where(['adv_id'=>$id])->update(['is_del'=>2]);
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
        $adv_name = $request->adv_name;
        if(!$id || !$adv_name){
            return json_encode(['code'=>1,'msg'=>'参数缺失']);
        }
        $res = AdvModel::where('adv_id',$id)->update(['adv_name'=>$adv_name]);
        if($res==1){
            return json_encode(['code'=>0,'msg'=>'修改成功']);
        }else{
            return json_encode(['code'=>4,'msg'=>'修改失败']);
        }
    }
}
