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

<form class="layui-form" action="{{url('/menu/update/'.$data1->menu_id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="layui-form-item">
            <label class="layui-form-label">菜单名称:</label>
            <div class="layui-input-block">
            <input type="text" name="menu_name" lay-verify="title" autocomplete="off" placeholder="请输入菜单名称" class="layui-input" value="{{$data1->menu_name}}">
            <b style="color:red; font-family:'仿宋' "></b> 
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">路由别名:</label>
            <div class="layui-input-block">
            <input type="text" name="menu_url" lay-verify="title" autocomplete="off" placeholder="请输入路由别名" class="layui-input" value="{{$data1->menu_url}}">
            <b style="color:red; font-family:'仿宋' "></b> 
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">路径:</label>
            <div class="layui-input-block">
            <input type="text" name="route" lay-verify="title" autocomplete="off" placeholder="请输入路径" class="layui-input" value="{{$data1->route}}">
            <b style="color:red; font-family:'仿宋' "></b> 
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">所属模块:</label>
            <div class="layui-input-block">
           <select name="parent_id">
           <option value="0">--顶级菜单--</option>
           @foreach($data as $v)
           @if($data1->menu_id==$v->menu_id)
           <option value="{{$v->menu_id}}">{{$v->menu_name}}</option>
           @else
           <option value="{{$v->menu_id}}" selected="">{{$v->menu_name}}</option>
          
           @endif
           @endforeach
           </select>
            <b style="color:red; font-family:'仿宋' "></b> 
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否显示:</label>
            <div class="layui-input-block">
           是<input type="radio" name="is_show" value="1" {{$data1->is_show==1?'checked':""}}>
           否<input type="radio" name="is_show" value="2" {{$data1->is_show==2?'checked':""}}>
            <b style="color:red; font-family:'仿宋' "></b> 
            </div>
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
