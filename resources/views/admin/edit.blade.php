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
  <link rel="stylesheet" href="/static/admin/css/layui.css"  media="all">
  <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>

<blockquote class="layui-elem-quote layui-text">
<h4 style="color:green">管理员修改</h4>
</blockquote>

<form class="layui-form" action="{{url('/admin/update/'.$data->admin_id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="layui-form-item">
            <label class="layui-form-label">管理员名称:</label>
            <div class="layui-input-block">
            <input type="text" name="admin_name" lay-verify="title" autocomplete="off" placeholder="请输入管理员名称" class="layui-input" value="{{$data->admin_name}}">
            <b style="color:red; font-family:'仿宋' "></b> 
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">管理员密码:</label>
            <div class="layui-input-block">
            <input type="password" name="admin_pwd" lay-verify="title" autocomplete="off" placeholder="请输入管理员密码" class="layui-input" value="">
            <b style="color:red; font-family:'仿宋' "></b> 
            </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label" id="confirm">联系电话:</label>
          <div class="layui-input-block">
          <input type="tel" name="admin_tel" lay-verify="title" autocomplete="off" placeholder="请输入管理员电话 " class="layui-input" value="{{$data->admin_tel}}">
          <span></span>
          </div>
      </div>
      </div>
      <div class="layui-form-item">
            <label class="layui-form-label">角色:</label>
            <div class="layui-input-block">
              @foreach($role as $v)
              <input type="checkbox" name="role[]"  value="{{$v->role_id}}" title="">{{$v->role_name}}
              @endforeach
              </div>
    </div>
      <div class="layui-form-item">
        
        </div>
        <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">管理员头像</label>
        <div class="layui-upload-drag" id="test10">
            <input type="hidden" id="fileview" name="admin_logo" value="">
            <i class="layui-icon"></i>
            <p>点击上传，或将文件拖拽到此处</p>
            <div class="layui-hide" id="uploadDemoView">
                <hr>
                <img src="{{$data->admin_logo}}" alt="上传成功后渲染" style="max-width: 196px">
            </div>
        </div>

        <span style="color: darkred;"></span>
    </div>
<div class="layui-form-item">
            <label class="layui-form-label"></label>
            <div class="layui-input-block" align="center">
            <button type="submit" class="layui-btn">修改</button>
            <button type="reset" class="layui-btn layui-btn-primary">清除</button>
            </div>
        </div>
</form>
</body>
</html>
@endsection
