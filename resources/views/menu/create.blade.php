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
<h4 style="color:green">菜单添加</h4>
</blockquote>

<form class="layui-form" action="{{url('/menu/store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="layui-form-item">
            <label class="layui-form-label">菜单名称:</label>
            <div class="layui-input-block">
            <input type="text" name="menu_name" lay-verify="title" autocomplete="off" placeholder="请输入菜单名称" class="layui-input">
            <span></span>
            <b style="color:red; font-family:'仿宋' "></b> 
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">路由别名:</label>
            <div class="layui-input-block">
            <input type="text" name="menu_url" lay-verify="title" autocomplete="off" placeholder="请输入路由别名" class="layui-input">
            <span></span>
            <b style="color:red; font-family:'仿宋' "></b> 
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">路径:</label>
            <div class="layui-input-block">
            <input type="text" name="route" lay-verify="title" autocomplete="off" placeholder="请输入路径" class="layui-input">
            <span></span>
            <b style="color:red; font-family:'仿宋' "></b> 
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">所属模块:</label>
            <div class="layui-input-block">
           <select name="parent_id">
           <option value="0">--顶级菜单--</option>
           @foreach($data as $v)
           
           <option value="{{$v->menu_id}}">{{$v->menu_name}}</option>
           @endforeach
           </select>
            <b style="color:red; font-family:'仿宋' "></b> 
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否显示:</label>
            <div class="layui-input-block">
           是<input type="radio" name="is_show" value="1" checked>
           否<input type="radio" name="is_show" value="2">
            <b style="color:red; font-family:'仿宋' "></b> 
            </div>
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
    var menu_name=$('input[name="menu_name"]').val();
    var falg1=false;
    if(menu_name==''){
        $("input[name='menu_name']+span").html("<font color='red'>菜单名称不能为空</font>");
        falg1=false;
    }else{
        $("input[name='menu_name']+span").html("<font color='green'>√</font>");
        falg1=true;
    }
    var falg2=false;
    var menu_url=$('input[name="menu_url"]').val();
    if(menu_url==''){
        $("input[name='menu_url']+span").html("<font color='red'>菜单别名不能为空</font>");
        falg2=false;
    }else{
        $("input[name='menu_url']+span").html("<font color='green'>√</font>");
        falg2=true;
    }
    var falg3=false;
    var true_pwd=$('input[name="route"]').val();
    if(true_pwd==''){
        $("input[name='route']+span").html("<font color='red'>路由不能为空</font>");
        falg3=false;
    }else{
        $("input[name='route']+span").html("<font color='green'>√</font>");
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
