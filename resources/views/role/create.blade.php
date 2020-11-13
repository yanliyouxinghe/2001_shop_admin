@extends('layouts.layout')  
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
<h4 style="color:green">角色添加</h4>
</blockquote>

<form class="layui-form" action="{{url('/role/store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="layui-form-item">
            <label class="layui-form-label">角色名称:</label>
            <div class="layui-input-block">
            <input type="text" name="role_name" lay-verify="title" autocomplete="off" placeholder="请输入角色名称" class="layui-input">
            <b style="color:red; font-family:'仿宋' "></b> 
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">角色描述:</label>
            <div class="layui-input-block">
            <input type="text" name="role_desc" lay-verify="title" autocomplete="off" placeholder="请输入角色描述" class="layui-input">
            <b style="color:red; font-family:'仿宋' "></b> 
            </div>
        </div>
<div class="layui-form-item">
            <label class="layui-form-label"></label>
            <div class="layui-input-block" align="center">
            <button type="submit" class="layui-btn">添加</button>
            <button type="reset" class="layui-btn layui-btn-primary">清除</button>
            </div>
        </div>
</form>
</body>
</html>
@endsection
