@extends('layouts.layout')
@section('title','广告管理')
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
<h4 style="color:green">广告添加</h4>
</blockquote>
    <form class="layui-form" action="{{url('/adv/update/'.$adv->adv_id)}}" method="post" enctype="multipart/form-data">
         @csrf
         <div class="layui-form-item">
            <label class="layui-form-label">广告名称:</label>
            <div class="layui-input-block">
            <input type="text" name="adv_name" value="{{$adv->adv_name}}" lay-verify="title" autocomplete="off" placeholder="请输入广告名称" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
               <label class="layui-form-label">媒介类型</label>
               <div class="layui-input-block">
                 <select name="media_type" lay-filter="demo" value="{{$adv->media_type==1?'图片':'文字'}}">
                   <option value="0">--请选择--</option>
                   <option value="1" >图片</option>
                   <option value="2">文字</option>
                 </select>
               </div>
           </div>
          
           <div class="layui-form-item layui-form-text desc" style="display: none;">
            <label class="layui-form-label">普通文本域</label>
            <div class="layui-input-block"> 
              <textarea placeholder="请输入内容" class="layui-textarea" name="adv_desc">{{$adv->adv_desc}}</textarea>
            </div>
          </div>


         
          <div class="layui-form-item image">
                <label class="layui-form-label" name="adv_img" >上传图片:</label>
                <div class="layui-input-block">
                <div class="layui-upload-drag" id="test10">
                  <i class="layui-icon">&#xe67c;</i>
                  <p>点击上传，或将文件拖拽到此处</p >
                  <div class="layui-hide" id="uploadDemoView" >
                    <hr>
                    <img src="" alt="上传成功后渲染" style="max-width: 196px">
                    <input type="hidden" name="adv_img" value="">
                  </div>
                </div>
                </div>
            </div>
         

            <div class="layui-form-item">
               <label class="layui-form-label">广告位置</label>
               <div class="layui-input-block">
                 <select name="ad_id" lay-filter="aihao">
                   <option value="">--请选择--</option>
                   @foreach($ad as $v)
                   @if($v->ad_id==$adv->ad_id)
                   <option value="{{$v->ad_id}}"  selected>{{$v->ad_name}}</option>
                   @else
                   <option value="{{$v->ad_id}}" >{{$v->ad_name}}</option>
                   @endif
                   @endforeach
                   
                 </select>
               </div>
           </div>

          <div class="layui-form-item">
            <div class="layui-inline">
              <label class="layui-form-label">开始日期</label>
              <div class="layui-input-inline">
                <input type="text" name="start_time" class="layui-input" id="date1" placeholder="yyyy-MM-dd HH:mm:ss">
              </div>
            </div>
			    </div>

          <div class="layui-form-item">
            <div class="layui-inline">
              <label class="layui-form-label">结束日期</label>
              <div class="layui-input-inline">
                <input type="text" name="end_time" class="layui-input" id="date" placeholder="yyyy-MM-dd HH:mm:ss">
              </div>
            </div>
			    </div>

         <div class="layui-form-item">
            <label class="layui-form-label">广告链接:</label>
            <div class="layui-input-block">
            <input type="text" name="adv_link"  value="{{$adv->adv_link}}" lay-verify="title" autocomplete="off" placeholder="请输入广告链接" class="layui-input">
             
            </div>
        </div>


        <div class="layui-form-item" pane="">
             <label class="layui-form-label">是否开启:</label>
             <div class="layui-input-block">
               <input type="radio" name="is_open" value="1" title="是" {{$adv->is_open==1?'checked':""}}>是
               <input type="radio" name="is_open" value="2" title="否" {{$adv->is_open==2?'checked':""}}>否
             </div>
        </div>


        <div class="layui-form-item">
            <label class="layui-form-label">联系人Email:</label>
            <div class="layui-input-block">
            <input type="text" name="link_email" value="{{$adv->link_email}}" lay-verify="title" autocomplete="off" placeholder="请输入联系人Email" class="layui-input"> 
            </div>
        </div>


        <div class="layui-form-item">
            <label class="layui-form-label">联系人电话:</label>
            <div class="layui-input-block">
            <input type="text" name="link_tel" value="{{$adv->link_tel}}" lay-verify="title" autocomplete="off" placeholder="请输入联系人电话" class="layui-input"> 
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
<script src="/static/admin/layui.js"></script>



</script>

@endsection