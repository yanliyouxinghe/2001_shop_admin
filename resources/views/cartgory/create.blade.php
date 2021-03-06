@extends('layouts.layout')
@section('title','分类管理')
@section('content')

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Layui</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="//res.layui.com/layui/dist/css/layui.css"  media="all">
  <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>

<blockquote class="layui-elem-quote layui-text">
<h4 style="color:green">分类添加</h4>
</blockquote>

<form class="layui-form layui-form-pane" action="/cartgory/store" method="post">
  @if (session('status'))
    <div class="alert alert-success">
        <h3 style="color:red">{{ session('status') }}</h3>
    </div>
@endif
  <span style="color:red" class="error_span"></span>
  <!-- 分类名称 -->
  <div class="layui-form-item">
  <label class="layui-form-label">分类名称</label>
  <div class="layui-input-block">
    <input type="text" name="cat_name" autocomplete="off" placeholder="请填写分类名称" class="layui-input">
  </div>
</div>
<!-- 所属分类 -->
<div class="layui-form-item">
    <label class="layui-form-label">所属分类</label>
    <div class="layui-input-block">
      <select name="parent_id" lay-filter="aihao">  
        @foreach($cart as $k=>$v)
        <option value="{{$v->cat_id}}">{{str_repeat('|--',$v->level)}}{{$v->cat_name}}</option>
        @endforeach
      </select>
    </div>
  </div>
<!-- 是否显示 -->
<div class="layui-form-item">
   <label class="layui-form-label">是否显示</label>
   <div class="layui-input-block">
     <input type="radio" name="is_show" value="1" title="是" checked="">
     <input type="radio" name="is_show" value="2" title="否">
   </div>
 </div>
<!-- 提交 -->

<center><div>
       <button type="submit" class="layui-btn sub">添加</button>
       <button type="reset" class="layui-btn layui-btn-danger">重置</button>
       <a href="/category/list" class="layui-btn">列表</a>
 </div></center>

</form>
</body>
<script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.js"></script>
<script>

    $('.sub').click(function(){
        var cat_name = $('input[name="cat_name"]').val();
        if(!cat_name){
          $('.error_span').html('请填写分类名称');
          return false;
        }
        $('from').submit();
    });
</script>
</html>
@endsection
