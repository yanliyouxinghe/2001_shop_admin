@extends('layouts.layout')
@section('title','修改密码')
@section('content')
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>修改密码</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <!-- <link rel="stylesheet" href="//res.layui.com/layui/dist/css/layui.css"  media="all"> -->
  <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>
<blockquote class="layui-elem-quote layui-text">
<h4 style="color:green">分类添加</h4>
</blockquote>
	
	<form class="layui-form layui-form-pane" action="/changpwdDo" method="post">
  	@if (session('status'))
    <div class="alert alert-success">
        <h3 style="color:red">{{ session('status') }}</h3>
    </div>
	@endif

	  <!-- 管理员名称 -->
	 <div class="layui-form-item">
    <label class="layui-form-label">管理员名称</label>
    <div class="layui-input-inline">
      <input type="button" name="admin_name" lay-verify="required" value="{{$admin_name}}" autocomplete="off" class="layui-input">
    </div>
  </div>
  	<input type="hidden" name="admin_name" value="{{$admin_name}}">
	  <!-- 旧密码 -->
	  <div class="layui-form-item">
	  <label class="layui-form-label">旧密码</label>
	  <div class="layui-input-block">
	    <input type="password" name="old_pwd" autocomplete="off" placeholder="请填写旧密码" class="layui-input">
	  </div>
	</div>

  	<!-- 分类名称 -->
	  <div class="layui-form-item">
	  <label class="layui-form-label">新密码</label>
	  <div class="layui-input-block">
	    <input type="password" name="admin_pwd" autocomplete="off" placeholder="请填写新密码" class="layui-input">
	  </div>
	</div>


	<center><div>
       <button type="submit" class="layui-btn">修改</button>
       <button type="reset" class="layui-btn layui-btn-danger">重置</button>
       <a href="/" class="layui-btn">取消修改</a>
 </div></center>	


</form>
</body>
</html>

@endsection