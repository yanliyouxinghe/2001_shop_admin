@extends('layouts.layout')
@section('title','广告位置管理')
@section('content')
   
<html>
<head>
<meta charset="utf-8">
<title>Layui</title>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="//res.layui.com/layui/dist/css/layui.css" media="all">
<!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>

<blockquote class="layui-elem-quote layui-text">
<h4 style="color:green">广告位置列表</h4>
</blockquote>

    <div class="layui-form">
     <table class="layui-table">
        <thead>
            <tr width="400px">
            <th><input type="checkbox" name="allbox"></th>
            <th width="200px">广告位置ID</th>
            <th width="400px">广告位置名称</th>
            <th width="400px">广告位置宽度</th>
            <th width="400px">广告位置高度</th>
            <th width="400px">广告位置介绍</th>
            <!-- <th width="400px">广告位置模板</th> -->
            <th width="600px">操作</th>
            </tr>
        </thead>
        <tbody>
        @foreach($ad as $v)
          <tr ad_id="{{$v->ad_id}}">
            <td><input type="checkbox" name="box" value="{{$v->ad_id}}"></td>
            <td>{{$v->ad_id}}</td>
            <td id="{{$v->ad_id}}" oldval="{{$v->ad_name}}">
               <span class="span_ad">{{$v->ad_name}}</span>
            </td>
            <td>{{$v->ad_width}}</td>
            <td>{{$v->ad_height}}</td>
            <td>{{$v->ad_desc}}</td>
            <!-- <td>{{$v->template}}</td> -->
            <td>
            <a href="{{url('ad/sh/'.$v->ad_id)}}"><button type="button" class="layui-btn layui-btn-normal">生成广告</button></a>
            <a href="{{url('ad/ch/'.$v->ad_id)}}"><button type="button" class="layui-btn layui-btn-normal">查看广告</button></a>
            <a href="{{url('ad/edit/'.$v->ad_id)}}"><button type="button" class="layui-btn layui-btn-normal">修改</button></a>
            <button type="button" class="layui-btn layui-btn-danger del" ad_id="{{$v->ad_id}}">删除</button>
               </td>
           
          </tr>
        @endforeach
        <tr><td colspan="7">{{$ad->links()}}</td>
          <button type="button" class="moredel">批量删除</button>
        </tr>
        </tbody>
     </table>
    </div>
    </body>
    </html>

<script src="http://libs.baidu.com/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
  //ajax删除(单)
  $(document).on('click','.del',function(){
    var _this = $(this);
    var ad_id = [];
    ad_id.push(_this.attr('ad_id'));
    if(!ad_id){
      return; 
    }
    if(confirm("您确定要删除吗?")){
        $.get('/ad/destroy',{'ad_id':ad_id},function(res){
            if(res.code==0){
                _this.parent().parent().remove();
            }else{
              alert(res.msg);
            }     
        },'json')
    }
  })

  //批量删除
  $(document).on('click','.moredel',function(){
    var ad_id = new Array();
    $('input[name="box"]:checked').each(function(){
      ad_id.push($(this).val());
    })
    // alert(ids);
    if(ad_id.length==0){
      alert("请选择要删除的数据");
      return;
    }
    
    //4.用ajax传数据
    if(confirm("您确定要删除吗?")){
      $.get('/ad/destroy',{'ad_id':ad_id},function(res){
        if(res.code==0){
          $('input[name="box"]:checked').parent().parent().remove();
            }else{
              alert(res.msg);
            }
      },'json')
    }
    
  })


  //全选反选
  $(document).on('click','.layui-form-checkbox:eq(0)',function(){
    var checkval = $('input[name="allbox"]').prop('checked');
    $('input[name="box"]').prop('checked',checkval);
    if(checkval){
      $('.layui-form-checkbox:gt(0)').addClass('layui-form-checked')
    }else{
      $('.layui-form-checkbox:gt(0)').removeClass('layui-form-checked')
    }
  })

  //即点即改
  $(document).on('click','.span_ad',function(){
    var ad_name = $(this).text();          //获取span框的值
    var id = $(this).parent().attr('id');
  
   $(this).parent().html('<input type="text" class="changeValue input_name" value='+ad_name+'>');
   //把写焦点定位让它|定位到值的后面
   $('.input_name').val('').focus().val(ad_name);
  
   //第二部分
   $(document).on('blur','.changeValue',function(){
     var newname = $(this).val();       //获取新值
     if(!newname){
       alert('内容不能为空');
       return;
     }
     //判断 不改  新值 = 旧值
     var oldval = $(this).parent().attr('oldval');
     if(newname==oldval){
        $(this).parent().html('<span class="span_ad">'+newname+'</span>');
        return;
     }
     var id = $(this).parent().attr('id');
     var obj = $(this);
     //第三部分
     $.ajax({
       url:'/ad/change',
       dataType:'json',
       type:'post',
       data:{id:id,ad_name:newname},
       success:function(res){
         if(res.code == 0){
           obj.parent().html('<span class="span_ad">'+newname+'</span>');
         }
        
       }
     })
    


   })

  })
















</script>
@endsection

