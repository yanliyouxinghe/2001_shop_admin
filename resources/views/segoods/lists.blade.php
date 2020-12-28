@extends('layouts.layout')
@section('title','商家商品列表')
@section('content')
  
    <!DOCTYPE html>
<html>

<body>
 <blockquote class="layui-elem-quote layui-text">
<h4 style="color:green">商家商品审核展示</h4>
</blockquote>
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <!-- <a href="seuser/create"><button type="button" class="btn btn-primary">前往添加</button></a> -->
<table class="table">
    <thead>
    <tr>
        <th><input type="checkbox" name="allbox"></th>
                <th width="30px">商品ID</th>
                <th width="100px">商品名称</th>
                <th width="50px">商品货号</th>
                <th width="50px">商品价格</th>
                <th width="50px">商品图片</th>
                <th width="50px">商品重量</th>
                <th width="50px">商品存库</th>
                <th width="50px">库存警告数量</th>
                <th width="50px">审核状态</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($seuserInfo as $k=>$v)
    <tr goods_id="{{$v->goods_id}}">
        <td><input type="checkbox" name="box" value="{{$v->goods_id}}"></td>
        <td>{{$v->goods_id}}</td>
                <td>{{$v->goods_name}}</td>
                <td>{{$v->goods_sn}}</td>
                <td>{{$v->shop_price}}</td>
                <td>@if(!empty($v->goods_img)) <img src="{{$v->goods_img}}" width="50px"> @endif </td>
                <td>{{$v->goods_weight}}</td>
                <td>{{$v->goods_number}}</td>
                <td>{{$v->warn_number}}</td>
        <td class="shen">
           @if($v->is_static==0)
             待审核
            @elseif($v->is_static==1)
            审核通过
            @elseif($v->is_static==2)
             审核失败
            @endif
        </td>
        <td>
            <button type="button" class="btn btn-info aa" goods_id="{{$v->goods_id}}">审核通过</button>
            <button type="button" class="btn btn-danger aa" goods_id="{{$v->goods_id}}">审核失败</button>
        </td>
    </tr>
    @endforeach
    <tr>
       <td colspan="4">{{$seuserInfo->links('vendor.pagination.adminbrand') }}
    </tr>

    <!-- <button type="button" class="layui-btn layui-btn-xs layui-btn-normal" id="batch">批量审核</button> -->
    <button type="button" class="layui-btn layui-btn-xs layui-btn-normal" id="su">批量通过</button>
    <button type="button" class="layui-btn layui-btn-xs layui-btn-normal" id="su">批量失败</button>
    </tbody>

</table>
</body>
</html>
@endsection
<script src="http://apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
   //审核
   $(document).on('click','.aa',function(){
       let _val=$(this).html();
    //    alert(_val);

      var _this = $(this);
      var goods_id = _this.attr('goods_id');
    //   alert(goods_id);
      $.get('/segoods/won',{goods_id:goods_id,_val:_val},function(res){
           // console.log(res);
           if(res.code==5){
              location.reload();
           }else if(res.code==6){
            location.reload(); 
           }
      },'json');
   })



   //批量审核
   $(document).on('click','#su',function(){
      let _val=$(this).html();
      var _this = $(this);
      var goods_id = new Array();
      $('input[name="box"]:checked').each(function(){
        goods_id.push($(this).val())
      });

      if(goods_id.length==0){
          alert("请选择要审核的数据");
      return;
    }

    $.get('/segoods/morepass',{goods_id:goods_id,_val:_val},function(res){
        //    console.log(res);
           if(res.code==7){
              location.reload();
           }else if(res.code==8){
            location.reload(); 
           }
      },'json');


   })


//      //全选反选
//   $(document).on('click','.layui-form-checkbox:eq(0)',function(){
//     var checkval = $('input[name="allbox"]').prop('checked');
//     $('input[name="box"]').prop('checked',checkval);
//     if(checkval){
//       $('.layui-form-checkbox:gt(0)').addClass('layui-form-checked')
//     }else{
//       $('.layui-form-checkbox:gt(0)').removeClass('layui-form-checked')
//     }
//   })

</script>
