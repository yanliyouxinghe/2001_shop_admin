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
<h4 style="color:green">管理员添加</h4>
</blockquote>

<form class="layui-form" action="{{url('/admin/store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="layui-form-item">
            <label class="layui-form-label">管理员名称:</label>
            <div class="layui-input-block">
            <input type="text" name="admin_name" lay-verify="title" autocomplete="off" placeholder="请输入管理员名称" class="layui-input">
            <span></span>
            <b style="color:red; font-family:'仿宋' "></b> 
            </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">管理员密码:</label>
          <div class="layui-input-block">
          <input type="password" name="admin_pwd" lay-verify="title" autocomplete="off" placeholder="请输入管理员密码 " class="layui-input pwd">
          <span></span>
          <b style="color:red; font-family:'仿宋' "></b> 
          </div>
      </div>
      <div class="layui-form-item">
          <label class="layui-form-label" id="confirm">确认密码:</label>
          <div class="layui-input-block">
          <input type="password" name="true_pwd" lay-verify="title" autocomplete="off" placeholder="请确认管理员密码 " class="layui-input">
          <span></span>
          <b style="color:red; font-family:'仿宋' "></b> 
          </div>
      </div>
      <div class="layui-form-item">
            <label class="layui-form-label">角色:</label>
            <div class="layui-input-block">
              @foreach($role as $v)
              <input type="checkbox" name="role[]" lay-skin="primary" value="{{$v->role_id}}" title="{{$v->role_name}}">
              @endforeach
            </div>
        </div>
        <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">管理员头像</label>
        <div class="layui-upload-drag" id="test10">
            <input type="hidden" id="fileview" name="admin_logo" value="">
            <i class="layui-icon"></i>
            <p>点击上传，或将文件拖拽到此处</p>
            <div class="layui-hide" id="uploadDemoView">
                <hr>
                <img src="" alt="上传成功后渲染" style="max-width: 196px">
            </div>
        </div>
        <span style="color: darkred;"></span>
    </div>
<div class="layui-form-item">
            <label class="layui-form-label"></label>
            <div class="layui-input-block" align="center">
            <button type="submit" class="layui-btn add">添加</button>
            <button type="reset" class="layui-btn layui-btn-primary">清除</button>
            </div>
        </div>
</form>
</body>
</html>
@endsection
<script src="http://apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
$(document).on('click','.add',function(){
    var admin_name=$('input[name="admin_name"]').val();
    var falg1=false;
    if(admin_name==''){
        $("input[name='admin_name']+span").html("<font color='red'>管理员名称不能为空</font>");
        falg1=false;
    }else{
        $("input[name='admin_name']+span").html("<font color='green'>√</font>");
        falg1=true;
    }
    var falg2=false;
    var admin_pwd=$('input[name="admin_pwd"]').val();
    if(admin_pwd==''){
        $("input[name='admin_pwd']+span").html("<font color='red'>管理员密码不能为空</font>");
        falg2=false;
    }else{
        $("input[name='admin_pwd']+span").html("<font color='green'>√</font>");
        falg2=true;
    }
    var falg3=false;
    var true_pwd=$('input[name="true_pwd"]').val();
    if(true_pwd!=admin_pwd){
        $("input[name='true_pwd']+span").html("<font color='red'>确认密码与第一次不一致</font>");
        falg3=false;
    }else{
        $("input[name='true_pwd']+span").html("<font color='green'>√</font>");
        falg3=true;
    }
    if(falg1===false || falg2===false || falg3===false){
        return false;
    }else{
        $('from').submit();
    }
    // alert(admin_name);
})


</script>
