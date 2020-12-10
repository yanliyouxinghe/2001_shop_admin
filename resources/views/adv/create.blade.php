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
  <!-- <link rel="stylesheet" href="//res.layui.com/layui/dist/css/layui.css"  media="all"> -->
</head>
<body>

<blockquote class="layui-elem-quote layui-text">
<h4 style="color:green">广告添加</h4>
<p align="right"><a href="{{url('/adv')}}">列表页</a></p>
</blockquote>
    <form class="layui-form" action="{{url('/adv/store')}}" method="post" enctype="multipart/form-data">
         @csrf
         <div class="layui-form-item">
            <label class="layui-form-label">广告名称:</label>
            <div class="layui-input-block">
            <input type="text" name="adv_name" lay-verify="title" autocomplete="off" placeholder="请输入广告名称" class="layui-input"><span></span>
            <b style="color:red">{{$errors->first('adv_name')}}</b>
            </div>
        </div>

        <div class="layui-form-item">
               <label class="layui-form-label">媒介类型</label>
               <div class="layui-input-block">
                 <select name="media_type" lay-filter="demo">
                   <option value="0">--请选择--</option>
                   <option value="1" >图片</option>
                   <option value="2">文字</option>
                 </select>
                 <span></span>
               </div>
           </div>
          
           <div class="layui-form-item layui-form-text desc" style="display: none;">
            <label class="layui-form-label">普通文本域</label>
            <div class="layui-input-block"> 
              <textarea placeholder="请输入内容" class="layui-textarea" name="adv_desc"></textarea>
              <span></span>
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
                   <option value="{{$v->ad_id}}">{{$v->ad_name}}</option>
                   @endforeach
                 </select>
                 <span></span>
               </div>
           </div>

          <div class="layui-form-item">
            <div class="layui-inline">
              <label class="layui-form-label">开始日期</label>
              <div class="layui-input-inline">
                <input type="text" name="start_time" class="layui-input" id="date1" placeholder="yyyy-MM-dd HH:mm:ss">
                <span></span>
              </div>
            </div>
			    </div>

          <div class="layui-form-item">
            <div class="layui-inline">
              <label class="layui-form-label">结束日期</label>
              <div class="layui-input-inline">
                <input type="text" name="end_time" class="layui-input" id="date" placeholder="yyyy-MM-dd HH:mm:ss">
                <span></span>
              </div>
            </div>
			    </div>

         <div class="layui-form-item">
            <label class="layui-form-label">广告链接:</label>
            <div class="layui-input-block">
            <input type="text" name="adv_link" lay-verify="title" autocomplete="off" placeholder="请输入广告链接" class="layui-input">
            <span></span>
             
            </div>
        </div>


        <div class="layui-form-item" pane="">
             <label class="layui-form-label">是否开启:</label>
             <div class="layui-input-block">
               <input type="radio" name="is_open" value="1" title="是" checked="">
               <input type="radio" name="is_open" value="2" title="否">
             </div>
        </div>


        <div class="layui-form-item">
            <label class="layui-form-label">联系人Email:</label>
            <div class="layui-input-block">
            <input type="text" name="link_email" lay-verify="title" autocomplete="off" placeholder="请输入联系人Email" class="layui-input"> 
            </div>
        </div>


        <div class="layui-form-item">
            <label class="layui-form-label">联系人电话:</label>
            <div class="layui-input-block">
            <input type="text" name="link_tel" lay-verify="title" autocomplete="off" placeholder="请输入联系人电话" class="layui-input"> 
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
<script src="/static/admin/layui.js"></script>
<script src="http://libs.baidu.com/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
  //js验证
  $(document).on('click','.add',function(){
    var adv_name = $('input[name="adv_name"]').val();
    var flag1 = false;
    // alert(ad_name);
    if(adv_name==''){
      $("input[name='adv_name']+span").html("<font color='red'>广告名称不能为空</font>");
      flag1 = false;
    }else{
      $("input[name='adv_name']+span").html("<font color='green'>√</font>");
      flag1 = true;
    }

    
    var media_type = $('select[name="media_type"]').val();
    var falg2 = false;
    if(media_type==''){
      $("select[name='media_type']+span").html("<font color='red'>媒介类型不能为空</font>");
      falg2 = false;
    }else{
      $("select[name='media_type']+span").html("<font color='green'>√</font>");
      falg2 = true;
    }

    
    var ad_id = $('select[name="ad_id"]').val();
    var falg3 = false;
    if(ad_id==''){
      $("select[name='ad_id']+span").html("<font color='red'>广告位置不能为空</font>");
      falg3 = false;
    }else{
      $("select[name='ad_id']+span").html("<font color='green'>√</font>");
      falg3 = true;
    }


    
    var start_time = $('input[name="start_time"]').val();
    var falg4 = false;
    if(start_time==''){
      $("input[name='start_time']+span").html("<font color='red'>开始日期不能为空</font>");
      falg4 = false;
    }else{
      $("input[name='start_time']+span").html("<font color='green'>√</font>");
      falg4 = true;
    }


    
    var end_time = $('input[name="end_time"]').val();
    var falg5 = false;
    if(end_time==''){
      $("input[name='end_time']+span").html("<font color='red'>结束时间不能为空</font>");
      falg5 = false;
    }else{
      $("input[name='end_time']+span").html("<font color='green'>√</font>");
      falg5 = true;
    }



    
    var adv_link = $('input[name="adv_link"]').val();
    var falg6 = false;
    if(adv_link==''){
      $("input[name='adv_link']+span").html("<font color='red'>广告链接不能为空</font>");
      falg6 = false;
    }else{
      $("input[name='adv_link']+span").html("<font color='green'>√</font>");
      falg6 = true;
    }

    if(flag1===false || falg2===false || falg3===false || falg4===false ||falg5===false ||falg6===false){
      return false;
    }
    
   



  })
</script>





@endsection