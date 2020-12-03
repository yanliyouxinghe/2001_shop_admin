<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\GoodsAttrModel;
use App\Model\CartgoryModel;
use App\Model\BrandModel;
use App\Model\GoodsTypeModel;
use App\Model\GoodsModel;
use App\Model\Goods_AttrModel;
use App\Model\Goods_GalleryModel;
use App\Model\ProductModel;
use App\Model\SeuserModel;   
use Illuminate\Support\Facades\DB;
use Carbon\Traits\Timestamp;
class GoodsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $goods = GoodsModel::leftjoin('sh_seuser','sh_goods.seuser_id','=','sh_seuser.seuser_id')->get();
        
        return view('goods.list',['goods'=>$goods]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = CartgoryModel::all();
        $Ecsbrand = BrandModel::all();
        $type = GoodsTypeModel::all();
        $seuserInfo = SeuserModel::get();
        // dd($data);
        $weight_list =  $this->weightTrees($data);
        // dd($weight_list);
        return view('goods.create',['weight_list'=>$weight_list,'Ecsbrand'=>$Ecsbrand,'type'=>$type,'seuserInfo'=>$seuserInfo]);
    }

    public function weightTrees($data,$parent_id=0,$level=0){
        if(!$data){
            return;
        }
       static  $res = [];
        foreach ($data as $key => $value) {
          if($value['parent_id'] == $parent_id){
              $value['level'] = $level;
              $res[] = $value;
              $this->weightTrees($data,$value['cat_id'],$level+1);
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

            // DB::beginTransaction();
            // try {
                // dd($request->all());
                $attr_id_list = $request->input('attr_id_list')??[];
                $attr_value_list = $request->input('attr_value_list')??[];
                $attr_price_list = $request->input('attr_price_list')??[];
                $goods_imgs = $request->input('goods_imgs')??[];
            


                $promote_start_date = $request->input('promote_start_date');
                $promote_end_date = $request->input('promote_end_date');

                $post = $request->except(['attr_id_list','attr_value_list','attr_price_list','goods_imgs']);
                // dd($post);
                $post['goods_sn'] = $post['goods_sn']?$post['goods_sn']:$this->addProduct();
                $post['promote_start_date'] = strtotime($promote_start_date);
                $post['promote_end_date'] = strtotime($promote_end_date);

                // dd($post);
                // dd($post);
                $goods_id = GoodsModel::insertGetId($post);
                if(!$goods_id){
                    return false;
                }
                if(count($attr_id_list) && count($attr_value_list)){
                         $data = [];
                        for($i=0; $i< count($attr_id_list); $i++){
                            $data[] = [
                                'goods_id' => $goods_id,
                                'attr_id' => $attr_id_list[$i],
                                'attr_value' => $attr_value_list[$i],
                                'attr_price' => $attr_price_list[$i],
                            ];
                        }
                      Goods_AttrModel::insert($data);
                }
                $arr = [];
                foreach($goods_imgs as $v){
                    $arr[] = [
                        'goods_id' => $goods_id,
                        'img_url' => $v,
                    ];
                }
                Goods_GalleryModel::insert($arr);
                //判断是否有规格
                $goods_sper= $this->Attrnum($goods_id);
                // dump($goods_sper);
                if(count($goods_sper)){
                    $new_goods_sper = [];
                    foreach($goods_sper as $k=>$v){
                        $new_goods_sper['attr_name'][$v['attr_id']] = $v['attr_name'];
                        $new_goods_sper['attr_value'][$v['attr_id']][$v['goods_attr_id']] = $v['attr_value'];
                    }
                    //  dd($new_goods_sper);
                        $goods = GoodsModel::select('goods_id','goods_name','goods_sn')
                                 ->where('goods_id',$goods_id)
                                 ->first();
                        // dd($goods);         
                        return view('goods.product',['goods_sper'=>$new_goods_sper,'goods_id'=>$goods_id,'goods'=>$goods]);
                }
                // dd($goods_sper);
                // DB::commit();

                //code...
            // } catch (\Throwable $th) {
            //     //throw $th;
            //     DB::rollBack();
            //     echo "<script>alert('操作繁忙请稍后重试');location.href='/goods/create'</script>";
            // }
    }

        public function pruct(){
            $post = request()->all();
            // dd($post);
            if(count($post['attr'])){
                $attr = $post['attr'];
                // dump($post);
                $firstkey = array_key_first($attr);
                $count = count($attr[$firstkey]);
                for($i = 0; $i<$count; $i++){
                    $new_attr[] = array_column($attr,$i);
                }

                $product = [];
                foreach($new_attr as $k=>$v){
                    $product[] = [
                        'goods_id' => $post['goods_id'],
                        'goods_attr' => implode('|',$v),
                        'product_sn' => $post['product_sn'][$k]?:$this->addProduct(),
                        'product_number' => $post['product_number'][$k]?:'1',
                    ];
                }
                $srt = ProductModel::insert($product);
                //dd($srt);
                if($srt){
                    return redirect('/goods/list');
                }else{
                    echo "<script>alert('操作繁忙请稍后重试');location.href='/goods/create'</script>";

                }
            }
        }

        public function addProduct(){
            return 'ECS'.time().rand(1000,9999);
        }

     //文件上传
     public function upload(Request $request)
     {
         //接收文件上传的值
         $photo = $request->file();
         //判断文件上传是否有文件或者有没有出错
         if ($request->hasFile('file') && $request->file('file')->isValid()) {
         $photo = $request->file('file');
 //        dd($photo);
         //文件上传
         $store_result = $photo->store("upload");
             $store_results = '/'.$store_result;
         //返回json
         if($request->ajax()){
            return json_encode(['code'=>0,'msg'=>'上传成功','data'=>['src'=>$store_results,'title'=>'']]);
         }
         return $store_results;
 //            dd($store_result);die;
             // return $this->JsonResponse('0','上传成功',$store_results);

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

    public function getattr(Request $request){
        $cat_id = $request->all();
        $attr = GoodsAttrModel::where('cat_id',$cat_id)->get();
        // dd($attr);
        return view('goods.typeattr',['attr'=>$attr]);
    }


    public function Attrnum($goods_id){
            $res =  Goods_AttrModel::select('goods_attr_id','sh_goods_attr.attr_id','sh_attribute.attr_name','sh_goods_attr.attr_value')
                    ->leftjoin('sh_attribute','sh_goods_attr.attr_id','=','sh_attribute.attr_id')
                    ->where(['goods_id'=>$goods_id,'attr_type'=>1])
                    ->get();
            return $res ? $res->toArray() : [];

    }
    public function item($id){
//        $goods = GoodsModel::find($id);
        return view('goods.jyl');
    }
}
