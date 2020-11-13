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
    <form class="layui-form" action="{{url('/adv/store')}}" method="post">
         @csrf
         <div class="layui-form-item">
            <label class="layui-form-label">广告名称:</label>
            <div class="layui-input-block">
            <input type="text" name="adv_name" lay-verify="title" autocomplete="off" placeholder="请输入广告名称" class="layui-input">
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
               </div>
           </div>
          
           <div class="layui-form-item layui-form-text desc" style="display: none;">
            <label class="layui-form-label">普通文本域</label>
            <div class="layui-input-block"> 
              <textarea placeholder="请输入内容" class="layui-textarea" ></textarea>
            </div>
          </div>


         
          <div class="layui-form-item image">
                <label class="layui-form-label">上传图片:</label>
                <div class="layui-input-block">
                <div class="layui-upload-drag" id="test10">
                  <i class="layui-icon">&#xe67c;</i>
                  <p>点击上传，或将文件拖拽到此处</p >
                  <div class="layui-hide" id="uploadDemoView">
                    <hr>
                    <img src="" alt="上传成功后渲染" style="max-width: 196px">
                  </div>
                </div>
                <input type="hidden" name="adv_img">
                </div>
            </div>
         

            <div class="layui-form-item">
               <label class="layui-form-label">广告位置</label>
               <div class="layui-input-block">
                 <select name="position_id" lay-filter="aihao">
                   <option value="">--请选择--</option>
                   @foreach($ad as $v)
                   <option value="{{$v->ad_id}}">{{$v->ad_name}}</option>
                   @endforeach
                   
                 </select>
               </div>
           </div>

          <div class="layui-form-item">
            <div class="layui-inline">
              <label class="layui-form-label">开始日期</label>
              <div class="layui-input-inline">
                <input type="text" name="start_time" class="layui-input" id="test5" placeholder="yyyy-MM-dd HH:mm:ss">
              </div>
            </div>
			    </div>

          <div class="layui-form-item">
            <div class="layui-inline">
              <label class="layui-form-label">结束日期</label>
              <div class="layui-input-inline">
                <input type="text" name="end_time" class="layui-input" id="test6" placeholder="yyyy-MM-dd HH:mm:ss">
              </div>
            </div>
			    </div>

         <div class="layui-form-item">
            <label class="layui-form-label">广告链接:</label>
            <div class="layui-input-block">
            <input type="text" name="adv_link" lay-verify="title" autocomplete="off" placeholder="请输入广告链接" class="layui-input">
             
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
            <button type="submit" class="layui-btn">添加</button>
            <button type="reset" class="layui-btn layui-btn-primary">清除</button>
            </div>
        </div>
    </form>

</body>
</html>
<script src="/static/admin/layui.js"></script>
<script src="/static/admin/layui.min.js"></script>
<script>
//JavaScript代码区域
layui.use(['element','form','laydate'], function(){
  var element = layui.element;
  var form = layui.form;
  var laydate = layui.laydate;
  form.render();

  //日期时间选择器
  laydate.render({
    elem: '#test5'
    ,type: 'datetime'
  });
    //日期时间选择器
    laydate.render({
    elem: '#test6'
    ,type: 'datetime'
  });

})

layui.use(['element','form'], function(){
  var element = layui.element;
  var form=layui.form;
  form.on('select(demo)', function(data){
    var type_id=data.value;
    //alert(type_id);
    if (type_id==1) {
     $('.image').show();
     $('.desc').hide();
    }else{
     $('.image').hide();
     $('.desc').show();
    }
});
});








layui.use('upload', function(){
  var $ = layui.jquery
  ,upload = layui.upload;

  $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

//拖拽上传
upload.render({
    elem: '#test10'
    ,url: 'http://2001.shop.admin/adv/upload' //改成您自己的上传接口
    ,done: function(res){
      layer.msg(res.msg);
      layui.$('#uploadDemoView').removeClass('layui-hide').find('img').attr('src', res.data);
      //console.log(res)

      layui.$('input[name="ad_img"]').attr('value',res.data);
    }
  });


});





</script>

@endsection