@extends('layouts.layout')
@section('title','商家列表')
@section('content')
  
    <!DOCTYPE html>
<html>

<body>
 <blockquote class="layui-elem-quote layui-text">
<h4 style="color:green">商家审核展示</h4>
</blockquote>
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <!-- <a href="seuser/create"><button type="button" class="btn btn-primary">前往添加</button></a> -->
<table class="table">
    <thead>
    <tr>
        <th><input type="checkbox" name="allbox"></th>
        <th>ID</th>
        <th>商家电话</th>
        <th>审核状态</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($seuserInfo as $k=>$v)
    <tr seuser_id="{{$v->seuser_id}}">
        <td><input type="checkbox" name="box" value="{{$v->seuser_id}}"></td>
        <td>{{$v->seuser_id}}</td>
        <td id="{{$v->seuser_id}}"><span class="oldname user_name">{{$v->seuser_plone}}</span></td>
        <td class="shen">
           @if($v->seuser_start==0)
             待审核
            @elseif($v->seuser_start==1)
            审核通过
            @elseif($v->seuser_start==2)
             审核失败
            @endif
        </td>
        <td>
            <button type="button" class="btn btn-info aa" seuser_id="{{$v->seuser_id}}">审核通过</button>
            <button type="button" class="btn btn-danger aa" seuser_id="{{$v->seuser_id}}">审核失败</button>
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
      var seuser_id = _this.attr('seuser_id');
      //alert(seuser_id);
      $.get('/seuser/won',{seuser_id:seuser_id,_val:_val},function(res){
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
      var seuser_id = new Array();
      $('input[name="box"]:checked').each(function(){
        seuser_id.push($(this).val())
      });

      if(seuser_id.length==0){
          alert("请选择要删除的数据");
      return;
    }

    $.get('/seuser/morepass',{seuser_id:seuser_id,_val:_val},function(res){
        //    console.log(res);
           if(res.code==7){
              location.reload();
           }else if(res.code==8){
            location.reload(); 
           }
      },'json');


   })


//全选
$(document).on('click','input[name="allbox"]',function (){
    var _this = $(this);
    if(_this.prop('checked') == true){
        $('input[name="box"]').prop('checked',true);
    }else{
        $('input[name="box"]').prop('checked',false);
    }

});

</script>

