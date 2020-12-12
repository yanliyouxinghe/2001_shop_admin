@extends('layouts.layout')  
@section('content')
    <!-- 内容主体区域 -->
    <!-- <div style="padding: 15px;"></div> -->
    <blockquote class="layui-elem-quote layui-text">
<h4 style="color:green">角色展示</h4>
</blockquote>
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
        <legend>
            <span class="layui-breadcrumb">
                <a href="/">后台首页</a>
                <a href="/demo/">角色</a>
                <a><cite>角色列表</cite></a>
            </span>
        </legend>
    </fieldset>

    <div class="layui-form">
        <table class="layui-table">
            <colgroup>
            <col width="150">
            <col width="150">
            <col width="200">
            <col>
            </colgroup>
            <thead>
            <tr>
                <th>角色id</th>
                <th>角色名称</th>
                <th>角色描述</th>
                <th>操作</th>
            </tr> 
            </thead>
            <tbody>
            @foreach($data as $v)
            <tr>
                <td>{{$v->role_id}}</td>
                <td>{{$v->role_name}}</td>
                <td>{{$v->role_desc}}</td>
                <td>
                        <button type="button" class="layui-btn layui-btn-danger del" role_id="{{$v->role_id}}">删除</button>
                    <a href="role/addpriv/{{$v->role_id}}">
                        <button type="button" class="layui-btn layui-btn-normal">添加权限</button>
                    </a>
                </td>
            </tr>
            @endforeach

            
            
            <!--  -->
            </tbody>       
        </table>
        
    </div>

  @endsection
  <script src="http://libs.baidu.com/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
//删除
$(document).on('click','.del',function(){
          var _this = $(this);
          var role_id = _this.attr('role_id');
          alert(role_id);
          if(!role_id){
              return;
          }
          if(confirm('确定删除吗？')){
              $.ajax({
                  url : '/role/destroy',
                  dataType : 'json',
                  type : 'post',
                  data : {'role_id':role_id},
                success:function(ret){
                    if(ret.code==0){
                        _this.parent().parent().remove();
                    }else{
                      alert(ret.msg);
                    }
                }
              });
          }
          return;
      });
</script>

  

