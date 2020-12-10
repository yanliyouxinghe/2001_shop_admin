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
<!-- <link rel="stylesheet" href="//res.layui.com/layui/dist/css/layui.css" media="all"> -->
<!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>

<blockquote class="layui-elem-quote layui-text">
<h4 style="color:green">广告列表</h4>

</blockquote>
<form action="">
    广告名称：<input type="text" name="adv_name" value="{{$adv_name}}" placeholder="请输入广告名称">
      <button>搜索</button>
  </form>
   <p align="right"><a href="{{url('/adv/create')}}">添加</a></p>
    <div class="layui-form">
     <table class="layui-table">
        <thead>
            <tr width="400px">
                <th><input type="checkbox"  name="allbox"></th>
                <th width="200px">广告ID</th>
                <th width="300px">广告名称</th>
                <th width="300px">媒介类型</th>
                <th width="300px">广告图片</th>
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
                <td><input type="checkbox" class="box" name="box" value="{{$v->adv_id}}"></td>
                <td>{{$v->adv_id}}</td>
                <td id="{{$v->adv_id}}" oldval="{{$v->adv_name}}">
                     <span class="span_name">{{$v->adv_name}}</span>
                </td>
                <td>{{$v->media_type==1?'图片':'文字'}}</td>
                <td>
                  @if($v->adv_img)
                  <img src="{{$v->adv_img}}" width="50px" height="50px">
                  @endif
                </td>
                <td>{{$v->ad_name}}</td>
                <td>{{$v->start_time}}</td>
                <td>{{$v->end_time}}</td>
                <td>{{$v->adv_link}}</td>
                <td>{{$v->is_open==1?'是':'否'}}</td>
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
        <tr><td colspan="8">{{$adv->links('vendor.pagination.adminbrand')}}</td>
          <button type="button" class="moredel">批量删除</button>
        </tr>
        </tbody>
     </table>
    </div>
    </body>
    </html>

<script src="http://libs.baidu.com/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
   /**ajax分页 */
   $(document).on('click','.#layui-laypage-1 a',function(){
      // alert(11);
      var url = $(this).attr('href');
      // console.log(url);

      $.get(url,function(res){
        // alert(res);
        $('tbody').html(res);
      })
      return false;
    })



 /**ajax删除 */
 $(document).on('click','.del',function(){
    var _this = $(this);
    var adv_id = [];''
    adv_id.push(_this.attr('adv_id'));
    if(!adv_id){
      return; 
    }
    if(confirm("您确定要删除吗?")){
        $.get('/adv/destroy',{'adv_id':adv_id},function(res){
            if(res.code==0){
                _this.parent().parent().remove();
            }else{
              alert(res.msg);
            }     
        },'json')
    }
  })


  /**批量删除 */
  $(document).on('click','.moredel',function(){
    var adv_id = new Array();
    $('input[name="box"]:checked').each(function(){
        // console.log($(this));
        adv_id.push($(this).val());
    });
    // console.log(adv_id);return;
    // return false
    if(adv_id.length==0){
      alert("请选择要删除的数据");
      return;
    }
    
    //4.用ajax传数据
    if(confirm("您确定要删除吗?")){
      $.get('/adv/destroy',{'adv_id':adv_id},function(res){
        if(res.code==0){
          $('input[name="box"]:checked').parent().parent().remove();
            }else{
              alert(res.msg);
            }
      },'json')
    }
    
  });''


  /**全选反选 */
  $(document).on('click','.layui-form-checkbox:eq(0)',function(){
     var checkval = $('input[name="allbox"]').prop('checked');
    $('input[name="box"]').prop('checked','checkval');
    if(checkval){
        $('.layui-form-checkbox:gt(0)').addClass('layui-form-checked');
    }else{
        $('.layui-form-checkbox:gt(0)').removeClass('layui-form-checked');
    }
  })

  /**即点即改 */
  $(document).on('click','.span_name',function(){
     var adv_name=$(this).text();
     var id = $(this).parent().attr('id');
     $(this).parent().html('<input type="text" class="changeVal input_name"  value='+adv_name+'>');
     //把|光标放到后面
     $('.input_name').val('').focus().val(adv_name);
     //第二部分 
     $(document).on('blur','.changeVal',function(){
         var newname = $(this).val();
         if(!newname){
             alert("内容不能为空");
             return;
         }  
         //判断 不改  新值 = 旧值
         var oldval = $(this).parent().val('oldval'); 
         if(newname==oldval){
            $(this).parent().html('<span class="span_name">'+newname+'</span>');
            return;
         } 
         var id = $(this).parent().attr('id');
         var obj = $(this);
         //第三部分
         $.ajax({
             url:'/adv/change',
             dataType:'json',
             type:'post',
             data:{id:id,adv_name:newname},
             success:function(res){
                 if(res.code==0){
                    obj.parent().html('<span class="span_name">'+newname+'</span>');
                 }
             }
         })
         


     })

  })







</script>
@endsection

