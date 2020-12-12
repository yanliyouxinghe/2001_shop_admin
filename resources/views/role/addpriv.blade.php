@extends('layouts.layout')  
@section('content')
    <!-- 内容主体区域 -->
    <!-- <div style="padding: 15px;"></div> -->
    <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="//res.layui.com/layui/dist/css/layui.css"  media="all">
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
        <legend>
            <span class="layui-breadcrumb">
                <a href="/">后台首页</a>
                <a href="/demo/">权限管理</a>
                <a><cite>添加权限</cite></a>
            </span>
        </legend>
    </fieldset>




    <div class="layui-form">
        <form action="{{url('role/addprivdo')}}" method="post">
        <input type="hidden" name="role_id" value={{$role_id}}>
        <table class="layui-table">
            <colgroup>
            <col width="150">
            <col width="150">
            <col width="200">
            <col>
            </colgroup>
            <thead>
            <tr> 
                <th width="30%">权限名称</th>
                <th width="60%"></th>
            </tr> 
            <tr>
            
            <th width="60%">全选</th>
            <th>
                  <input type="checkbox" name="allcheckbox" lay-skin="primary"  class="vainglory">
                </th>
            </tr>
            
            </thead>
            <tbody>
            @foreach($menu as $v)
            <tr>
                <td>
                  {{str_repeat('|——',$v->level)}}{{$v->menu_name}}
                </td>
                <td><input @if(in_array($v->id,$role_menu)) checked @endif type="checkbox" class="priv_{{$v->id}}" name="menucheck[]" lay-skin="primary"  parent_id="{{$v->parent_id}}" value="{{$v->menu_id}}"></td>
            </tr>
            @endforeach
            <tr>
                <td colspan="2">
                   <center><button type="submit" class="layui-btn layui-btn-normal">添加权限</button></center>
                </td>
            </tr>
            </tbody>       
        </table>
        </form>
    </div>

<script src="http://apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
//JavaScript代码区域
// layui.use(['element','form'], function(){
//   var element = layui.element;
//   var form = layui.form;
// });

//全选
$(document).on('click','.layui-form-checkbox:eq(0)',function(){
//   alert(123321);
  var checkval = $('input[name="allcheckbox"]').prop('checked');
  //alert(checkval);
  $('input[name="menucheck[]"]').prop('checked',checkval);
  if(checkval){
    $('.layui-form-checkbox:gt(0)').addClass('layui-form-checked');
  }else{
    $('.layui-form-checkbox:gt(0)').removeClass('layui-form-checked');
  }
  
})
$(document).on('click','.layui-form-checkbox',function(){
    var val = $(this).prev().val();
    // alert(val);
    //当前复选框的值
    var checkval = $(this).prev().prop('checked');
    $('input[parent_id="'+val+'"]').prop('checked',checkval);
    // alert(checkval);
    if(checkval){
        $('input[parent_id="'+val+'"]').next().addClass('layui-form-checked');
    }else{
        $('input[parent_id="'+val+'"]').next().removeClass('layui-form-checked');
    }

    var parent_val = $(this).prev().attr('parent_id');
    //alert(parent_val);
    $('input[class="priv_'+parent_val+'"]').prop('checked',checkval);
    if(checkval){
        $('input[class="priv_'+parent_val+'"]').next().addClass('layui-form-checked');
    }else{
        $('input[class="priv_'+parent_val+'"]').next().removeClass('layui-form-checked');
    }
})
</script>

  @endsection
  
  

