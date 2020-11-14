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
            <td>{{$v->ad_id}}</td>
            <td>{{$v->ad_name}}</td>
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
        <tr><td colspan="6">{{$ad->links()}}</td></tr>
        </tbody>
     </table>
    </div>
    </body>
    </html>

<script src="http://libs.baidu.com/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
  $(document).on('click','.del',function(){
    var _this = $(this);
    var ad_id = _this.attr('ad_id');
    if(!ad_id){
      return; 
    }
  if(confirm("您确定要删除吗?")){
      $.get('/ad/destroy',{ad_id:ad_id},function(res){
          if(res.code==0){
              _this.parent().parent().remove();
          }else{
            alert(res.msg);
          }
      
      },'json')
  }
    


  })















</script>
@endsection

