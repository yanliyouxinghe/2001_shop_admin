@extends('layouts.layout')
@section('title','广告管理')
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
<h4 style="color:green">广告列表</h4>
</blockquote>

    <div class="layui-form">
     <table class="layui-table">
        <thead>
            <tr width="400px">
                <th width="200px">广告ID</th>
                <th width="300px">广告名称</th>
                <th width="300px">媒介类型</th>
                <th width="300px">广告位置</th>
                <th width="300px">开始日期</th>
                <th width="300px">结束日期</th>
                <th width="300px">广告链接</th>
                <th width="300px">是否开启</th>
                <th width="300px">联系人电话</th>
                <th width="300px">联系人Email</th>
                <th width="300px">模板类型</th>
                <th width="300px">操作</th>
            </tr>
        </thead>
        <tbody>
        @foreach($adv as $v)
          <tr adv_id="{{$v->adv_id}}">
                <td>{{$v->adv_id}}</td>
                <td>{{$v->adv_name}}</td>
                <td>{{$v->media_type==1?'图片':'文字'}}</td>
                <td>{{$v->adv_name}}</td>
                <td>{{$v->start_time}}</td>
                <td>{{$v->end_time}}</td>
                <td>{{$v->adv_link}}</td>
                <td>{{$v->is_open}}</td>
                <td>{{$v->link_tel}}</td>
                <td>{{$v->link_email}}</td>
                <td>@if($v->template==1)单图片
                    @elseif($v->template==2)多图片
                    @else 文字
                    @endif
                </td>
            <td>
            <a href="{{url('adv/edit/'.$v->adv_id)}}"><button type="button" class="layui-btn layui-btn-normal">修改</button></a>
            <button type="button" class="layui-btn layui-btn-danger del" adv_id="{{$v->adv_id}}">删除</button>
               </td>
           
          </tr>
        @endforeach
        <tr><td colspan="12">{{$adv->links()}}</td></tr>
        </tbody>
     </table>
    </div>
    </body>
    </html>

<script src="http://libs.baidu.com/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">





</script>
@endsection

