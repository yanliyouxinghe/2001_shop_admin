<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AdvModel;    
use App\Model\AdModel;   //广告位置
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
    public function store(Request $request)
    {
        $post = $request->except('_token');
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
