@extends('layouts.layout')
@section('title','广告位置位置管理')
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
</head>
<body>

<blockquote class="layui-elem-quote layui-text">
<h4 style="color:green">广告位置添加</h4>
</blockquote>
    <form class="layui-form" action="{{url('/ad/update/'.$ad->ad_id)}}" method="post">
         @csrf
        <div class="layui-form-item">
            <label class="layui-form-label">广告位置名称:</label>
            <div class="layui-input-block">
            <input type="text" name="ad_name" value="{{$ad->ad_name}}" lay-verify="title" autocomplete="off" placeholder="请输入广告位置位名称" class="layui-input">
            </div>
        </div>

         <div class="layui-form-item">
            <label class="layui-form-label">广告位置宽度:</label>
            <div class="layui-input-block">
            <input type="text" name="ad_width" value="{{$ad->ad_width}}" lay-verify="title" autocomplete="off" placeholder="请输入广告位置宽度" class="layui-input">
            </div>
        </div>


        <div class="layui-form-item">
            <label class="layui-form-label">广告位置高度:</label>
            <div class="layui-input-block">
            <input type="text" name="ad_height" value="{{$ad->ad_height}}" lay-verify="title" autocomplete="off" placeholder="请输入广告位置高度" class="layui-input"> 
            </div>
        </div>          


        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">广告位置介绍</label>
            <div class="layui-input-block">
              <textarea placeholder="请输入广告位置介绍" name="ad_desc" class="layui-textarea">{{$ad->ad_desc}}</textarea>
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