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
  <!-- <link rel="stylesheet" href="//res.layui.com/layui/dist/css/layui.css"  media="all"> -->
</head>
<body>

<blockquote class="layui-elem-quote layui-text">
<h4 style="color:green">广告位置添加</h4>
</blockquote>
    <form class="layui-form" action="{{url('/ad/store')}}" method="post">
         @csrf
        <div class="layui-form-item">
            <label class="layui-form-label">广告位置名称:</label>
            <div class="layui-input-block">
            <input type="text" name="ad_name" lay-verify="title" autocomplete="off" placeholder="请输入广告位置位名称" class="layui-input"><span></span>
            <b style="color:red">{{$errors->first('ad_name')}}</b>
            </div>
        </div>

         <div class="layui-form-item">
            <label class="layui-form-label">广告位置宽度:</label>
            <div class="layui-input-block">
            <input type="text" name="ad_width" lay-verify="title" autocomplete="off" placeholder="请输入广告位置宽度" class="layui-input"><span></span>
            <b style="color:red">{{$errors->first('ad_width')}}</b>
            
            </div>
        </div>


        <div class="layui-form-item">
            <label class="layui-form-label">广告位置高度:</label>
            <div class="layui-input-block">
            <input type="text" name="ad_height" lay-verify="title" autocomplete="off" placeholder="请输入广告位置高度" class="layui-input"><span></span>
            </div>
        </div>          


        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">广告位置介绍</label>
            <div class="layui-input-block">
              <textarea placeholder="请输入广告位置介绍" name="ad_desc" class="layui-textarea"></textarea>
              <span></span>
            </div>
        </div>

        <div class="layui-form-item">
               <label class="layui-form-label">广告位置模板</label>
               <div class="layui-input-block">
                 <select name="template" lay-filter="demo">
                   <option value="0">--请选择--</option>
                   <option value="1">单图片</option>
                   <option value="2">多图片</option>
                   <option value="3">文字</option>
                 </select>
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
<script src="http://libs.baidu.com/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
  //js验证
  $(document).on('click','.add',function(){
    
    var ad_name = $('input[name="ad_name"]').val();
    // alert(ad_name);
    var flag1 = false;
    if(ad_name==''){
      $("input[name='ad_name']+span").html("<font color='red'>广告位置名称不能为空</font>");
      flag1 = false;
    }else{
      $("input[name='ad_name']+span").html("<font color='green'>√</font>");
      flag1 = true;
    }

    var ad_width = $('input[name="ad_width"]').val();
    var falg2 = false;
    if(ad_width==''){
      $("input[name='ad_width']+span").html("<font color='red'>广告位置宽度不能为空</font>");
      falg2 = false;
    }else{
      $("input[name='ad_width']+span").html("<font color='green'>√</font>");
      falg2 = true;
    }

   
    var ad_height = $('input[name="ad_height"]').val();
    var falg3 = false;
    if(ad_height==''){
      $("input[name='ad_height']+span").html("<font color='red'>广告位置高度不能为空</font>");
      falg3 = false;
    }else{
      $("input[name='ad_height']+span").html("<font color='green'>√</font>");
      falg3 = true;
    }


    var ad_desc = $('textarea[name="ad_desc"]').val();
    var falg4 = false;
    if(ad_desc==''){
      $("textarea[name='ad_desc']+span").html("<font color='red'>广告位置内容不能为空</font>");
      falg4 = false;
    }else{
      $("textarea[name='ad_desc']+span").html("<font color='green'>√</font>");
      falg4 = true;
    }

    if(flag1===false || falg2===false || falg3===false || falg4===false){
      return false;
    }else{
        $('from').submit();
    }

   


  });
</script>



@endsection