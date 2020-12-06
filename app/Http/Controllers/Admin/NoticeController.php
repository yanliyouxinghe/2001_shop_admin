<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\NoticeModel;
class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $noticeModel = new NoticeModel();
        $data = $noticeModel->paginate(3);
        if (Request()->ajax()){
            return view('notice.ajaxpage', ['data' => $data]);
        }

    //    dd($data);
        return view('notice.list', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notice.create');
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
         if (empty($post['notice_name']) || empty($post['notice_url'])) {
            return redirect('/notice/create')->with('msg', '必填项不能为空');
            die;
        }
         $noticeModel = new NoticeModel();
        //唯一性验证
        $jname = $noticeModel::where('notice_name', $post)->first();
        $jurl = $noticeModel::where('notice_url', $post)->first();

        if ($jname) {
            return redirect('/notice/create')->with('msg', '此品牌名称已存在，请重新添加');
            die;
        } else if ($jurl) {
            return redirect('/notice/create')->with('msg', '此品牌网址已存在，请添加不存在的品牌网址');
            die;
        }
        //执行添加
        $res = $noticeModel->create($post);
        if ($res) {
            //添加成功
            echo '<script>alert("添加成功");location.href="/notice/list"</script>';
            die;
        } else {
            //添加失败
            return redirect('/notice/create')->with('msg', '您输入信息有误');
            die;
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
         $noticeModel = new NoticeModel();
        $data = $noticeModel->where('notice_id',$id)->first();
//        dd($data);
        return view('notice.update',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $noticeModel = new NoticeModel();
            $data = $noticeModel->where('notice_id',$id)->first();
//        dd($data);
        return view('notice.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $post=Request()->except('_token');
        // dump($post);die;
        $res=NoticeModel::where('notice_id',$id)->update($post);
        if($res){
            return redirect('notice/list');
        }else{
            return redirect('notice/edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//         $ids = Request()->all();
//         if(!$ids){
//             return json_encode(['code'=>11,'msg'=>'请选择要删除的数据']);
//         }
//         foreach ($ids as $k=>$v){
//             $isdel = NoticeModel::destroy($v);
//         }
// //        dd($isdel);
//         if($isdel){
//             return json_encode(['code'=>0,'msg'=>'OK']);
//         }else{
//             return json_encode(['code'=>1,'msg'=>'删除失败']);
//         }
            $res=NoticeModel::where('notice_id',$id)->delete();
            if($res){
            echo '<script>alert("删除成功");location.href="/notice/list"</script>';
            die;
            // return json_encode(['code'=>0,'msg'=>'OK']);
            }else{
                return redirect('notice.list');
                
            }
    }

    //即点即该
    public function updated(Request $request){
        $notice_id = $request->input('notice_id');
        $notice_name = $request->input('notice_name');
//        dd($notice_names);
        if(!$notice_id || !$notice_name){
            return json_encode(['code'=>3,'msg'=>'不能为空']);
        }
        $ret = NoticeModel::where('notice_id',$notice_id)->update(['notice_name'=>$notice_name]);
//        dd($ret);
        if($ret==1){
           return json_encode(['code'=>0,'msg'=>'修改成功']);
            // return $this->JsonResponse('0','修改成功');
        }else{
            return json_encode(['code'=>4,'msg'=>'修改失败']);
        }

    }
}
